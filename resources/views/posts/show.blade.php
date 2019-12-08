@extends('layouts.master')

@section('content')

   
    


<section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8"> 
                     @include('posts.singlePost', [ 'type' => 'full' ])

                     @include('comments.index')
                 </div>                   
             </div>
        </div>
</section>

 @endsection