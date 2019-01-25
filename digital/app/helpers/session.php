<?php

  /**
   * Session Helper
   */

  session_start();
  function flash($name, $message = '', $class = 'btn btn-message-lg green darken-2'){
    if(!empty($name)){
      if(empty($_SESSION[$name]) && !empty($message)){
        if(!empty($_SESSION[$name])){
          unset($_SESSION[$name]);
        }
        if(!empty($_SESSION[$name.'_class'])){
          unset($_SESSION[$name.'_class']);
        }
        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;
      } else if(!empty($_SESSION[$name]) && empty($message)){
        $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
        echo '<div class="'.$class.'" id="alert-message">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name.'_class']);
      }
    }
  }