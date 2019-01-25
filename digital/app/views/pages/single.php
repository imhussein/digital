<?php require_once APPROOT.'/views/public/layouts/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col m8 offset-m2">
      <div class="my-2">
        <h4 class="center-align">
          <a href="<?php echo URLROOT.'/single/index/'.$data['post']['PostID']; ?>"><?php echo $data['post']['Title']; ?></a>
        </h4>
        <div class="container center-align">
          <div class="row my-2">
            <div class="col m4 s12">
              <a href="<?php echo URLROOT; ?>/author/index/<?php echo $data['post']['UserID']; ?>">
              <img src="<?php echo ($data['post']['UserImage'] == '') ? URLROOT.'/assets/images/main/profile.png' : URLROOT.'/assets/images/users/'.$data['post']['UserImage']; ?>" class="cricle post-author">
              <span class="font-bold"><?php echo $data['post']['Username']; ?></span></a>
            </div>
            <div class="col m4 s12">
              <span class="btn blue-grey darken-4"><?php echo $data['post']['PostCreatedAt']; ?></span>
            </div>
            <div class="col m4 s12">
              <a href="<?php echo URLROOT; ?>/categories/<?php echo $data['post']['Category_Name']; ?>" class="btn blue darken-4"><?php echo $data['post']['Category_Name']; ?></a>
            </div>
          </div>
        </div>
        <div class="container">
          <hr>
        </div>
      </div>
      <div class="card">
        <div class="card-image">
          <img src="<?php echo URLROOT.'/assets/images/posts/'.$data['post']['PostImage']; ?>" width="70%">
        </div>
      </div>
      <div class="my-2">
        <p><?php echo $data['post']['Details']; ?></p>
      </div>
      <hr>
      <div class="row">
      <h5 class="my-2">
        Related Posts
      </h5>
      <?php foreach($data['related_posts'] as $realted_post): ?>
        <div class="col m4 s12">
          <div class="card">
            <div class="card-image">
              <img src="<?php echo URLROOT.'/assets/images/posts/'.$realted_post['Image']; ?>">
            </div>
            <div class="card-action">
              <h5><a href="<?php echo URLROOT; ?>/single/index/<?php echo $realted_post['ID']; ?>" class="indigo-text"><?php echo substr($realted_post['Title'], 0, 40).'....'; ?></a></h5>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php require_once APPROOT.'/views/public/layouts/footer.php'; ?>