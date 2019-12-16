<?php

namespace App\Http\Controllers\API;

use App\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Album::with('images')->latest('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request,
		[
            'title' => 'required|string|max:80',
			'image' => 'required|max:10240',
            'text' => 'required|string|max:200',
		],
		[
			'title.max' => 'Onli 80 characters allowed',
			'title.required' => 'Title is Required',
			'text.max' => 'Onli 200 characters allowed',
			'text.required' => 'Text is required',
			'image.required' => 'Images is required',
			'image.max' => 'Max 10MB filesize is allowed ',

		]
       );

        if($request->image){

            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(300, 200)->save(public_path('img/album-img/').$name);
            $request->merge(['image' => $name]);
        }
            $album = Album::create($request->all());
                return response()->json([
                    'message' => 'album created',
                    'album' => $album,
                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Album::findOrFail($id)->load('images');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'text' => 'required',
        ]);
        $currentImage = $album->image;
        if($request->image != $currentImage) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(300, 200)->save(public_path('img/album-img/').$name);
            $request->merge(['image' => $name]);

            $albumImage = public_path('img/album-img/').$currentImage;

            if(file_exists($albumImage)){

                @unlink($albumImage);

            }
        }
        $album->update($request->all());
                 return response()->json([
                    'message' => 'album updated',
                    'album' => $album,
                ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        $currentImage = $album->image;
        $albumImage = public_path(
            'img/album-img/','img/gallery-img/'
        ).$currentImage;

        if (file_exists($albumImage)) {
            @unlink($albumImage);
        }
        return response()->json([
          'message' => 'album is deleted'
        ], 200);
    }
}