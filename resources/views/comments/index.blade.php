<div class="container">

        @auth 
             
            @include('comments.create')

        @endauth

         
                    
        @foreach ($post->comments as $comment)

             @include('comments.show')
                            
        @endforeach
                  
                                 
 
    </div>