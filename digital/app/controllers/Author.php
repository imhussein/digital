<?php

  /**
   * Author
   */

  class Author extends Controller {
    // Constructor
    public function __construct(){
      $this->postModel = $this->model('Post');
    }

    // Index
    public function index($author_id){
      $data = [
        "posts" => $this->postModel->getPostsByAuthorId($author_id),
      ];
      $this->view("pages/author", $data);
    }
  }