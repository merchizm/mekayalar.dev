<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;

class RaindropService
{

    /**
     * @throws GuzzleException
     */
    function getBookmarks($page = 0, $items = []): array
    {
        $client = new Client();
        $collectionId = '28611701';
        $perPage = 50;
        $created = '2021-01-01';
        $endPoint = "https://api.raindrop.io/rest/v1/raindrops/{$collectionId}?perpage={$perPage}&page={$page}&search=created:>{$created}&sort=-created";

        $response = $client->request('GET', $endPoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . KVOption::get('raindrop_access_token'),
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if ($data['count'] === $perPage) {
            return $this->getBookmarks($page + 1, array_merge($items, $data['items']));
        } else {
            return array_merge($items, $data['items']);
        }
    }

    function shorten_data($data) : Collection
    {
        return collect($data)->map(function ($bookmark) {
            return [
                'title' => $bookmark['title'],
                'link' => $bookmark['link'],
                'created' => $bookmark['created'],
                'domain' => $bookmark['domain']
            ];
        })->sortByDesc(function ($bookmark) {
            return new Carbon($bookmark['created']);
        })->values()->all();
    }

    /**
     * @throws GuzzleException
     */
    function getBookmarksGroupByWeek(): Collection
    {
        $bookmarks = $this->shorten_data($this->getBookmarks());
        return collect($bookmarks)->groupBy(function ($bookmark) {
            $date = Carbon::parse($bookmark['created']);
            $week = $date->weekOfYear;
            $month = $date->month;
            if ($month === 1 && in_array($week, [52, 53])) {
                return 0;
            }
            return $week;
        });
    }

    /**
     * @throws GuzzleException
     */
    function getBookmarksGroupByDay(): Collection
    {
        $bookmarks = $this->getBookmarks();
        return collect($bookmarks)->groupBy(function ($bookmark) {
            return explode('T', $bookmark['created'])[0];
        });
    }


    function refreshToken($clientId, $clientSecret, $refreshToken): array
    {
        $client = new Client();
        $url = 'https://raindrop.io/oauth/access_token';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            // Handle the response as needed, for example, return or store the new tokens
            return [
                'access_token' => $body['access_token'],
                'refresh_token' => $body['refresh_token'],
                'expires_in' => $body['expires_in'], // You can calculate the exact expiry time by adding this value to the current time
                'token_type' => $body['token_type'],
            ];
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Handle error, possibly return or log
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
