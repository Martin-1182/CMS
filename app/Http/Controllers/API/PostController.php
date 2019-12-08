<?php

namespace App\Http\Controllers\API;


use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with('user')->latest('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'required',
            'slug' => 'required|unique:posts',
            'text' => 'required',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if($request->image){

            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(420, 340)->save(public_path('img/post-img/').$name);
            $request->merge(['image' => $name]);        
        }
            $post = Post::create($request->all());              
                return response()->json([
                    'message' => 'post created',
                    'post' => $post,
                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    
    {
        $post = Post::find($id);

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'slug' => "required|unique:posts,slug,{$id}",
            'text' => 'required',
            'user_id' => 'required|integer|exists:users,id',
            'image' => 'required'       
        ]);
        $currentImage = $post->image;

        if($request->image != $currentImage) {
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->resize(420, 340)->save(public_path('img/post-img/').$name);
            $request->merge(['image' => $name]);

            $postImage = public_path('img/post-img/').$currentImage;

            if(file_exists($postImage)){

                @unlink($postImage);
                
            }
        }
        $post->update($request->all());    
                 return response()->json([
                    'message' => 'post updated',
                    'post' => $post,
                ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $currentImage = $post->image;
        $postImage = public_path(
            'img/post-img/'
        ).$currentImage;

        if (file_exists($postImage)) {
            @unlink($postImage);
        }
        return response()->json([
          'message' => 'post deleted'
        ], 200);
    }
}
