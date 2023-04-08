@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row"> 
        {{-- Menu Bar --}}
        <div class="col-lg-3 bg-light">
                <aside class="bd-sidebar">
                    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sideMenu" aria-labelledby="sideMenuLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="sideMenuleLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sideMenu" aria-label="Close"></button>
                        </div>
                            {{-- <ul class="nav nav-pills nav-fill flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled">Disabled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled">Disabled</a>
                                </li>
                            </ul> --}}
                    </div>
                </aside>

        </div>
        {{-- Timeline --}}
        <div class="col-sm-9 col-lg-6">
            {{-- Create Post --}}
            <div class="bg-white p-3 mt-3 rounded border">
                <!-- avatar -->
                <div class="d-flex" type="button">
                  <div class="p-1">
                    @if(Auth::user()->avatar)
                      <img src="{{asset('/storage/avatars/'.auth()->user()->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @else
                      <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @endif
                  </div>
                  <input type="text" class="form-control rounded-pill border bg-gray pointer" placeholder="What's on your mind, {{ auth()->user()->name }}?" data-bs-toggle="modal" data-bs-target="#createModal"/>
                  {{-- <button type="button" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#createModal">Create New Post</button> --}}
                </div>
            </div>
            {{-- post Modal --}}
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-backdrop="true">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">
                      <!-- head -->
                      <div class="modal-header align-items-center">
                        <h5 class="text-dark text-center w-100 m-0" id="createModalLabel">Create Post</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- body -->
                      <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                        <div class="my-1 p-1">
                          <div class="d-flex flex-column">
                            <!-- name -->
                            <div class="d-flex align-items-center">
                              <div class="p-2">
                                @if(Auth::user()->avatar)
                                  <img src="{{asset('/storage/avatars/'.auth()->user()->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                                @else
                                  <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                                @endif
                              </div>
                              <div>
                                <p class="m-0 fw-bold">{{ auth()->user()->name }}</p>
                              </div>
                            </div>
                            <!-- text -->
                            <div>
                              <textarea cols="30" rows="5" name="body" class="form-control border-0"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                              <input type="file" name="image">
                              <button class="btn-close p"></button>
                            </div>
                            <!-- options -->
                            {{-- <div class="d-flex justify-content-between border border-1 border-light rounded p-3 mt-3">
                              <p class="m-0">Add to your post</p>
                              <div>
                                <i class="fas fa-images fs-5 text-success pointer mx-1"></i>
                                <i class="fas fa-user-check fs-5 text-primary pointer mx-1"></i>
                                <i class="fas fa-smile fs-5 text-warning pointer mx-1"></i>
                                <i class="fas fa-map-marker-alt fs-5 text-info pointer mx-1"></i>
                                <i class="fas fa-microphone fs-5 text-danger pointer mx-1"></i>
                                <i class="fas fa-ellipsis-h fs-5 text-muted pointer mx-1"></i>
                              </div>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                      <!-- footer -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Post</button>
                      </div>
                      </form>
                    </div>
                </div>
            </div>

            {{-- posts --}}

            @foreach($posts as $post)
            <div class="bg-white p-4 rounded border mt-3">
                <!-- author -->
                <div class="d-flex justify-content-between">
                  <!-- avatar -->
                  <div class="d-flex">
                    @if($post->user->avatar)
                      <img src="{{asset('/storage/avatars/'.$post->user->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @else
                      <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    @endif
                    <div>
                      <p class="m-0 fw-bold">{{ $post->user->name }}</p>
                      <span class="text-muted fs-7">July 17 at 1:23 pm</span>
                    </div>
                  </div>
                  <!-- edit -->
                  @if(auth()->user()->id == $post->user->id)
                    <i class="fas fa-ellipsis-h" type="button" id="post1Menu" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <!-- edit menu -->
                    <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1Menu">
                      <li class="d-flex align-items-center">
                        <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Edit Post</a>
                      </li>
                      <li class="d-flex align-items-center">
                        <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" onclick="alert('are you sure you want to delete this post!');document.getElementById('delete-post-{{ $post->id }}').submit();">Delete Post</a>
                        <form style="display: none" id="delete-post-{{ $post->id }}" action="{{ route('post.delete', $post->id) }}" method="post">
                          @csrf
                        </form>
                      </li>
                    </ul>
                  @endif
                </div>
                <!-- post content -->
                <div class="mt-3">
                  <!-- content -->
                  <div>
                    <p>
                      {{ $post->body }}
                    </p>
                    @if($post->photo)
                    <img src="{{ asset('/storage/post-image/'.$post->photo) }}" alt="post image" class="img-fluid rounded"/> 
                    @endif
                    
                  </div>
                  <!-- likes & comments -->

                  <div class="post__comment d-flex">
                    <div class=" d-flex justify-content-start mt-3">
                      <i class="text-primary fas fa-thumbs-up me-2 mt-1 ms-2"></i>
                      <p class="m-0 text-muted fs-7" data-bs-toggle="modal" data-bs-target="#likeModal">Likes</p>
                    </div>
                  {{-- Like Modal --}}
                      <div class="modal fade" id="likeModal" tabindex="-1" aria-labelledby="likeModalLabel" aria-hidden="true" data-bs-backdrop="true">
                        <div class="modal-dialog modal-dialog-center">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div >
                                  @foreach($post->like as $like)
                                  <div class="d-flex justify-content-start mt-1">
                                      @if($like->user->avatar)
                                        <img src="{{asset('/storage/avatars/'.$like->user->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                                      @else
                                        <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                                      @endif
                                      <p>{{ $like->user->name }}</p>
                                  </div>

                                  @endforeach
                              </div>
  
                            </div>
                          </div>
                        </div>

                          
                          

                      </div>
                    <!-- likes -->
                    <div class="d-flex align-items-center top-0 start-0 position-absolute" style="height: 50px; z-index: 5">
                      <div class="me-2">
                        <i class="text-primary fas fa-thumbs-up"></i>
                        <i class="text-danger fab fa-gratipay"></i>
                        <i class="text-warning fas fa-grin-squint"></i>
                      </div>
                    </div>                                  
                  </div> 

                  <!-- comment & like bar -->
                  <!-- comments start--> 
                  
                  <div>
                      <div class="d-flex">
                        <a class="mx-2 cursor-pointer text-decoration-none text-muted" href="{{ '/home/'.$post->id.'/viewpost' }}">
                          <span class="fas fa-comment-alt text-primary"></span>
                          Comments
                        </a>
                      </div>
                      <hr />
                      <!-- comment & like bar -->
                      <div class="d-flex justify-content-around">
                        <div id="{{ 'post-like-'.$post->id }}" onclick="event.preventDefault();document.getElementById('like-btn-{{ $post->id }}').submit();" class="rounded d-flex justify-content-center align-items-center text-secondary">
                          {{-- <a href="" class="text-decoration-none text-secondary"> --}}
                          <span class="fas fa-thumbs-up me-2"></span>
                          <form style="display:none" id="{{ 'like-btn-'.$post->id }}" action="{{ route('post.like', $post->id) }}" method="post">
                            @csrf
                          </form>
                          Like
                        </div>
                        @foreach($post->like as $like)
                        @if($like->user_id == auth()->user()->id)
                          {{-- <div onclick="event.preventDefault();document.getElementById('like-true')" class="rounded d-flex justify-content-center align-items-center pointer text-primary">
                            <span class="fas fa-thumbs-up me-2"></span>
                            <form style="display:none" id="like-true" action="{{ route('post.like', $post->id) }}" method="post">
                              @csrf
                            </form>
                            Like
                          </div> --}}
                          <script>
                            document.getElementById('post-like-{{ $post->id }}').setAttribute('class', 'rounded d-flex justify-content-center align-items-center pointer text-primary');
                          </script>
                        @endif
                        @endforeach


                          <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ '/home/'.$post->id.'/viewpost' }}" class="text-decoration-none text-muted">
                              <span class="fas fa-comment-alt"></span>
                              Comment
                            </a>
                          </div>                       
                      </div>                   
                  </div>
                  <!-- end -->
                </div>
            </div>
            @endforeach
        </div>
        {{-- Chatbar --}}
        <div class="col-3 bg-light">
            {{-- <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p>
            <p>this is chatbar and many other things</p> --}}
        </div>
    </div>
</div>
    
@endsection