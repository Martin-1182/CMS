<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3600'
        ]);

        $albumId = $request->get('album_id');

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $filename = strtolower ( trim ( $image->getClientOriginalName() ));
                $name = time().rand(100,999).$filename;
                $destinationPath = public_path('img/gallery-img/');
                $image->move($destinationPath, $name);

                $image = new Image([
                    'image' => $name,
                    'album_id' => $albumId
                ]);

                $image->save();
            }
        }

        return response()->json([
        'message' => 'All images uplaoded successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        $currentImage = $image->image;
        $imageImage = public_path(
            'img/gallery-img/'
        ) . $currentImage;

        if (file_exists($imageImage)) {
            @unlink($imageImage);
        }
        return response()->json([
            'message' => 'image deleted'
        ], 200);
    }
}