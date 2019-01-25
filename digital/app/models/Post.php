<?php

  /**
   * Post Model
   */

  class Post {
    private $db;
    
    // Constructor
    public function __construct(){
      $this->db = new Database;
    }

    // Add Post
    public function addPost($data){
      $status = ($_SESSION['role'] == 'Admin') ? 'Approved' : 'Draft';
      $this->db->query('INSERT INTO posts (Title, Details, Category_Name, User_ID, Image, Status, Created_At) VALUES (:title, :details, :category_name, :userid, :image, :status, CURDATE())');
      $this->db->bindValues("title", $data['title']);
      $this->db->bindValues("details", $data['details']);
      $this->db->bindValues("category_name", $data['category_name']);
      $this->db->bindValues("userid", $_SESSION['userid']);
      $this->db->bindValues("image", $data['image']);
      $this->db->bindValues("status", $status);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get Posts
    public function getPosts(){
      $userRole = ($_SESSION['role'] == 'Admin') ? true : false;
      if($userRole){
        $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name ORDER BY posts.ID DESC');
      } else {
        $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.User_ID = :usersessionid ORDER BY posts.ID DESC');
        $this->db->bindValues("usersessionid", $_SESSION['userid']);
      }
      $posts = $this->db->multi();
      return $posts;
    }

    // Get Post By ID
    public function getPostById($id){
      $this->db->query("SELECT * FROM posts WHERE ID = :id");
      $this->db->bindValues("id", $id);
      $row = $this->db->single();
      $postCount = $this->db->rowCount();
      if($postCount > 0){
        return $row;
      } else {
        return false;
      }
    }


    // Approve Post
    public function approvePost($id){
      $this->db->query('UPDATE posts SET Status = :status WHERE ID = :id');
      $this->db->bindValues("id", $id);
      $this->db->bindValues("status", "Approved");
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Draft Post Post
    public function draftPost($id){
      $this->db->query('UPDATE posts SET Status = :status WHERE ID = :id');
      $this->db->bindValues("id", $id);
      $this->db->bindValues("status", "Draft");
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Post
    public function deletePost($id){
      $this->db->query("DELETE FROM posts WHERE ID = :id");
      $this->db->bindValues("id", $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update Post
    public function updatePost($data, $id){
      $this->db->query('UPDATE posts SET Title = :title, Details = :details, Image = :image, Category_Name = :category_name WHERE ID = :id');
      $this->db->bindValues("id", $id);
      $this->db->bindValues("title", $data['title']);
      $this->db->bindValues("details", $data['details']);
      $this->db->bindValues("image", $data['image']);
      $this->db->bindValues("category_name", $data['category_name']);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Homepage Posts
    public function listAllPosts(){
      $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.Status = :poststatus ORDER BY posts.ID DESC');
      $this->db->bindValues("poststatus", 'Approved');
      $posts = $this->db->multi();
      return $posts;
    }

    // Carousel Items
    public function getCarouselItems(){
      $this->db->query('SELECT * FROM posts ORDER BY ID DESC LIMIT 5');
      $slides = $this->db->multi();
      return $slides;
    }

    // Get Posts Count
    public function getPostsCount(){
      $this->db->query('SELECT * FROM posts WHERE Status = :status');
      $this->db->bindValues("status", "Approved");
      $rowCount = $this->db->rowCount();
      return $rowCount;
    }

    // Paginate Posts
    public function paginatePosts($id, $postsPerPage){
      $sikpped = ($id * $postsPerPage) - $postsPerPage;
      $this->db->query("SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.Status = :poststatus ORDER BY posts.ID DESC LIMIT $sikpped, $postsPerPage");
      $this->db->bindValues("poststatus", 'Approved');
      $posts = $this->db->multi();
      return $posts;
    }

    // Get Pots By Category Name
    public function getPostsByCategoryName($category_name){
      $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.Status = :poststatus AND posts.Category_Name = :category_name ORDER BY posts.ID DESC');
      $this->db->bindValues("category_name", $category_name);
      $this->db->bindValues("poststatus", "Approved");
      $posts = $this->db->multi();
      return $posts;
    }

    // Get Posts By Author ID
    public function getPostsByAuthorId($author_id){
      $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.Status = :poststatus AND posts.User_ID = :userid ORDER BY posts.ID DESC');
      $this->db->bindValues("userid", $author_id);
      $this->db->bindValues("poststatus", "Approved");
      $posts = $this->db->multi();
      return $posts;
    }

    // Get Post By Author ID
    public function getPostByPostId($postid){
      $this->db->query('SELECT *, posts.Image as PostImage, users.Image as UserImage, users.ID as UserID, posts.ID as PostID, categories.ID as CategoryID, posts.Created_at as PostCreatedAt, users.Created_at as UserCreatedAt, categories.Created_at as CategoryCreatedAt, users.Status as UserStatus, posts.Status as PostStatus FROM posts INNER JOIN users ON posts.User_ID = users.ID INNER JOIN categories ON posts.Category_Name = categories.Category_Name WHERE posts.ID = :postid');
      $this->db->bindValues("postid", $postid);
      $posts = $this->db->single();
      return $posts;
    }

    // Get Related Posts
    public function getRelatedPosts($category, $postid){
      $this->db->query("SELECT * FROM posts WHERE Category_Name = :category_name AND ID != :id ORDER BY ID DESC LIMIT 3");
      $this->db->bindValues("id", $postid);
      $this->db->bindValues("category_name", $category);
      $posts = $this->db->multi();
      return $posts;
    }
  }