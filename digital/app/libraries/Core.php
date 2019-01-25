<?php

  /**
   * Main Core Class
   * Load & Format URL
   * Create Routes & Bind Params
   * Load All Controllers
   */

  class Core {
    public $currentController = 'Pages';
    public $currentMethod = 'index';
    public $params = [];

    // Constructor
    public function __construct(){
      $url = $this->getUrl();
      // Check For Controllers
      if(isset($url[0])){
        if(file_exists(APPROOT.'\/controllers/'.ucwords($url[0]).'.php')){
          $this->currentController = ucwords($url[0]);
          unset($url[0]);
        }
      }

      // Load Current Controller
      require_once APPROOT.'\/controllers/'.$this->currentController.'.php';
      $this->currentController = new $this->currentController();

      // Check For Current Method
      if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      // Check For Params
      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // Get & Format URL
    public function getUrl(){
      if(isset($_GET['url'])){
        $url = $_GET['url'];
        // Trim Url
        $url = rtrim($url, '/');
        // Filter Url
        $url = filter_var($url, FILTER_SANITIZE_URL);
        // Explode URL & Turn To An Array
        $url = explode('/', $url);
        if(isset($url[0])){
          if($url[0] == 'admin'){
            $url[1] = 'Admin_'.$url[1];
            unset($url[0]);
            $url = array_values($url);
          }
        }
        return $url;
      }
    }
  }