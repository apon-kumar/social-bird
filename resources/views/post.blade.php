@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
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
                  <i class="fas fa-ellipsis-h" type="button" id="post1Menu" data-bs-toggle="dropdown" aria-expanded="false"></i>
                  <!-- edit menu -->
                  <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1Menu">
                    <li class="d-flex align-items-center">
                      <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Edit Post</a>
                    </li>
                    <li class="d-flex align-items-center">
                      <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Delete Post</a>
                    </li>
                  </ul>
                </div>
                <!-- post content -->
                <div class="mt-3">
                  <!-- content -->
                  <div>
                    <p>
                      {{ $post->body }}
                    </p>
                    @if($post->photo)
                    <img src="https://source.unsplash.com/random/12" alt="post image" class="img-fluid rounded"/> 
                    @endif
                    
                  </div>
                  <!-- likes & comments -->
        
                  <div class="post__comment d-flex">
                    <i class="text-primary fas fa-thumbs-up px-2 pt-1"></i>
                    <p class="m-0 text-muted fs-7">Phu, Tuan, and 3 others</p>
                    <!-- likes -->
                    {{-- <div class="d-flex align-items-center top-0 start-0 position-absolute" style="height: 50px; z-index: 5">
                      <div class="me-2">
                        <i class="text-primary fas fa-thumbs-up"></i>
                        <i class="text-danger fab fa-gratipay"></i>
                        <i class="text-warning fas fa-grin-squint"></i>
                      </div>
                  </div> --}}
                  <!-- comments start-->
                    
                  </div>
                  <div>
                    <div class="border-0">

                        <div class="d-flex">
                          <p class="mx-2">2 Comments</p>
                        </div>
                      <hr />
                      <!-- comment & like bar -->
                      <div class="d-flex justify-content-around">
                        <div
                          class="rounded d-flex justify-content-center align-items-center pointer text-secondary p-1">
                          <i class="fas fa-thumbs-up me-2"></i>
                          <p class="m-0">Like</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center pointer text-secondary p-1" id="comment_btn" data-bs-toggle="collapse" data-bs-target="#collapsePost1" aria-expanded="false" aria-controls="collapsePost1">
                            <i class="fas fa-comment-alt me-3"></i>
                            <p class="m-0">Comment</p> 
                        </div>
                            {{-- <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ '/home/'.$post->id.'/viewpost' }}" class="text-decoration-none text-muted">
                              <span class="fas fa-comment-alt"></span>
                              Comment
                            </a>
                            </div> --}}
                        
                      </div>
                      {{-- comments --}}
                      @foreach ($comments as $comment)
                      <div class="d-flex align-items-center my-1">
                        <!-- avatar -->
                        @if($comment->user->avatar)
                          <img src="{{asset('/storage/avatars/'.$comment->user->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                        @else
                          <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                        @endif
                        <!-- comment text -->
                        <div class="p-3 rounded comment__input w-100">
                          <!-- comment menu of author -->
                          <div class="d-flex justify-content-end">
                            <!-- icon -->
                            <i class="fas fa-ellipsis-h text-blue pointer" id="post1CommentMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <!-- menu -->
                            <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1CommentMenuButton">
                              <li class="d-flex align-items-center">
                                <a class=" dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Edit Comment</a>
                              </li>
                              <li class="d-flex align-items-center">
                                <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Delete Comment</a>
                              </li>
                            </ul>
                          </div>
                          <p class="fw-bold m-0">{{ $comment->user->name }}</p>
                          <p class="m-0 fs-7 bg-gray p-2 rounded">
                            {{ $comment->body }}
                          </p>
                        </div>
                      </div>
                      @endforeach
                      <form class="d-flex my-1" action="{{ route('comment.create', $post->id) }}" method="post">
                        @csrf
                          <!-- avatar -->
                          <div>
                            @if(Auth::user()->avatar)
                              <img src="{{asset('/storage/avatars/'.auth()->user()->avatar)}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                            @else
                              <img src="{{asset('/storage/avatars/default_avatar.png')}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                            @endif
                          </div>
                          <!-- input -->
                          <input type="text" name="comment_body" class="form-control border-0 rounded-pill bg-gray" placeholder="Write a comment"/>
                          <button type="submit" class="btn btn-primary">COMMENT</button>
                      </form>

                    </div>
                  </div>
                  <!-- end -->
                </div>
            </div>
        </div>
    </div>

</div>

@endsection