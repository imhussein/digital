<?php

  /**
   * Post Index Page
   */

  class Single extends Controller {
    // Constructor
    public function __construct(){
      $this->postModel = $this->model('Post');
    }

    // Index
    public function index($postid){
      $data = [
        "post" => $this->postModel->getPostByPostId($postid),
        "related_posts" => $this->postModel->getRelatedPosts($this->postModel->getPostById($postid)['Category_Name'], $postid),
      ];
      $this->view('pages/single', $data);
    }
  }