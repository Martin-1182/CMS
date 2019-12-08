


    <comment :comment-data="{{ $comment }}" inline-template>

        <article class="comment-article">
            <div class="card">
                <div class="card-body comment-card">

                <div class="row" id="comments">

                        <div class="col-md-4"><strong>{{ $comment->user->name }}</strong><br>
                            <time datetime="{{ $comment->created_at->toW3cString()}}" class="text-white text-center badge badge-info">
                                 <small>{{ $comment->created_at->diffForHumans()}}</small>
                            </time>
                        </div>

                        <div class="col-md-8"><p 
                            ref="input"
                            :contenteditable="editing" 
                            @keydown.enter="updateComment"
                            @keydown.esc="resetText"
                            @blur="resetText"
                            @input="textChanged">
                            {{ $comment->text }}</p>
                        </div>

                        <div class="col-md-12">

                            @can('update', $comment)

                                <a class="float-right text-white font-1 pl-1 badge badge-danger ml-2" @click="deleteComment"> <i class="far fa-trash-alt"></i> Delete</a>
                                            
                                <a class="float-right text-white font-1 pl-1 badge badge-info" @click="startEditing"> <i class="far fa-edit"></i> Edit</a>

                            @endcan
                        </div>

                </div>
             </div>
           </div>
        </article>

    </comment>

   