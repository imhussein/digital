<?php

  /**
   * Admin Dashboard
   */

  class Admin_dashboard extends Controller {
    public function __construct(){
      
    }

    public function index(){
      $data = [];
      $this->view('admin/dashboard', $data);
    }
  }