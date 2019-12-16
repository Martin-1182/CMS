@if (Auth::user()->hasVerifiedEmail())
@include('errors')
	<form action="/comments" method="POST" class="add-comment-form">

    <!-- CSRF Token
    :: https://laravel.com/docs/5.8/csrf -->
        @csrf

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Add new comment</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Please type your comment here"></textarea>
    </div>
    <button class="btn btn-primary btn-sm mb-4">add comment</button>

    <input type="hidden" name="post_id" value="{{ $post->id }}">

</form>
@else
<div>
	<span class="alert alert-warning p-2">
Please verify your email address.</span>
</div>
@endif
