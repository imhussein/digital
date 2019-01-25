<?php require_once APPROOT.'/views/public/layouts/header.php'; ?>

<div class="row">
<?php flash('register_success'); ?>
<?php flash('not_autorized'); ?>
  <div class="col m4 offset-m4">
    <form action="<?php echo URLROOT; ?>/users/login" method="POST">
      <div class="card" style="margin-top: 30px;">
        <h3 class="card-title center-align" style="padding-top: 20px; font-size: 30px;">Login</h3>
        <div class="card-content">
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
        </div>
        <div class="card-action">
          <input type="submit" value="Login" class="btn blue darken-4 btn-block-lg">
        </div>
      </div>
    </form>
  </div>
</div>

<?php require_once APPROOT.'/views/public/layouts/footer.php'; ?>