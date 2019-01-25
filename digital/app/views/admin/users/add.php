<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>

  <div class="my-3">
    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-block-lg blue-grey darken-4">Back To Users</a>
  </div>

  <div class="card">
    <form action="<?php echo URLROOT; ?>/admin/users/add" method="POST" enctype="multipart/form-data">
      <div class="card-content">
        <h3 class="card-title center-align">
          Add New User
        </h3>
        <div class="input-field my-3">
          <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="<?php echo (!empty($data['name_error'])) ? 'invalid' : ''; ?>">
          <span class="helper-text" data-error="<?php echo $data['name_error']; ?>"></span>
          <label for="name">Name</label>
        </div>
        <div class="input-field my-3">
          <input type="text" name="username" id="username" value="<?php echo ($data['username']); ?>" class="<?php echo (!empty($data['username_error'])) ? 'invalid' : ''; ?>">
          <span class="helper-text" data-error="<?php echo $data['username_error']; ?>"></span>
          <label for="username">Username</label>
        </div>
        <div class="input-field my-3">
          <input type="email" name="email" id="email" value="<?php echo ($data['email']); ?>" class="<?php echo (!empty($data['email_error'])) ? 'invalid' : ''; ?>">
          <span class="helper-text" data-error="<?php echo $data['email_error']; ?>"></span>
          <label for="email">Email</label>
        </div>
        <div class="input-field my-3">
          <input type="password" name="password" id="password" value="<?php echo ($data['password']); ?>" class="<?php echo (!empty($data['password_error'])) ? 'invalid' : ''; ?>">
          <span class="helper-text" data-error="<?php echo $data['password_error']; ?>"></span>
          <label for="password">Password</label>
        </div>
        <div class="input-field my-3">
          <select name="status" id="status">
            <option value="UnApproved">Select User Status</option>
            <option value="Approved">Approved</option>
            <option value="UnApproved">UnApproved</option>
          </select>
          <label for="status">Status</label>
        </div>
        <div class="input-field my-3">
          <select name="role" id="role">
          <option value="User">Select User Role</option>
            <option value="User">User</option>
            <option value="Anonymous">Anonymous</option>
            <option value="Admin">Admin</option>
          </select>
          <label for="role">Role</label>
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
        <button class="btn btn-block-lg blue-grey darken-4 waves-effect waves-white" type="submit">Add User</button>
      </div>
    </form>
  </div>

  <?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>