@extends('layouts.master')

@section('content')

            <div class="container mt-3">
                    <div class="row">
                        @foreach ($albums as $album)
                         <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                             <div class="card shadow">
                        @include('albums.article', [ 'type' => 'listing' ])
                             </div>
                         </div>
                        @endforeach  
                  </div>
           </div>
   
@endsection