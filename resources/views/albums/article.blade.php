       
               <img src="/img/album-img/{{ $album->image}}" class="card-img-top" alt="cover_image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->title}}</h5>
                        <p class="card-text">{{ $album->text}}</p>
                        <a href="/albums/{{ $album->id }}" class="album-btn btn btn-sm btn-outline-danger mt-6" ><small >⟶ Foto</small> </a>
                    </div>
                <div class="card-footer">
                    <i class="far fa-calendar-plus"></i>
                    <small class="text-muted">{{ $album->created_at->diffForHumans() }}</small>
                    <i class="far fa-images float-right mt-1"></i>
                    <small class="text-muted float-right mt-1 pr-2">{{ $album->images->count() }}</small>   
                </div>
                 
