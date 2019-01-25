<?php

  /**
   * Category Model
   */

  class Category {
    private $db;

    // Constructor
    public function __construct(){
      $this->db = new Database;
    }

    // Check For Category Name
    public function getCategoryByCategoryName($catname){
      $this->db->query('SELECT * FROM categories WHERE Category_Name = :catname');
      $this->db->bindValues('catname', $catname);
      $rowCount = $this->db->rowCount();
      if($rowCount > 0){
        return true;
      } else {
        return false;
      }
    }

    // Add Category
    public function addCategory($catname, $userid){
      $this->db->query('INSERT INTO categories (Category_Name, User_ID) VALUES (:catname, :userid)');
      $this->db->bindValues('catname', $catname);
      $this->db->bindValues('userid', $userid);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get All Categories
    public function getCategories(){
      $this->db->query('SELECT * FROM categories');
      return $this->db->multi();
    }

    // Get All Categories Except Uncategorized
    public function getCategoriesExceptUnCategorized(){
      $this->db->query('SELECT * FROM categories WHERE Category_Name != :category');
      $this->db->bindValues("category", "Uncategorized");
      return $this->db->multi();
    }

    // Get Category By ID
    public function getCategoryById($id){
      $this->db->query('SELECT * FROM categories WHERE ID = :id');
      $this->db->bindValues("id", $id);
      $categoryrow = $this->db->single();
      return $categoryrow;
    }

    // Update Category
    public function updateCategory($category, $id){
      $this->db->query('UPDATE categories SET Category_Name = :category WHERE ID = :id');
      $this->db->bindValues('category', $category);
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Category
    public function deleteCategory($id){
      $this->db->query('DELETE FROM categories WHERE ID = :id');
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get Category By Category Name Exclude Old Category Name
    public function getCategoryByCategoryNameExcludeOldCategory($category, $id){
      $this->db->query('SELECT * FROM categories WHERE Category_Name = :category AND Category_Name != (SELECT Category_Name FROM categories WHERE ID = :id)');
      $this->db->bindValues('category', $category);
      $this->db->bindValues('id', $id);
      $rowCount = $this->db->rowCount();
      if($rowCount > 0){
        return true;
      } else {
        return false;
      }
    }

    // Check For Uncategorized Section
    public function getUncategorized(){
      $this->db->query('SELECT * FROM categories WHERE Category_Name = :category');
      $this->db->bindValues("category", "Uncategorized");
      $rowCount = $this->db->rowCount();
      if($rowCount > 0){
        return true;
      } else {
        return false;
      }
    }

    // Add Uncategorized To categories Table
    public function addUncategorized(){
      $this->db->query('INSERT INTO categories (Category_Name) VALUES (:category_name)');
      $this->db->bindValues("category_name", "Uncategorized");
      return $this->db->execute();
    }
  }