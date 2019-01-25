<?php

  // Redirect Helper
  function redirect($page){
    header("Location: ".URLROOT.'/'.$page);
  }