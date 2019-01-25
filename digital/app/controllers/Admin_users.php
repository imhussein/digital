<?php

  /**
   * Users
   */

  class Admin_users extends Controller {
    // Constructor
    public function __construct(){

      // Only Admin Can Manage Users
      if($_SESSION['role'] != 'Admin'){
        redirect('admin/dashboard');
      }
      $this->userModel = $this->model('User');
    }

    // Index Route
    public function index(){
      $users = $this->userModel->getUsers();
      $data = [
        'users' => $users,
      ];
      $this->view('admin/users/index', $data);
    }

    // Approve User
    public function approve($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->userModel->approveUser($id)){
          flash('user_approved', 'User is approved');
          redirect('admin/users');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('admin/users');
      }
    }

    // UnApprove User
    public function unapprove($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->userModel->unApproveUser($id)){
          flash('user_unapproved', 'User is Unapproved');
          redirect('admin/users');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('admin/users');
      }
    }

    // Edit User
    public function edit($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Input Data
        $_POST = filter_input_array(INPUT_POST);
        // Data
        $data = [
          'name' => trim($_POST['name']),
          'id' => $id,
          'name_error' => '',
          'username' => trim($_POST['username']),
          'username_error' => '',
          'email' => trim($_POST['email']),
          'email_error' => '',
          'password' => trim($_POST['password']),
          'password_error' => '',
          'status' => trim($_POST['status']),
          'role' => trim($_POST['role']),
          'image' => $_FILES['image']['name'],
          'image_location' => $_FILES['image']['tmp_name'],
        ];

        // Upload Image To The Server
        move_uploaded_file($data['image_location'], APPROOT.'/../public/assets/images/users/'.$data['image']);

        // Server side validation

        // Validate Name
        if(empty($data['name'])){
          $data['name_error'] = 'Name is required';
        } else {
          if(strlen($data['name']) < 5){
            $data['name_error'] = 'Name must be at least 5 characters';
          }
        }

        // Validate Username
        if(empty($data['username'])){
          $data['username_error'] = 'Username is required';
        } else {
          if(strlen($data['username']) < 5){
            $data['username_error'] = 'Username must be at least 5 characters';
          } else {
            if($this->userModel->getUserByUsernameExceptOldUsername($data['username'], $id)){
              $data['username_error'] = 'Username is already taken';
            };
          }
        }

        // Validate Email
        if(empty($data['email'])){
          $data['email_error'] = 'Email is required';
        } else {
          if($this->userModel->getUserByEmailExceptOldEmail($data['email'], $id)){
            $data['email_error'] = 'Email is already taken';
          };
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password'] = $_POST['old_password'];
        } else {
          if(strlen($data['password']) < 5){
            $data['password_error'] = 'Password must be at least 5 characters';
          } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          }
        }

        // Validate Image
        if($data['image'] == ''){
          $data['image'] = $this->userModel->getUserById($id)['Image'];
        }

        // Check For Errors
        if(!empty($data['name_error']) || !empty($data['email_error']) || !empty($data['password_error']) || !empty($data['username_error'])){
          // Rerender Form With Errors
          $this->view('admin/users/edit', $data);
        } else {
          // Save Modified Data To DB
          if($this->userModel->updateUser($data, $id)){
            flash('user_updated', 'User Updated');
            redirect('admin/users');
          } else {
            die('Something Went Wrong');
          }
        }

      } else {
        // Load Form With Data
        $user = $this->userModel->getUserById($id);
        $data = [
          'name' => $user['Fullname'],
          'id' => $id,
          'name_error' => '',
          'username' => $user['Username'],
          'username_error' => '',
          'email' => $user['Email'],
          'email_error' => '',
          'password' => $user['Password'],
          'password_error' => '',
          'status' => $user['Status'],
          'role' => $user['Role'],
          'image' => $user['Image'],
        ];
        $this->view('admin/users/edit', $data);
      }
    }

    // Delete User
    public function delete($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->userModel->deleteUser($id)){
          flash('user_deleted', 'User Deleted');
          redirect('admin/users');
        } else {
          die('Something Went Wrong!!!');
        }
      } else {
        redirect('admin/users');
      }
    }

    // Make User An Admin
    public function setadmin($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Server Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->userModel->setUserToAdmin($id)){
          flash('user_is_admin', 'User Role Is Admin');
          redirect('admin/users');
        } else {
          die('Something Went Wrong!!!');
        }
      } else {
        redirect('admin/users');
      }
    }

    // Return Admin To Normal User
    public function setuser($id){
      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/users');
        return;
      }
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->userModel->setAdminToUser($id)){
          flash('admin_is_user', 'This User is no longer admin');
          redirect('admin/users');
        } else {
          die('Something Went Wrong!!!');
        }
      } else {
        redirect('admin/users');
      }
    }

    // Add User
    public function add(){
      // Check If Server Request Method Is Post
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Input Data
        filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Data
        $data = array(
          'name' => trim($_POST['name']),
          'name_error' => '',
          'username' => trim($_POST['username']),
          'username_error' => '',
          'email' => trim($_POST['email']),
          'email_error' => '',
          'password' => trim($_POST['password']),
          'password_error' => '',
          'image' => $_FILES['image']['name'],
          'image_location' => $_FILES['image']['tmp_name'],
          'status' => trim($_POST['status']),
          'role' => trim($_POST['role']),
        );
        
        // Upload Image To The Server
        move_uploaded_file($data['image_location'], APPROOT.'/../public/assets/images/users/'.$data['image']);

        // Server Side Validation

        // Validate Name
        if(empty($data['name'])){
          $data['name_error'] = 'Name is required';
        } else {
          if(strlen($data['name']) < 5){
            $data['name_error'] = 'Name must be at least 5 characters';
          }
        }

        // Validate Username
        if(empty($data['username'])){
          $data['username_error'] = 'Username is required';
        } else {
          if(strlen($data['username']) < 3){
            $data['username_error'] = 'Username must be at least 3 characters';
          } else {
            if($this->userModel->getUserByUsername($data['username'])){
              $data['username_error'] = 'Username is already taken';
            }
          }
        }

        // Validate Email
        if(empty($data['email'])){
          $data['email_error'] = 'Email is required';
        } else {
          if($this->userModel->getUserByEmail($data['email'])){
            $data['email_error'] = 'Email is already taken';
          }
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_error'] = 'Password is required';
        } else {
          if(strlen($data['password']) < 5){
            $data['password_error'] = 'Password must be at least 5 characters';
          }
        }

        // Check For Errors
        if(!empty($data['name_error']) || !empty($data['email_error']) || !empty($data['username_error']) || !empty($data['password_error'])){
          // Rerender Form With Errors And Data
          $this->view('admin/users/add', $data);
        } else {
          // Hash Password 
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // SAVE TO DB
          if($this->userModel->addUser($data)){
            flash('user_added', 'New User Added');
            redirect('admin/users');
          } else {
            die('Something Went Wrong');
          }
        }
      } else {
        // Load Form With Data
        $data = array(
          'name' => '',
          'name_error' => '',
          'username' => '',
          'username_error' => '',
          'email' => '',
          'email_error' => '',
          'password' => '',
          'password_error' => '',
          'image' => '',
        );
        $this->view('admin/users/add', $data);
      }
    }
  }