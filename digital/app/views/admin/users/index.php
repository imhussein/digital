<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>

  <div class="my-3">
    <h2 class="heading-primary center-align blue-text">
      All Users
    </h2>
  </div>

  <?php flash('user_approved'); ?>
  <?php flash('user_unapproved'); ?>
  <?php flash('user_updated'); ?>
  <?php flash('user_deleted'); ?>
  <?php flash('user_is_admin'); ?>
  <?php flash('admin_is_user'); ?>
  <?php flash('user_added'); ?>
  <?php flash('user_not_found'); ?>

  <a href="<?php echo URLROOT; ?>/admin/users/add" class="btn waves-effect waves-white">Add New User</a>
  
  <div class="mt-2">
    <table class="striped table-responsive">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Fullname</th>
          <th>Username</th>
          <th>Email</th>
          <th>Status</th>
          <th>Role</th>
          <th>Approve</th>
          <th>UnApprove</th>
          <th>Edit</th>
          <th>Delete</th>
          <th>Make Admin</th>
          <th>Make User</th>
          <th>Avatar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['users'] as $user): ?>
          <tr>
            <td><?php echo $user['ID']; ?></td>
            <td><span class="font-bold"><?php echo $user['Fullname']; ?></span></td>
            <td><?php echo $user['Username']; ?></td>
            <td><?php echo $user['Email']; ?></td>
            <td><?php echo $user['Status']; ?></td>
            <td><?php echo $user['Role']; ?></td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/users/approve/<?php echo $user['ID']; ?>" method="POST">
                <button type="submit" <?php echo ($user['Status'] == 'Approved') ? 'disabled' : ''; ?> class="btn blue-grey darken-4 waves-effect waves-white">Approve</button>
              </form>
            </td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/users/unapprove/<?php echo $user['ID']; ?>" method="POST">
                <button type="submit" <?php echo ($user['Status'] == 'UnApproved') ? 'disabled' : ''; ?> class="btn blue-grey darken-4 waves-effect waves-white">UnApprove</button>
              </form>
            </td>
            <td>
              <a href="<?php echo URLROOT; ?>/admin/users/edit/<?php echo $user['ID']; ?>" class="btn blue waves-effect waves-white">Edit</a>
            </td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/users/delete/<?php echo $user['ID']; ?>" method="POST">
                <button type="submit" class="btn red darken-4 waves-effect waves-white">Delete</button>
              </form>
            </td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/users/setadmin/<?php echo $user['ID']; ?>" method="POST">
                <button type="submit" <?php echo ($user['Role'] == 'Admin') ? 'disabled' : ''; ?> class="btn blue darken-4 waves-effect waves-white">Make Admin</button>
              </form>
            </td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/users/setuser/<?php echo $user['ID']; ?>" method="POST">
                <button type="submit" <?php echo ($user['Role'] == 'User') ? 'disabled' : ''; ?> class="btn blue darken-4 waves-effect waves-white">Make User</button>
              </form>
            </td>
            <td>
              <?php if($user['Image'] == ''): ?>
                <i class="material-icons">account_circle</i>
              <?php else: ?>
                <img src="<?php echo URLROOT; ?>/assets/images/users/<?php echo $user['Image']; ?>" class="circle-profile-img">
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>
