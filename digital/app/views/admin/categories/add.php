<?php require_once APPROOT.'/views/admin/public/layouts/header.php'; ?>
  <h2 class="flow-text center-align heading-primary blue-text ">Add Category</h2>

  <?php flash('category_added'); ?>
  <?php flash('category_not_exists'); ?>
  
  <div class="row">
    <div class="col m6 add-category-form">
      <div class="card">
        <form action="<?php echo URLROOT; ?>/admin/categories/add" method="POST">
          <div class="card-content">
          <h3 class="card-title center-align">Add New Category</h3>
            <div class="input-field">
              <input type="text" name="category" id="category" value="<?php echo $data['category']; ?>" class="<?php echo (!empty($data['category_error'])) ? 'invalid' : ''; ?>">
              <?php if(!empty($data['category_error'])): ?>
                <span class="helper-text" data-error="<?php echo $data['category_error']; ?>"></span>
              <?php endif; ?>
              <label for="category">Category</label>
            </div>
          </div>
          <div class="card-action">
            <input type="submit" value="Add Category" class="btn blue-grey darken-4 btn-block-lg">
          </div>
        </form>
      </div>
    </div>
    <div class="col m6">
      <table class="striped highlight">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data['categories'] as $category): ?>
            <tr>
              <td><?php echo $category['ID'] ?></td>
              <td><?php echo $category['Category_Name'] ?></td>
              <td>
                <a href="<?php echo URLROOT; ?>/admin/categories/edit/<?php echo $category['ID']; ?>" class="btn blue waves-effect waves-white">Edit</a>
              </td>
              <td>
                <form action="<?php echo URLROOT; ?>/admin/categories/delete/<?php echo $category['ID']; ?>" method="POST">
                  <button type="submit" class="btn red white-text waves-effect waves-white">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php require_once APPROOT.'/views/admin/public/layouts/footer.php'; ?>