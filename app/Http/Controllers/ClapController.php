<?php

namespace App\Http\Controllers;

use App\Models\Clap;
use Illuminate\Http\Request;

class ClapController extends Controller
{
    public function getClaps(Request $request)
    {
        $clappable_type = $request->input('type');
        $clappable_id = $request->input('id');

        $clap = Clap::firstOrCreate([
            'clappable_type' => $clappable_type,
            'clappable_id' => $clappable_id
        ], ['count' => 0]);

        return response()->json($clap->count);
    }

    public function updateClaps(Request $request)
    {
        $clappable_type = $request->input('type');
        $clappable_id = $request->input('id');
        $json = json_decode($request->getContent(), true);

        if(config('app.clap_version') !== $json['version'])
            return response()->json(['message' => 'version incompatibility'], 401);

        if($json === null || $json === false)
            return response()->json(['message' => 'invalid json'], 500);

        $clap = Clap::where([
            'clappable_type' => $clappable_type,
            'clappable_id' => $clappable_id
        ])->firstOrFail();

        $clap->increment('count', $json['clapsCount']);

        return response()->json($clap->count);
    }
}
