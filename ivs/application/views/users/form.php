<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/users/index', 'Users'); ?></li>
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
       echo '<input type="hidden" name="userId" value="'.$userDO->getUserId().'" />';
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
       <label for="userName">Name:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $userDO->getUserName(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $userDO->getUserName(); ?>" placeholder="Enter the users name" required="required"/>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="ldapUserCode">LDAP User Name:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $userDO->getLdapUserCode(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="ldapUserCode" name="ldapUserCode" value="<?php echo $userDO->getLdapUserCode(); ?>" placeholder="Enter the users ldap user name" required="required"/>
       <?php } ?>
      </div>
	  
	    <div class="form-group">
       <label for="email">Email</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $userDO->getEmail(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="email" name="email" value="<?php echo $userDO->getEmail(); ?>" placeholder="Enter Email" required="required"/>
       <?php } ?>
      </div>
	  
	    <div class="form-group">
       <label for="staffname">Staff Name:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $userDO->getStaffname(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="staffname" name="staffname" value="<?php echo $userDO->getStaffname(); ?>" placeholder="Enter staffname" required="required"/>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="isAdmin">Is Admin:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo ($userDO->getIsAdmin()==1?'Yes':'No'); ?></p>
       <?php } else { ?>
       <select name="isAdmin" id="isAdmin" class="form-control">
        <option value="1" <?php if ($userDO->getIsAdmin() == 1) {echo 'selected="selected"';} ?>>Yes</option>
        <option value="0" <?php if ($userDO->getIsAdmin() == 0) {echo 'selected="selected"';} ?>>No</option>
       </select>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="userActive">Status:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo ($userDO->getUserActive()==1?'Active':'In Active'); ?></p>
       <?php } else { ?>
       <select name="userActive" id="userActive" class="form-control">
        <option value="1" <?php if ($userDO->getUserActive() == 1) {echo 'selected="selected"';} ?>>Active</option>
        <option value="0" <?php if ($userDO->getUserActive() == 0) {echo 'selected="selected"';} ?>>Inactive</option>
       </select>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="unitid">Unit:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo ($userDO->getUnitid()); ?></p>
       <?php } else { ?>
       <select name="unitid" id="unitid" class="form-control">
         <?php 
            
          $udo = null;
          $v = '';
          while ($unitlist->hasMore()) {
            $udo = $unitlist->next($udo);
            if($userDO->getUnitid() == $udo->getUnitid()) $v='selected="selected"';
              echo '<option value="' . $udo->getUnitid() . '"' . $v . '>' . $udo->getUnitname() . '-' . $udo->getSite() . '</option>';
              $v='';
           }

          ?>
       </select>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="usertype">Usertype:</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo ($userDO->getUsertype()); ?></p>
       <?php } else { ?>
       <select name="usertype" id="usertype" class="form-control">
         <?php 
            $usertypes= array("Super User", "Regular User");
            $v='';
            for($i=0;$i<sizeof($usertypes);$i++) {
              if($usertypes[$i] == $userDO->getUsertype()) $v='selected="selected"';
              echo '<option value="' . $usertypes[$i] . '"' . $v . '>' . $usertypes[$i]  . '</option>';
              $v='';
            }
          ?>
       </select>
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