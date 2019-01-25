<?php
  /**
   * Controller Class
   * Load Views & Load Models
   * All Controllers Extends Controller Class
   */

  class Controller {
    // load Models
    public function model($model){
      if(file_exists(APPROOT.'\/models/'.$model.'.php')){
        require_once APPROOT.'\/models/'.$model.'.php';
        return new $model();
      }
    }

    // Load Views
    public function view($view, $data){
      if(file_exists(APPROOT.'\/views/'.$view.'.php')){
        require_once APPROOT.'\/views/'.$view.'.php';
      } else {
        die('View Doesn\'t Exists');
      }
    } 
  }