@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 bg-light">
                <aside class="bd-sidebar">
                    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sideMenu" aria-labelledby="sideMenuLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="sideMenuleLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sideMenu" aria-label="Close"></button>
                        </div>
                                <ul class="nav nav-pills nav-fill flex-column">
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
                                </ul>
                    </div>
                </aside>

        </div>
        <div class="col-sm-9 col-lg-6">
            <div class="bg-white p-3 mt-3 rounded border">
                <!-- avatar -->
                <div class="d-flex" type="button">
                  <div class="p-1">
                    <img
                      src="https://source.unsplash.com/collection/happy-people"
                      alt="avatar"
                      class="rounded-circle me-2"
                      style="width: 38px; height: 38px; object-fit: cover"
                    />
                  </div>
                  <input type="text" class="form-control rounded-pill border-0 bg-gray pointer" disabled placeholder="What's on your mind, John?" data-bs-toggle="modal" data-bs-target="createModal"/>
                  {{-- <button type="button" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#createModal">Create New Post</button> --}}
                </div>
            </div>

            {{-- posts --}}

            <div class="bg-white p-4 rounded border mt-3">
                <!-- author -->
                <div class="d-flex justify-content-between">
                  <!-- avatar -->
                  <div class="d-flex">
                    <img src="https://source.unsplash.com/collection/happy-people" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover"/>
                    <div>
                      <p class="m-0 fw-bold">John</p>
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
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                      Quae fuga incidunt consequatur tenetur doloremque officia
                      corrupti provident tempore vitae labore?
                    </p>
                    <img src="https://source.unsplash.com/random/12" alt="post image" class="img-fluid rounded"/>
                  </div>
                  <!-- likes & comments -->
                  <div class="post__comment mt-3 position-relative">
                    <!-- likes -->
                    <div class="d-flex align-items-center top-0 start-0 position-absolute" style="height: 50px; z-index: 5">
                      <div class="me-2">
                        <i class="text-primary fas fa-thumbs-up"></i>
                        <i class="text-danger fab fa-gratipay"></i>
                        <i class="text-warning fas fa-grin-squint"></i>
                      </div>
                      <p class="m-0 text-muted fs-7">Phu, Tuan, and 3 others</p>
                    </div>
                    <!-- comments start-->
                    <div class="accordion" id="accordionExample">
                      <div class="accordion-item border-0">
                        <!-- comment collapse -->
                        <h2 class="accordion-header" id="headingTwo">
                          <div
                            class="accordion-button collapsed pointer d-flex justify-content-end" data-bs-toggle="collapse" data-bs-target="#collapsePost1" aria-epanded="false" aria-controls="collapsePost1">
                            <p class="m-0">2 Comments</p>
                          </div>
                        </h2>
                        <hr />
                        <!-- comment & like bar -->
                        <div class="d-flex justify-content-around">
                          <div
                            class="dropdown-item rounded d-flex justify-content-center align-items-center pointer text-muted p-1">
                            <i class="fas fa-thumbs-up me-3"></i>
                            <p class="m-0">Like</p>
                          </div>
                          <div
                            class="dropdown-item rounded d-flex justify-content-center align-items-center pointer text-muted p-1" data-bs-toggle="collapse" data-bs-target="#collapsePost1" aria-expanded="false" aria-controls="collapsePost1">
                            <i class="fas fa-comment-alt me-3"></i>
                            <p class="m-0">Comment</p>
                          </div>
                        </div>
                        <!-- comment expand -->
                        <div id="collapsePost1" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                          <hr />
                          <div class="accordion-body">
                            <!-- comment 1 -->
                            <div class="d-flex align-items-center my-1">
                              <!-- avatar -->
                              <img src="https://source.unsplash.com/collection/happy-people" alt="avatar" class="rounded-circle me-2" style=" width: 38px; height: 38px; object-fit: cover;"/>
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
                                      <a class=" dropdown-item d-flex justify-content-around align-items-center fs-7" href="#">Delete Comment</a>
                                    </li>
                                  </ul>
                                </div>
                                <p class="fw-bold m-0">John</p>
                                <p class="m-0 fs-7 bg-gray p-2 rounded">
                                  Lorem ipsum dolor sit amet, consectetur
                                  adipiscing elit.
                                </p>
                              </div>
                            </div>
                            <!-- comment 2 -->
                            <div class="d-flex align-items-center my-1">
                              <!-- avatar -->
                              <img src="https://source.unsplash.com/random/2" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover;"/>
                              <!-- comment text -->
                              <div class="p-3 rounded comment__input w-100">
                                <p class="fw-bold m-0">Jerry</p>
                                <p class="m-0 fs-7 bg-gray p-2 rounded">
                                  Lorem ipsum dolor sit amet, consectetur
                                  adipiscing elit.
                                </p>
                              </div>
                            </div>
                            <!-- create comment -->
                            <form class="d-flex my-1">
                              <!-- avatar -->
                              <div>
                                <img src="https://source.unsplash.com/collection/happy-people" alt="avatar" class="rounded-circle me-2" style=" width: 38px; height: 38px; object-fit: cover;"/>
                              </div>
                              <!-- input -->
                              <input type="text" class="form-control border-0 rounded-pill bg-gray" placeholder="Write a comment"/>
                            </form>
                            <!-- end -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end -->
                  </div>
                </div>
              </div>
        </div>
        <div class="col-3">
            <p>this is chatbar and many other things</p>
        </div>
    </div>
</div>
    
@endsection