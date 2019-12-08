

<article class="post mb-12 mt-8 {{ $type }}">

  <header class="mb-8">

        <div class="mb-8">
                        
                <img class="fit-cover rounded" src="img/post-img/{{ $post->image}}" alt="post-thumbmail">
                     
        </div>
  
    <h2 class="title mt-8">
    <a href="/posts/{{ $post->slug }}">
            {{ $post->title }}         
        </a>
    </h2>
    <div class="meta">

    <a href="/posts/{{ $post->slug }}#scroll-to-comments" class="comments"> 
                      
                    <span class="text-white font-1 pl-1 badge badge-info">
                        
                    {{ $post->comments->count() }}
                        
                    {{ str_plural('Comment', $post->comments->count()) }}
                    
                    </span>
        
                </a>     
                    <time datetime="{{ $post->created_at->toW3cString()}}" class="text-white font-1 pl-1 badge badge-info">
        
                        {{ $post->created_at->format('d. m. Y') }}
        
                    </time>

    </div>
        
  </header>
                  <!--{!! nl2br($post->text) !!}-->
        <div class="content">

            <div class="mt-4">{!! nl2br (str_limit($post->text, 300)) !!}</div>
            

        </div>

  <footer class="meta">

        <a href="users/{{ $post->user->id }}" class="author">

          <h6 class="mt-4 text-uppercase"> 

                    @<strong>{{ $post->user->name }} </strong>

        </a>
        
        <a href="/posts/{{ $post->slug }}">
            <small class="ml-3"> read more &xrarr;</small>
        </a> 

           </h6>

  </footer>

</article>