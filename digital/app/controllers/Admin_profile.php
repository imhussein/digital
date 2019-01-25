<?php

  /**
   * User Profile
   */

  class Admin_profile extends Controller {
    // Constructor
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    // Edit User Profile
    public function edit($id){
      // Check For Owner
      if($_SESSION['userid'] != $id && $_SESSION['role'] != 'Admin'){
        redirect('admin/profile/edit/'.$_SESSION['userid']);
        return;
      }

      // Check For Session ID
      if($_SESSION['userid'] != $id){
        redirect('admin/profile/edit/'.$_SESSION['userid']);
        return;
      }

      // Check if ID Exists In DB
      if(!$this->userModel->getUserById($id)){
        flash('user_not_found', 'No User Found With ID', 'btn btn-message-lg red darken-4');
        redirect('admin/profile/edit/'.$_SESSION['userid']);
        return;
      }

      // Check For Server Request Method
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
          $this->view('admin/users/profile', $data);
        } else {
          // Save Modified Data To DB
          if($this->userModel->updateProfile($data, $id)){
            flash('profile_updated', 'Profile Updated');
            redirect('admin/profile/edit/'.$id);
          } else {
            die('Something Went Wrong');
          }
        }
      } else {
        // Load Form With Data
        $user = $this->userModel->getUserById($id);
        $data = [
          "name" => $user['Fullname'],
          "name_error" => '',
          "email" => $user['Email'],
          "email_error" => '',
          "username" => $user['Username'],
          "username_error" => '',
          "password" => $user['Password'],
          "password_error" => '',
          "status" => $user['Status'],
          "role" => $user['Role'],
          "image" => $user['Image'],
          "id" => $id,
        ];
        $this->view('admin/users/profile', $data);
      }
    }
  }