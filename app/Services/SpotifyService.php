<?php

namespace App\Services;

use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;
use SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;


class SpotifyService
{
    /**
     * @var SpotifyWebAPI\Session
     */
    private SpotifyWebAPI\Session $session;

    /**
     * @var string[][]
     */
    private array $options;

    /**
     * @var SpotifyWebAPI\SpotifyWebAPI
     */
    private SpotifyWebAPI\SpotifyWebAPI $api;

    /**
     * @var mixed
     */
    private mixed $json_data;

    public function __construct()
    {


        // initialize spotify API
        $this->session = new SpotifyWebAPI\Session(
            KVOption::get('SPOTIFY_CLIENT_ID'),
            KVOption::get('SPOTIFY_CLIENT_SECRET'),
            KVOption::get('CALLBACK_URL')
        );


        $this->options = [
            'scope' => [
                'user-read-currently-playing',
            ],
        ];

        $this->api = new SpotifyWebAPI\SpotifyWebAPI($this->session);
    }

    public function auth(): void
    {
        $this->session->getAuthorizeUrl($this->options);
    }

    /**
     * json result
     * @return false|string
     */
    public function json(): false|string
    {
        try {
            // check result is valid
            $result = json_decode($this->currentPlaying(), true);

            $last_response = $this->api->getLastResponse();
            if($result['is_playing'] === false || $last_response['status'] ==! 200 || $last_response['status'] ==! 204){ // @see https://developer.spotify.com/documentation/web-api/
                $this->refreshToken();
                return $this->currentPlaying();
            }else
                return json_encode($result);
        } catch (SpotifyWebAPIAuthException $ex) {
            return json_encode(['error' => 'The access token could not be refreshed.', 'is_playing' => false]);
        } catch (SpotifyWebAPIException $ex) { // if access token is expired, renew with refresh token and try again
            $this->refreshToken();
            return $this->currentPlaying();
        }
    }

    /**
     * refresh the access token
     * @return void
     */
    private function refreshToken(): void
    {
        $this->session->refreshAccessToken(KVOption::get('spotify_refresh_token'));
        KVOption::set('spotify_access_token', $this->session->getAccessToken());
        KVOption::set('spotify_refresh_token', $this->session->getRefreshToken());
    }

    /**
     * get current playing song
     * @return false|string
     */
    private function currentPlaying(): false|string
    {
        $this->api->setAccessToken(KVOption::get('spotify_access_token'));
        $result = (array)$this->api->getMyCurrentTrack();
        if(empty($result))
            return json_encode(['is_playing' => false]);
        $artists = [];
        foreach ($result['item']->artists as $artist) {
            $artists[] = $artist->name;
        }
        return json_encode(["name" => $result['item']->name, "artists" => implode(', ', $artists), "is_playing" => $result["is_playing"], "url" => $result['item']->external_urls->spotify]);
    }
}
