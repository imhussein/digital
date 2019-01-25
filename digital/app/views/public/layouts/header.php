<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Materialize -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/materialize.css" type="text/css">
  <!-- Main App Style -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/app.css" type="text/css">
  <!-- Fav Icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URLROOT; ?>/assets/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URLROOT; ?>/assets/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URLROOT; ?>/assets/images/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo URLROOT; ?>/assets/images/favicons/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/fontawesome-all.min.css" type="text/css">
  <title><?php echo SITENAME; ?> - <?php echo SITE_DESCRIPTION; ?></title>
</head>
<body>
  <div class="preloader">
    <div class="preloader-spinner"></div>
  </div>
  <?php require_once APPROOT.'/views/public/layouts/navbar.php'; ?>
    <div class="site">