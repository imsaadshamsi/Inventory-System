<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Unit Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/Unit/index', 'Unit'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Unit</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Unit</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Unit</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="unitid" value="'.$unitDO->getUnitid().'" />';
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
       <label for="unitname">Unit Name</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $unitDO->getUnitname(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="unitname" name="unitname" value="<?php echo $unitDO->getUnitname(); ?>" placeholder="Enter Unit Name" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="site">Site</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $unitDO->getSite(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="site" name="site" value="<?php echo $unitDO->getSite(); ?>" placeholder="Enter Description" required="required"/>
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