<?php

  /**
   * Posts Controller
   */

  class Admin_posts extends Controller {
    // Constructor
    public function __construct(){
      // Post Model
      $this->postModel = $this->model('Post');
      // Category Model
      $this->categoryModel = $this->model('Category');
    }
    
    // Add Post
    public function add(){
      // Check if server request method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Get Categories
        $categories = $this->categoryModel->getCategories();

        // Data
        $data = [
          "title" => trim($_POST['title']),
          "title_error" => '',
          "details" => $_POST['details'],
          "category_name" => $_POST['category'],
          "image" => $_FILES['image']['name'],
          "image_location" => $_FILES['image']['tmp_name'],
          "categories" => $categories,
        ];

        // Upload Image To Server
        move_uploaded_file($data['image_location'], APPROOT.'/../public/assets/images/posts/'.$data['image']);

        // Server Side Validation
        
        // Validate Category
        if($data['category_name'] == 'Uncategorized'){
          if(!$this->categoryModel->getUncategorized()){
            $this->categoryModel->addUncategorized();
          }
        }

        // Validate Title
        if(empty($data['title'])){
          $data['title_error'] = 'Title is required';
        } else {
          if(strlen($data['title']) < 5){
            $data['title_error'] = 'Title must be at least 5 characters';
          }
        }
        

        // Check For Errors
        if(!empty($data['title_error'])){
          // Rerender Form With Data
          $this->view('admin/posts/add', $data);
        } else {
          // Save To DB
          if($this->postModel->addPost($data)){
            flash('post_added', 'New Post Added');
            redirect('admin/posts');
          } else {
            die('Something Went Wrong');
          }
        }
      } else {
        $categories = $this->categoryModel->getCategories();
        $data = [
          "title" => '',
          "title_error" => '',
          "details" => '',
          "category_name" => '',
          "image" => '',
          "categories" => $categories,
        ];
        $this->view('admin/posts/add', $data);
      }
    }

    // Posts
    public function index(){
      $data = [
        "posts" => $this->postModel->getPosts(),
      ];
      $this->view('admin/posts/index', $data);
    }

    // Approve Post
    public function approve($id){
      // Check if ID Exists In DB
      if(!$this->postModel->getPostById($id)){
        flash('post_id_not_exists', 'No Post Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/posts');
        return;
      }

      // Check For Session
      if($this->postModel->getPostById($id)['User_ID'] != $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        redirect('admin/posts');
        return;
      }

      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->postModel->approvePost($id)){
          flash('post_approved', 'Post Approved');
          redirect('admin/posts');
        } else {
          die('Something Went Wrong');
        }
      } else {
        redirect('admin/posts');
      }
    }

    // Draft Post
    public function draft($id){
      // Check if ID Exists In DB
      if(!$this->postModel->getPostById($id)){
        flash('post_id_not_exists', 'No Post Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/posts');
        return;
      }

      // Check For Session
      if($this->postModel->getPostById($id)['User_ID'] != $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        flash('post_draft_owner', 'You can only draft posts added by you');
        redirect('admin/posts');
        return;
      }

      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->postModel->draftPost($id)){
          flash('post_drafted', 'Post Drafted');
          redirect('admin/posts');
        } else {
          die('Something Went Wrong');
        }
      } else {
        redirect('admin/posts');
      }
    }

    // Delete Post
    public function delete($id){
      // Check if ID Exists In DB
      if(!$this->postModel->getPostById($id)){
        flash('post_id_not_exists', 'No Post Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/posts');
        return;
      }

      
      // Check For Session
      if($this->postModel->getPostById($id)['User_ID'] != $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        flash('post_delete_owner', 'You can only delete posts added by you');
        redirect('admin/posts');
        return;
      }

      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->postModel->deletePost($id)){
          flash('post_deleted', 'Post Deleted');
          redirect('admin/posts');
        } else {
          die('Something Went Wrong');
        }
      } else {
        redirect('admin/posts');
      }
    }

    // Edit Post
    public function edit($id){

      // Check if ID Exists In DB
      if(!$this->postModel->getPostById($id)){
        flash('post_id_not_exists', 'No Post Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/posts');
        return;
      }
      
      // Check For Session
      if($this->postModel->getPostById($id)['User_ID'] != $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        flash('post_edit_owner', 'You can only edit posts added by you');
        redirect('admin/posts');
        return;
      }

      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Input Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Get Categories
        $categories = $this->categoryModel->getCategories();

        // Data
        $data = [
          "title" => trim($_POST['title']),
          "title_error" => '',
          "details" => $_POST['details'],
          "category_name" => $_POST['category'],
          "image" => $_FILES['image']['name'],
          "image_location" => $_FILES['image']['tmp_name'],
          "categories" => $categories,
        ];

        if($data['image'] == ''){
          $data['image'] = $this->postModel->getPostById($id)['Image'];
        } else {
          // Upload Image To Server
          move_uploaded_file($data['image_location'], APPROOT.'/../public/assets/images/posts/'.$data['image']);
        }

        // Server Side Validation

        // Validate Title
        if(empty($data['title'])){
          $data['title_error'] = 'Title is required';
        } else {
          if(strlen($data['title']) < 5){
            $data['title_error'] = 'Title must be at least 5 characters';
          }
        }
        
        // Check For Errors
        if(!empty($data['title_error'])){
          // Rerender Form With Data
          $this->view('admin/posts/add', $data);
        } else {
          // Save To DB
          if($this->postModel->updatePost($data, $id)){
            flash('post_updated', 'Post Updated');
            redirect('admin/posts/edit/'.$id);
          } else {
            die('Something Went Wrong');
          }
        }
      } else {
        // Load Form With Data
        $post = $this->postModel->getPostById($id);
        $categories = $this->categoryModel->getCategories();
        $data = [
          "ID" => $post['ID'],
          "title" => $post['Title'],
          "title_error" => '',
          "details" => $post['Details'],
          "category_name" => $post['Category_Name'],
          "image" => $post['Image'],
          "categories" => $categories,
        ];
        $this->view('admin/posts/edit', $data);
      }
    }
  }