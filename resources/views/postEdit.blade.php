@extends('app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            
            <div class="card form-holder my-5">
                <div class="card-body">
                    {{-- <h1>Login</h1> --}}
                    @if($post->user->avatar)
                        <img src="{{asset('/storage/avatars/'.$post->user->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @else
                        <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @endif
                    {{ $post->user->name }}
                    
                    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <textarea cols="30" rows="5" name="body" class="form-control border mt-3">{{ $post->body }}</textarea>
                        <div class="d-flex justify-content-between mt-2">
                            <input type="file" id="image" name="image">
                            <button class="btn-close p" onclick="event.preventDefault();document.getElementById('image').value = '';"></button>
                        </div>                        
                        <button class="btn btn-primary w-100 mt-3" type="submit" value="Update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection