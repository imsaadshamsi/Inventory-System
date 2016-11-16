<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/category/index', 'Category'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Category</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Category</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Category</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="categoryid" value="'.$categoryDO->getCategoryid().'" />';
       if (isset($msg) && strlen($msg) > 0) {
        if (strcmp($msgType,'error') == 0) {
         echo '<div class="alert alert-dismissable alert-danger">';
        }
        elseif (strcmp($msgType,'success') == 0) {
         echo '<div class="alert alert-dismissable alert-success">';
        }
        else {
         echo '<div class="alert alert-dismissable alert-info">';
        }
        echo $msg.validation_errors().'</div>';
       } 
      ?>

      <div class="form-group">
       <label for="category">Name</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $categoryDO->getCategory(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="category" name="category" value="<?php echo $categoryDO->getCategory(); ?>" placeholder="Enter Category Name" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="description">Description</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $categoryDO->getDescription(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="description" name="description" value="<?php echo $categoryDO->getDescription(); ?>" placeholder="Enter Description" required="required"/>
       <?php } ?>
      </div>


      <button type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
      </form>

      <div class="app-form-nav-links" style="float:right">
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->