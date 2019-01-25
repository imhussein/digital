<?php

  /**
   * Users Controller
   * Login & Register
   */

  class Users extends Controller {
    public function __construct(){
      $this->isUserLoggedIn();
      $this->userModel = $this->model('User');
    }

    public function login(){
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Form Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'email' => trim($_POST['email']),
          'email_error' => '',
          'password' => trim($_POST['password']),
          'password_error' => '',
        ];

        // Server Side Validation
        // Validate Email
        if(empty($data['email'])){
          $data['email_error'] = 'Email is required';
        } else {
          if(!$this->userModel->getUserByEmail($data['email'])){
            $data['email_error'] = 'User not found';
          }
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_error'] = 'Password is required';
        }

        // Check For Errors
        if(!empty($data['email_error']) || !empty($data['password_error'])){
          // Rerender Form With Data And Errors
          $this->view('users/login', $data);
        } else {
          if($this->userModel->login($data)){
            $this->setUserSession($this->userModel->login($data));
            redirect(''); 
          } else {
            $data['password_error'] = 'Password Incorrect';
            $this->view('users/login', $data);
          }
        }
      } else {
        // Load Form With Data
        $data = [
          'email' => '',
          'email_error' => '',
          'password' => '',
          'password_error' => '',
        ];
        $this->view('users/login', $data);
      }
    }

    public function register(){
      // Check For Request Method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Filter Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Server Side Validation
        $data = [
          'name' => trim($_POST['name']),
          'name_error' => '',
          'username' => trim($_POST['username']),
          'username_error' => '',
          'email' => trim($_POST['email']),
          'email_error' => '',
          'password' => trim($_POST['password']),
          'password_error' => '',
          'confirm_password' => trim($_POST['confirm_password']),
          'confirm_password_error' => '',
        ];

        // Vaidate Name
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

        // Validate Confirm Password
        if($data['password'] != $data['confirm_password']){
          $data['confirm_password_error'] = 'Passwords do not match';
        }

        // Check For Errors
        if(!empty($data['name_error']) || !empty($data['username_error']) || !empty($data['email_error']) || !empty($data['password_error']) || !empty($data['confirm_password_error'])){
          // Rerender Form With Erorrs And Data
          $this->view('users/register', $data);
        } else {
          // SAVE To DB
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered');
            redirect('users/login');
          } else {
            die('Something Went Wrong!!!!');
          }
        }

      } else {
        // Load Form With Data
        $data = [
          'name' => '',
          'name_error' => '',
          'username' => '',
          'username_error' => '',
          'email' => '',
          'email_error' => '',
          'password' => '',
          'password_error' => '',
          'confirm_password' => '',
          'confirm_password_error' => '',
        ];
        $this->view('users/register', $data);
      }
    }

    // check if user is logged in
    public function isUserLoggedIn(){
      if(isset($_SESSION['userid'])){
        redirect('admin/dashboard');
      }
    }

    // Set User Session
    public function setUserSession($user){
      session_start();
      $_SESSION['username'] = $user['Username'];
      $_SESSION['fullname'] = $user['Fullname'];
      $_SESSION['status'] = $user['Status'];
      $_SESSION['email'] = $user['Email'];
      $_SESSION['role'] = $user['Role'];
      $_SESSION['userid'] = $user['ID'];
      $_SESSION['image'] = $user['Image'];
    }

    // Logout Route
    public function logout(){
      session_start();
      session_unset();
      session_destroy();
      unset($_SESSION['username']);
      unset($_SESSION['fullname']);
      unset($_SESSION['status']);
      unset($_SESSION['email']);
      unset($_SESSION['role']);
      unset($_SESSION['userid']);
      redirect('');
    }
  }