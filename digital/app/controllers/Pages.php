<?php
  /**
   * Pages Controller
   * INDEX Page
   */

  class Pages extends Controller {
    public function __construct(){
      // Post Model
      $this->postModel = $this->model('Post');
    }

    public function index(){
      $posts = $this->postModel->listAllPosts();
      $postsCount = $this->postModel->getPostsCount();
      $data = [
        "posts" => $posts,
        'carousel-posts' => $this->postModel->getCarouselItems(),
        "posts_count" => $postsCount,
        "count" => ceil($postsCount / 9),
      ];
      $this->view('pages/index', $data);
    }

    public function page($id){
      $postsCount = $this->postModel->getPostsCount();
      $postsPerPage = 9;
      $data = [
        "posts" => $this->postModel->paginatePosts($id, $postsPerPage),
        "posts_count" => $postsCount,
        "count" => ceil($postsCount / $postsPerPage),
        "id" => $id,
      ];
      $this->view('pages/page', $data);
    }
  }