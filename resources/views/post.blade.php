@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
          @if ($errors->has('error'))
            <p class="text-danger fs-4">{{ $errors->first('error') }}</p>
          @endif
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
                      <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" href="{{ route('post.edit', $post->id) }}">Edit Post</a>
                    </li>
                    <li class="d-flex align-items-center">
                      <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" onclick="alert('are you sure you want to delete this post!');document.getElementById('delete-post-{{ $post->id }}').submit();">Delete Post</a>
                      <form style="display: none" id="delete-post-{{ $post->id }}" action="{{ route('post.delete', $post->id) }}" method="post">
                        @csrf
                      </form>
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
                            <div>
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

                  <!-- comments start-->
                    
                  </div>
                  <div>
                    <div class="border-0">

                        <div class="d-flex">
                          <a class="mx-2 cursor-pointer text-decoration-none text-muted disabled" href="{{ '/home/'.$post->id.'/viewpost' }}" onclick="event.preventDefault();">
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
                            @if(auth()->user()->id == $comment->user->id)
                            <i class="fas fa-ellipsis-h text-blue pointer" id="post1CommentMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <!-- menu -->
                            <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1CommentMenuButton">
                              <li class="d-flex align-items-center">
                                <a class=" dropdown-item d-flex justify-content-around align-items-center fs-7" data-bs-toggle="modal" data-bs-target="#commentModal">Edit Comment</a>
                              </li>
                              <li class="d-flex align-items-center">
                                <a class="dropdown-item d-flex justify-content-around align-items-center fs-7" onclick="alert('Are you sure you want to delete this comment!');document.getElementById('delete-comment-{{ $comment->id }}').submit()">Delete Comment</a>

                                <form style="display: none" id="{{ 'delete-comment-'.$comment->id }}" action="{{ route('comment.delete', $comment->id) }}" method="post">
                                  @csrf
                                </form>

                              </li>
                            </ul>
                            @endif
                          </div>
                          <p class="fw-bold m-0">{{ $comment->user->name }}</p>
                          <p class="m-0 fs-7 bg-gray p-2 rounded">
                            {{ $comment->body }}
                          </p>
                        </div>
                      </div>
                {{-- Comment Edit Modal --}}
                      <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true" data-bs-backdrop="true">
                        <div class="modal-dialog modal-dialog-center">
                          <div class="modal-content">
                            <div class="modal-body">
                              <form action="{{ route('comment.update', $comment->id) }}" method="post">
                                @csrf
                                <div>
                                  <textarea class="form-control border" name="body" id="" cols="30" rows="5">{{ $comment->body }}</textarea>                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                              </form>          
                            </div>
                          </div>
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