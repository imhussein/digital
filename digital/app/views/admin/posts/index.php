<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>

  <div class="my-3">
    <h2 class="heading-primary center-align blue-text">
      All Posts
    </h2>
  </div>

  <?php flash('post_added'); ?>
  <?php flash('post_id_not_exists'); ?>
  <?php flash('post_approved'); ?>
  <?php flash('post_drafted'); ?>
  <?php flash('post_deleted'); ?>
  <?php flash('post_delete_owner'); ?>
  <?php flash('post_draft_owner'); ?>
  <?php flash('post_edit_owner'); ?>

  <a href="<?php echo URLROOT; ?>/admin/posts/add" class="btn waves-effect waves-white">Add New Post</a>

  <div class="mt-2">
    <table class="striped table-responsive">
      <thead>
        <tr>
          <th>#ID</th>
          <th>Title</th>
          <th>User</th>
          <th>Image</th>
          <th>Status</th>
          <th>Category</th>
          <th>Comments</th>
          <th>View Post</th>
          <th>Created_At</th>
          <?php if($_SESSION['role'] == 'Admin'): ?>
          <th>Approve</th>
          <?php endif; ?>
          <th>Draft</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['posts'] as $post): ?>
          <tr>
            <td><?php echo $post['PostID']; ?></td>
            <td><span class="font-bold"><?php echo $post['Title']; ?></span></td>
            <td><?php echo $post['Username']; ?></td>
            <td><img src="<?php echo ($post['PostImage'] == '') ? URLROOT.'/assets/images/main/post.png' : URLROOT.'/assets/images/posts/'.$post['PostImage']; ?>" alt="" class="circle-profile-img"></td>
            <td><?php echo $post['PostStatus']; ?></td>
            <td><button class="btn indigo"><?php echo $post['Category_Name']; ?></button></td>
            <td><span class="btn blue-grey darken-4">10</span></td>
            <td>
              <a href="<?php echo URLROOT; ?>/post/index/<?php echo $post['PostID']; ?>" target="_blank" class="btn blue darken-4 waves-effect waves-white">View Post</a>
            </td>
            <td>
              <?php echo date($post['PostCreatedAt']); ?>
            </td>
            <?php if($_SESSION['role'] == 'Admin'): ?>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/posts/approve/<?php echo $post['PostID']; ?>" method="POST">
                <button type="submit" <?php echo ($post['PostStatus'] == 'Approved') ? 'disabled' : ''; ?> class="btn blue-grey darken-4 waves-effect waves-white">Approve</button>
              </form>
            </td>
            <?php endif; ?>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/posts/draft/<?php echo $post['PostID']; ?>" method="POST">
                <button type="submit" <?php echo ($post['PostStatus'] == 'Draft') ? 'disabled' : ''; ?> class="btn blue-grey darken-4 waves-effect waves-white">Draft</button>
              </form>
            </td>
            <td>
              <a href="<?php echo URLROOT; ?>/admin/posts/edit/<?php echo $post['PostID']; ?>" class="btn blue waves-effect waves-white">Edit</a>
            </td>
            <td>
              <form action="<?php echo URLROOT; ?>/admin/posts/delete/<?php echo $post['PostID']; ?>" method="POST">
                <button type="submit" class="btn red waves-effect waves-white">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>
