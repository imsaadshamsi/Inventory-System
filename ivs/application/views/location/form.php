<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Location Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/location/index', 'Location'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Location</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Location</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Location</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="locationid" value="'.$locationDO->getLocationid().'" />';
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
       <label for="location">Location</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $locationDO->getLocation(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="location" name="location" value="<?php echo $locationDO->getLocation(); ?>" placeholder="Enter location Name" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="description">Description</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $locationDO->getDescription(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="description" name="description" value="<?php echo $locationDO->getDescription(); ?>" placeholder="Enter Description for the location" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="locationcode">Location Code</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $locationDO->getLocationcode(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="locationcode" name="locationcode" value="<?php echo $locationDO->getLocationcode(); ?>" placeholder="Enter a unique location code (eg) IT1, IT2. This will be unique to your unit." required="required"/>
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