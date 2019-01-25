<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>
  <?php flash('profile_updated'); ?>
  <?php flash('user_not_found'); ?>
  <div class="card">
    <form action="<?php echo URLROOT; ?>/admin/profile/edit/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">
      <div class="card-content">
        <div class="card-title center-align">
          Edit Your Profile
        </div>
        <div class="input-field my-3">
          <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="<?php echo (!empty($data['name_error'])) ? 'invalid' : ''; ?>">
          <?php if(!empty($data['name_error'])) : ?>
            <span class="helper-text" data-error="<?php echo $data['name_error']; ?>"></span>
          <?php endif; ?>
          <label for="name">Name</label>
        </div>
        <div class="input-field my-3">
          <input type="text" name="username" id="username" value="<?php echo $data['username']; ?>" class="<?php echo (!empty($data['username_error'])) ? 'invalid' : ''; ?>">
          <?php if(!empty($data['username_error'])) : ?>
            <span class="helper-text" data-error="<?php echo $data['username_error']; ?>"></span>
          <?php endif; ?>
          <label for="username">Username</label>
        </div>
        <div class="input-field my-3">
          <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" class="<?php echo (!empty($data['email_error'])) ? 'invalid' : ''; ?>">
          <?php if(!empty($data['email_error'])) : ?>
            <span class="helper-text" data-error="<?php echo $data['email_error']; ?>"></span>
          <?php endif; ?>
          <label for="email">Email Address</label>
        </div>
        <div class="input-field my-3">
          <input type="hidden" name="old_password" value="<?php echo $data['password'] ?>">
          <input type="password" name="password" id="password" class="<?php echo (!empty($data['password_error'])) ? 'invalid' : ''; ?>">
          <?php if(!empty($data['password_error'])) : ?>
            <span class="helper-text" data-error="<?php echo $data['password_error']; ?>"></span>
          <?php endif; ?>
          <label for="password">Password</label>
        </div>
        <div class="row">
          <div class="col m6">
            <div class="file-field input-field mt-4">
              <div class="btn">
                <span>Upload User Avatar</span>
                <input type="file" name="image" id="image" class="profile-avatar-img-input">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
          <div class="col m6">
            <div class="profile-image">
              <img src="<?php echo ($data['image'] == '') ? URLROOT.'/assets/images/main/profile.png' : URLROOT.'/assets/images/users/'.$data['image']; ?>" class="profile-avatar-img">
            </div>
          </div>
        </div>
      </div>
      <div class="card-action">
        <button type="submit" class="btn btn-block-lg blue-grey darken-4">Update Profile</button>
      </div>
    </form>
  </div>



<?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>