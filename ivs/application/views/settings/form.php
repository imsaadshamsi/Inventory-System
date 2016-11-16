<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Setting</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/setting/index', 'Setting'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove User</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit User</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New User</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="settingid" value="'.$settingDO->getSettingid().'" />';
       if (isset($msg) && strlen($msg) > 0) {
        if (strcmp($msgType,'error') == 0) {
         echo '<div class="alert alert-danger">';
        }
        elseif (strcmp($msgType,'success') == 0) {
         echo '<div class="alert alert-success">';
        }
        else {
         echo '<div class="alert">';
        }
        echo $msg.validation_errors().'</div>';
       } 
      ?>


      <div class="form-group">
       <label for="settingtype">Setting Type:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo ($settingDO->getSettingtype()); ?></p>
       <?php } else { ?>
       <select name="settingtype" id="settingtype" class="form-control">
         <?php 
            $types = array("Low Level", "Reorder");
            $v='';
            for($i=0;$i<sizeof($types);$i++) {
              if($types[$i] == $settingDO->getSettingtype()) $v='selected="selected"';
              echo '<option value="' . $types[$i] . '"' . $v . '>' . $types[$i]  . '</option>';
              $v='';
            }
          ?>
       </select>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="name">Name:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $settingDO->getName(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="name" name="name" value="<?php echo $settingDO->getName(); ?>" placeholder="Enter the name" required="required"/>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="email">Email</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $settingDO->getEmail(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="email" name="email" value="<?php echo $settingDO->getEmail(); ?>" placeholder="Enter the email" required="required"/>
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