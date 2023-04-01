@extends('app')

@section('content')

<div class="container">
    <div class="col-8">
        <div class="d-flex align-item-center">
            @if(Auth::user()->avatar)
                <img src="{{asset('/storage/avatars/'.auth()->user()->avatar)}}" alt="avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover"/>
            @else
                <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover"/>
            @endif
            <h1 class="ms-3">{{ auth()->user()->name }}</h1>
        </div>
        <form action="{{ route('avatar.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-2">
                <input type="file" name="avatar">
                <button type="submit" class="btn btn-primary">upload</button>
                
            </div>
        </form>

    </div>
</div>
@endsection