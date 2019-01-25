<?php

  /**
   * User Model Class
   */

  class User {
    private $db;
    public function __construct(){
      $this->db = new Database;
    }

    // Check For Email Address
    public function getUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE Email = :email');
      $this->db->bindValues("email", $email);
      $row = ($this->db->single());
      if($row){
        return true;
      } else {
        return false;
      }
    }

    // Check For Username
    public function getUserByUsername($username){
      $this->db->query('SELECT * FROM users WHERE Username = :username');
      $this->db->bindValues("username", $username);
      $row = ($this->db->single());
      if($row){
        return true;
      } else {
        return false;
      }
    }

    // Register User
    public function register($data){
      // Hash Password
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      $this->db->query('INSERT INTO users (Fullname, Username, Password, Email, Role, Status) VALUES (:fullname, :username, :password, :email, :role, :status)');
      $this->db->bindValues('fullname', $data['name']);
      $this->db->bindValues('username', $data['username']);
      $this->db->bindValues('password', $data['password']);
      $this->db->bindValues('email', $data['email']);
      $this->db->bindValues('role', 'Anonymous');
      $this->db->bindValues('status', 'UnApproved');
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($data){
      $this->db->query('SELECT * FROM users WHERE Email = :email');
      $this->db->bindValues('email', $data['email']);
      $row = $this->db->single();
      $password_verified = password_verify($data['password'], $row['Password']);
      if($password_verified){
        print_r($row);
        return $row;
      } else {
        return false;
      }
    }

    // Get users
    public function getUsers(){
      $this->db->query('SELECT * FROM users ORDER BY Role, Created_at DESC');
      $users = $this->db->multi();
      return $users;
    }

    // Approve User
    public function approveUser($id){
      $this->db->query('UPDATE users SET Status = :status, Role = :role WHERE ID = :id');
      $this->db->bindValues('status', 'Approved');
      $this->db->bindValues('role', 'User');
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // UnApprove User
    public function unApproveUser($id){
      $this->db->query('UPDATE users SET Status = :status, Role = :role WHERE ID = :id');
      $this->db->bindValues('status', 'UnApproved');
      $this->db->bindValues('role', 'Anonymous');
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get User By ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE ID = :id');
      $this->db->bindValues('id', $id);
      $user = $this->db->single();
      return $user;
    }

    // Get User By Username Except Old Username
    public function getUserByUsernameExceptOldUsername($username, $id){
      $this->db->query('SELECT * FROM users WHERE Username = :username AND Username != (SELECT Username FROM users WHERE ID = :id)');
      $this->db->bindValues('username', $username);
      $this->db->bindValues('id', $id);
      $rowCount = $this->db->rowCount();
      if($rowCount > 0){
        return true;
      } else {
        return false;
      }
    }

    // Get User By Email Except Old Email
    public function getUserByEmailExceptOldEmail($email, $id){
      $this->db->query('SELECT * FROM users WHERE Email = :email AND Email != (SELECT Email FROM users WHERE ID = :id)');
      $this->db->bindValues('email', $email);
      $this->db->bindValues('id', $id);
      $rowCount = $this->db->rowCount();
      if($rowCount > 0){
        return true;
      } else {
        return false;
      }
    }

    // Update User
    public function updateUser($data, $id){
      $this->db->query('UPDATE users SET Fullname = :fullname, Username = :username, Email = :email, Password = :password, Status = :status, Role = :role, Image = :image WHERE ID = :id');
      $this->db->bindValues('fullname', $data['name']);
      $this->db->bindValues('username', $data['username']);
      $this->db->bindValues('email', $data['email']);
      $this->db->bindValues('password', $data['password']);
      $this->db->bindValues('status', $data['status']);
      $this->db->bindValues('role', $data['role']);
      $this->db->bindValues('image', $data['image']);
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete User
    public function deleteUser($id){
      $this->db->query('DELETE FROM users WHERE ID = :id');
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Make User Admin
    public function setUserToAdmin($id){
      $this->db->query('UPDATE users SET Role = :role WHERE ID = :id');
      $this->db->bindValues('role', 'Admin');
      $this->db->bindValues('id', $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Return Admin To Normal User
    public function setAdminToUser($id){
      $this->db->query('UPDATE users SET Role = :role WHERE ID = :id');
      $this->db->bindValues("id", $id);
      $this->db->bindValues("role", "User");
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Add User
    public function addUser($data){
      $this->db->query('INSERT INTO users (Fullname, Username, Email, Password, Status, Role, Image) VALUES (:fullname, :username, :email, :password, :status, :role, :image)');
      $this->db->bindValues("fullname", $data['name']);
      $this->db->bindValues("username", $data['username']);
      $this->db->bindValues("email", $data['email']);
      $this->db->bindValues("password", $data['password']);
      $this->db->bindValues("status", $data['status']);
      $this->db->bindValues("role", $data['role']);
      $this->db->bindValues("image", $data['image']);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update Profile
    public function updateProfile($data, $id){
      $this->db->query('UPDATE users SET Fullname = :fullname, Username = :username, Password = :password, Email = :email WHERE ID = :id');
      $this->db->bindValues("fullname", $data['name']);
      $this->db->bindValues("username", $data['username']);
      $this->db->bindValues("password", $data['password']);
      $this->db->bindValues("email", $data['email']);
      $this->db->bindValues("id", $id);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }