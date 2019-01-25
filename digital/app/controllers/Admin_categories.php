<?php
  
  /**
   * Categoriess Class
   * ADD & UPDATE & READ & DELETE
   */

  class Admin_categories extends Controller {
    // Constructor
    public function __construct(){
      $this->categoryModel = $this->model('Category');
    }

    public function index(){
      $categories = $this->categoryModel->getCategoriesExceptUnCategorized();
      $data = [
        "category" => '',
        "category_error" => '',
        'categories' => $categories,
      ];
      $this->view('admin/categories/index', $data);
    }

    // Add Category
    public function add(){
      // Check Server Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Input Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $categories = $this->categoryModel->getCategoriesExceptUnCategorized();
        // Data
        $data = [
          "category" => trim($_POST['category']),
          "category_error" => '',
          'categories' => $categories,
        ];

        // Server side validation
        if(empty($data['category'])){
          $data['category_error'] = 'Category can\'t be empty';
        } else {
          if(strlen($data['category']) < 3){
            $data['category_error'] = 'Category must be at least 3 characters';
          } else {
            if($this->categoryModel->getCategoryByCategoryName($data['category'])){
              $data['category_error'] = 'Category Exists';
            }
          }
        }

        // Check For Error
        if(!empty($data['category_error'])){
          // Rerender Form With Data
          $this->view('admin/categories/add', $data);
        } else {
          // Save To DB
          if($this->categoryModel->addCategory($data['category'], $_SESSION['userid'])){
            flash('category_added', 'Category Added');
            redirect('admin/categories');
          }
        }
      } else {
        // Load Form With Data
        $categories = $this->categoryModel->getCategoriesExceptUnCategorized();
        $data = [
          "category" => '',
          "category_error" => '',
          'categories' => $categories,
        ];
        $this->view('admin/categories/index', $data);
      }
    }

    // Edit Category
    public function edit($id){
      // Check For Owner
      if($this->categoryModel->getCategoryById($id)['User_ID'] !== $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        flash('category_owner_error', 'You can only edit or delete categories add by you', 'btn btn-message-lg red darken-4');
        redirect('admin/categories');
        return;
      }

      // Check If Category ID Exists
      if(!$this->categoryModel->getCategoryById($id)){
        flash('category_not_exists', 'No Category Found With This ID', 'btn btn-message-lg red darken-4');
        redirect('admin/categories');
        return;
      }
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Input Data
        filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $categories = $this->categoryModel->getCategoriesExceptUnCategorized();
        $data = [
          "category" => trim($_POST['category']),
          "category_error" => '',
          'categories' => $categories,
          'id' => $id,
        ];
        // Server side validation
        if(empty($data['category'])){
          $data['category_error'] = 'Category can\'t be empty';
        } else {
          if(strlen($data['category']) < 3){
            $data['category_error'] = 'Category must be at least 3 characters';
          } else {
            if($this->categoryModel->getCategoryByCategoryNameExcludeOldCategory($data['category'], $id)){
              $data['category_error'] = 'Category Already Exists';
            }
          }
        }

        if(!empty($data['category_error'])){
          // Rerender Form With Errors And Data
          $this->view('admin/categories/edit', $data);
        } else {
          // Update Category In DB
          if($this->categoryModel->updateCategory($data['category'], $id)){
            flash('category_updated', 'Category Updated');
            redirect('admin/categories');
          }
        }
      } else {
        // Load Form With Data
        $category_row = $this->categoryModel->getCategoryById($id);
        $categories = $this->categoryModel->getCategoriesExceptUnCategorized();
        $data = [
          'category' => $category_row['Category_Name'],
          'category_error' => '',
          'categories' => $categories,
          'id' => $id
        ];
        $this->view('admin/categories/edit', $data);
      }
    }
    
    // Delete Category
    public function delete($id){
      // Check For Owner
      if($this->categoryModel->getCategoryById($id)['User_ID'] !== $_SESSION['userid'] && $_SESSION['role'] != 'Admin'){
        flash('category_owner_error', 'You can only edit or delete categories add by you', 'btn btn-message-lg red darken-4');
        redirect('admin/categories');
        return;
      }

      // Check If Category ID Exists
      if(!$this->categoryModel->getCategoryById($id)){
        flash('category_not_exists', 'No Category Found With This ID', 'btn btn-message-lg red darken-4');
        redirect('admin/categories');
        return;
      }
      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->categoryModel->deleteCategory($id)){
          flash('category_deleted', 'Category Deleted');
          redirect('admin/categories/index');
        }
      }
    }
  }