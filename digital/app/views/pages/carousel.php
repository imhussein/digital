<div class="container">
  <div class="carousel carousel-slider center" data-indicators="true">
    <?php $i = 0; ?>
    <?php foreach($data['carousel-posts'] as $item): ?>
      <div class="carousel-item blue white-text darken-4" href="#<?php echo 'slide-'.$i; ?>">
        <div class="slide-image" style="background-image: url(<?php echo URLROOT.'/assets/images/posts/'.$item['Image']; ?>)"></div>
        <div class="carousel-fixed-item center">
        <h4><a style="color:#fff" href="<?php echo URLROOT; ?>/single/index/<?php echo $item['ID']; ?>"><?php echo $item['Title']; ?></a></h4>
          <a href="<?php echo URLROOT; ?>/categories/<?php echo $item['Category_Name']; ?>" class="btn blue darken-4 waves-effect waves-light"><?php echo $item['Category_Name']; ?></a>
        </div>
      </div>
    <?php $i++; endforeach; ?>
  </div>
</div>