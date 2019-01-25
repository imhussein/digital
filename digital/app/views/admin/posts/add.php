<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>

  <div class="my-3">
    <a href="<?php echo URLROOT; ?>/admin/posts" class="btn btn-block-lg blue-grey darken-4">Back To Posts</a>
  </div>

  <div class="card">
    <form action="<?php echo URLROOT; ?>/admin/posts/add" method="POST" enctype="multipart/form-data">
      <div class="card-content">
        <h2 class="card-title center-align">Add New Post</h2>
        <div class="input-field my-3">
          <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>" class="<?php echo (!empty($data['title_error'])) ? 'invalid' : '';  ?>">
          <span class="helper-text" data-error="<?php echo $data['title_error']; ?>"></span>
          <label for="title">Add Post Title</label>
        </div>
        <div class="input-field my-3">
          <select name="category" id="category">
            <option value="Uncategorized">Select Post Category</option>
            <?php foreach($data['categories'] as $category): ?>
              <option value="<?php echo $category['Category_Name']; ?>"><?php echo $category['Category_Name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="input-field my-3">
          <textarea name="details" id="details" cols="30" rows="10" class="materialize-textarea"><?php echo $data['details']; ?></textarea>
          <label for="details">Add Post Details</label>
        </div>
        <div class="row">
          <div class="col m6">
            <div class="file-field input-field my-3">
              <div class="btn">
                <span>Upload Post Thumbnail</span>
                <input type="file" name="image" id="image" class="profile-avatar-img-input">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
          <div class="col m6">
            <div class="profile-image mt-3">
              <img src="<?php echo ($data['image'] == '') ? URLROOT.'/assets/images/main/post.png' : URLROOT.'/assets/images/users/'.$data['image']; ?>" class="profile-avatar-img post-thumbnail-img">
            </div>
          </div>
        </div>
      </div>
      <div class="card-action">
        <button type="submit" class="btn btn-block-lg blue darken-4 waves-effect waves-white">Add Post</button>
      </div>
    </form>
  </div>

<?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>
