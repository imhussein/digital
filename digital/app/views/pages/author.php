<?php require_once APPROOT.'/views/public/layouts/header.php'; ?>

<div class="container">
  <div class="row">
    <?php foreach($data['posts'] as $post): ?>
      <div class="col l4 m6 s12" style="height:43rem">
        <div class="card post-card">
          <div class="card-image">
            <a href="<?php echo URLROOT; ?>/single/index/<?php echo $post['PostID']; ?>" class="post-image-link"></a>
            <?php if($post['PostImage'] != '') : ?>
              <img src="<?php echo URLROOT; ?>/assets/images/posts/<?php echo $post['PostImage']; ?>">
            <?php endif; ?>
              <a href="<?php echo URLROOT; ?>/single/index/<?php echo $post['PostID']; ?>" class="btn blue darken-4 waves-effect waves-light halfway-fab btn-floating">
                <i class="material-icons">arrow_forward</i>
              </a>
          </div>
          <div class="card-content">
            <h3 class="card-title"><a href="<?php echo URLROOT; ?>/single/<?php echo $post['PostID']; ?>"><?php echo substr($post['Title'], 0, 70); ?></a></h3>
            <p class="grey-text my-1"><?php echo substr($post['Details'], 0, 140).'.....'; ?></p>
            <a href="<?php echo URLROOT; ?>/categories/<?php echo $post['Category_Name']; ?>" class="btn blue-grey darken-4"><?php echo $post['Category_Name']; ?></a>
          </div>
          <div class="card-action">
            <div class="row" style="margin:0;">
              <div class="col m6">
                <a href="<?php echo URLROOT; ?>/author/index/<?php echo $post['UserID']; ?>">
                <img src="<?php echo ($post['UserImage'] == '') ? URLROOT.'/assets/images/main/profile.png' : URLROOT.'/assets/images/users/'.$post['UserImage']; ?>" class="cricle post-author">
                <span class="font-bold"><?php echo $post['Username']; ?></span></a>
              </div>
              <div class="col m6 right-align" style="padding-top: 10px;">
                <span class="grey-text"><?php echo $post['PostCreatedAt']; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once APPROOT.'/views/public/layouts/footer.php'; ?>