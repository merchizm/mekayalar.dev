<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        try{
            $request->validated();

            $file = $request->file('file');
            $type = $file->getClientMimeType();
            $standardizedName = str_replace(' ', '_', $file->getClientOriginalName()) . uniqid() . $type;
            $path = $file->storeAs('uploads',  $standardizedName);

            $media = Media::create([
                'name' => $standardizedName,
                'originalName' => $file->getClientOriginalName(),
                'path' => $path,
                'type' => $type
            ]);

            return response()->json([
                'media' => $media,
                'message' => 'File uploaded successfully',
                'type' => 'success',
            ]);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        try{
            return response()->json([
                'media' => $media,
                'type' => 'success'
            ]);
        }catch (ModelNotFoundException $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'type' => 'error',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        try{
            $media->updateOrFail($request->validated());
        }catch (ModelNotFoundException $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'type' => 'error',
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => 'error',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        try{
            $media->deleteOrFail();

            return response()->json([
                'message' => 'File deleted successfully',
                'type' => 'success',
            ]);
        }catch (ModelNotFoundException $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'type' => 'error',
            ], 400);
        }catch (\Throwable $e){
            return response()->json([
                'message' => $e->getMessage(),
                'type' => 'error',
            ], 400);
        }
    }
}
