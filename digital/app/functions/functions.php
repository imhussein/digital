<?php

  /**
   * Functions
   */

  function menuCategories(){
    $db = new Database;
    $db->query('SELECT * FROM categories WHERE Category_Name != "Uncategorized" LIMIT 4');
    $categories = $db->multi(); ?>
    <ul class="left hide-on-med-and-down" style="margin-left: 120px;">
      <li class="<?php echo (!isset($_GET['url'])) ? 'active' : '';?>">
        <a href="<?php echo URLROOT; ?>">Home</a>
      </li>
      <?php
      foreach($categories as $category): 
        $url = (isset($_GET['url'])) ? $_GET['url'] : ''; ?>
        <li class="<?php echo ($url == 'categories/catid/'. $category['ID']) ? 'active' : '';?>">
          <a href="<?php echo URLROOT; ?>/categories/<?php echo $category['Category_Name']; ?>"><?php echo $category['Category_Name']; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php }