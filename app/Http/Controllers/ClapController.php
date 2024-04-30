<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClapRequest;
use App\Models\Clap;
use Illuminate\Http\Request;

class ClapController extends Controller
{
    public function getClaps(ClapRequest $request)
    {
        $data = $request->validated();

        $data['clappable_id'] = (int)$data['id'];
        unset($data['id']);

        $clap = Clap::firstOrCreate($data, $data + ['count' => 0]);

        return response()->json($clap->count);
    }

    public function updateClaps(ClapRequest $request)
    {
        $data = $request->validated();

        $data['clappable_id'] = $data['id'];
        unset($data['id']);
        $json = json_decode($request->getContent(), true);

        if(config('app.clap_version') !== $json['version'])
            return response()->json(['message' => 'version incompatibility'], 401);

        if($json === null || $json === false)
            return response()->json(['message' => 'invalid json'], 500);

        $clap = Clap::where($data)->firstOrFail();

        $clap->increment('count', $json['clapsCount']);

        return response()->json($clap->count);
    }
}
