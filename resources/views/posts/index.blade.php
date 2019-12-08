@extends('layouts.master')

@section('content')

<section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8"> 
                    @foreach ($posts as $post)

                        @include('posts.article', [ 'type' => 'listing' ])

                    @endforeach    
                 </div> 
                 <div class="col-lg-4">

                           @include('posts.sidebar')

                 </div>                  
             </div>
        </div>
</section>
@endsection

            

   