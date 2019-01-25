<nav class="blue darken-4 navbar-fixed">
  <div class="nav-wrapper">
    <div class="container">
      <a href="<?php echo URLROOT; ?>/admin/dashboard" class="brand-logo"><?php echo SITENAME; ?></a>
      <a href="#" class="sidenav-trigger custom-sidenav" data-target="slide-out"><i class="material-icons" >menu</i></a>
      <ul id="slide-out" class="sidenav">
        <li><div class="user-view">
          <div class="background">
            <img width="100%" src="<?php echo URLROOT; ?>/assets/images/main/bg.jpeg">
          </div>
          <a href="<?php echo URLROOT; ?>/admin/profile/edit/<?php echo $_SESSION['userid']; ?>"><img class="circle" src="<?php echo ($_SESSION['image'] == '') ? URLROOT. '/assets/images/main/profile.png' : URLROOT.'/assets/images/users/'.$_SESSION['image']; ?>"></a>
          <a href="#name"><span class="white-text name"><?php echo $_SESSION['fullname']; ?></span></a>
          <a href="#email"><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
        </div></li>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/dashboard"><i class="material-icons">dashboard</i>Dashboard</a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/posts"><i class="material-icons">list</i>Posts</a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/categories"><i class="material-icons">category</i>Categories</a>
        </li>
        <?php if($_SESSION['role'] == 'Admin'): ?>
        <li>
          <a href="<?php echo URLROOT; ?>/admin/users"><i class="material-icons">account_circle</i>Users</a>
        </li>
        <?php endif; ?>
        <li>
          <a href="#!"><i class="material-icons">mode_comment</i>Comments</a>
        </li>
        <li>
          <a href="#!"><i class="material-icons">widgets</i>Widgets</a>
        </li>
        <li>
          <a href="#!"><i class="material-icons">settings</i>Settings</a>
        </li>
      </ul>
      <ul class="right hide-on-small-and-down">
        <li>
          <a href="" data-target="dropdown-menu" class="dropdown-trigger"><i class="material-icons right">arrow_drop_down</i><?php echo $_SESSION['username']; ?></a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>">Visit Site</a>
        </li>
      </ul>
      <ul class="dropdown-content" id="dropdown-menu">
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
    </div>
  </div>
</nav>