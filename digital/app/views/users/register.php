<?php require_once APPROOT.'/views/public/layouts/header.php'; ?>

<div class="row" style="margin-top: 30px;">
  <div class="col m4 offset-m4">
    <form action="<?php echo URLROOT; ?>/users/register" method="POST">
      <div class="card">
        <h3 class="card-title center-align" style="padding-top: 20px; font-size: 30px;">Register</h3>
        <div class="card-content">
          <div class="input-field">
            <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="<?php echo (!empty($data['name_error'])) ? 'invalid' : ''; ?>">
            <?php if(!empty($data['name_error'])): ?>
              <span class="helper-text" data-error="<?php echo $data['name_error']; ?>" data-success="right"></span>
            <?php endif; ?>
            <label for="name">Fullname</label>
          </div>
          <div class="input-field">
            <input type="text" name="username" id="username" value="<?php echo $data['username']; ?>" class="<?php echo (!empty($data['username_error'])) ? 'invalid' : ''; ?>">
            <?php if(!empty($data['username_error'])): ?>
              <span class="helper-text" data-success="right" data-error="<?php echo $data['username_error']; ?>"></span>
            <?php endif; ?>
            <label for="username">Username</label>
          </div>
          <div class="input-field">
            <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" class="<?php echo (!empty($data['email_error'])) ? 'invalid' : '';?>">
            <?php if(!empty($data['email_error'])): ?>
              <span class="helper-text" data-success="right" data-error="<?php echo $data['email_error']; ?>"></span>
            <?php endif; ?>
            <label for="email">Email Address</label>
          </div>
          <div class="input-field">
            <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" class="<?php echo (!empty($data['password_error'])) ? 'invalid' : '';?>">
            <?php if(!empty($data['password_error'])): ?>
              <span class="helper-text" data-success="right" data-error="<?php echo $data['password_error']; ?>"></span>
            <?php endif; ?>
            <label for="password">Password</label>
          </div>
          <div class="input-field">
            <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $data['confirm_password']; ?>" class="<?php echo (!empty($data['confirm_password_error'])) ? 'invalid' : '';?>">
            <?php if(!empty($data['confirm_password_error'])): ?>
              <span class="helper-text" data-success="right" data-error="<?php echo $data['confirm_password_error']; ?>"></span>
            <?php endif; ?>
            <label for="confirm_password">Confirm Password</label>
          </div>
        </div>
        <div class="card-action">
          <input type="submit" value="Register" class="btn blue darken-4 btn-block-lg">
        </div>
      </div>
    </form>
  </div>
</div>

<?php require_once APPROOT.'/views/public/layouts/footer.php'; ?>