<nav class="blue darken-4 navbar-fixed" style="position:fixed;left:0;top:0;">
  <div class="nav-wrapper">
    <div class="container">
      <a href="<?php echo URLROOT; ?>" class="brand-logo"><?php echo SITENAME; ?></a>
      <a href="" class="sidenav-trigger" data-target="sidenav-menu"><i class="material-icons">menu</i></a>
      <?php menuCategories()?>
      <ul class="sidenav" id="sidenav-menu">
      <?php if(!isset($_SESSION['userid'])): ?>
        <li>
          <a class="waves-effect btn teal lighten-2" href="<?php echo URLROOT; ?>/users/login">Login</a>
        </li>
        <li>
          <a class="waves-effect btn teal lighten-2" href="<?php echo URLROOT; ?>/users/register">Register</a>
        </li>
      <?php else: ?>
        <li>
          <a class="waves-effect btn teal lighten-2" href="<?php echo URLROOT; ?>/admin/dashboard">Admin Area</a>
        </li>
      <?php endif; ?>
      </ul>
      <?php if(!isset($_SESSION['userid'])): ?>
      <ul class="right hide-on-med-and-down">
        <li class="<?php echo ($_GET['url'] == 'users/login') ? 'active' : '';?>">
          <a href="<?php echo URLROOT; ?>/users/login">Login</a>
        </li>
        <li class="<?php echo ($_GET['url'] == 'users/register') ? 'active' : '';?>">
          <a href="<?php echo URLROOT; ?>/users/register">Register</a>
        </li>
      </ul>
    <?php else: ?>
      <ul class="right hide-on-med-and-down">
      <li>
        <a class=" dropdown-trigger" href="#" data-target="profile-info">
          <i class="material-icons right">arrow_drop_down</i><img src="<?php echo ($_SESSION['image'] == '') ? URLROOT. '/assets/images/main/profile.png' : URLROOT.'/assets/images/users/'.$_SESSION['image']; ?>" class="circle-profile-img">
        </a>
      </li>
      </ul>
      <ul class="dropdown-content" id="profile-info">
        <li>
          <a href="<?php echo URLROOT; ?>/admin/dashboard">Dashboard</a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/profile/edit/<?php echo $_SESSION['userid']; ?>">Profile</a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/settings">Settings</a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
        </li>
      </ul>
    <?php endif; ?>
    </div>
  </div>
</nav>