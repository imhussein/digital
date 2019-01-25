<?php
  /**
   * Bootstrap File
   * Load App Configuration
   * Load All Libraries
   */

  // Load Config File
  require_once '../app/config/config.php';

  // Load Helpers
  require_once APPROOT.'/helpers/redirect.php';
  require_once APPROOT.'/helpers/session.php';

  // Load Functions
  require_once APPROOT.'/functions/functions.php';

  // Load All Libraries
  spl_autoload_register(function($className){
    require_once '../app/libraries/'.$className.'.php';
  });