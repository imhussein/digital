<?php

  /**
   * Categories
   */

  class Categories extends Controller {
    // Constructor
    public function __construct(){
      $this->postModel = $this->model('Post');
    }

    // Index
    public function index($category_name){
      $data = [
        "posts" => $this->postModel->getPostsByCategoryName($category_name),
      ];
      $this->view("pages/categories", $data);
    }
  }