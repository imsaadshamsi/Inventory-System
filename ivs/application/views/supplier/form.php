<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Supplier Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/supplier/index', 'supplier'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Supplier</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Supplier</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Supplier</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="supplierid" value="'. $supplierDO->getsupplierid().'" />';
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
       <label for="suppliername">Supplier</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getSuppliername(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="suppliername" name="suppliername" value="<?php echo $supplierDO->getSuppliername(); ?>" placeholder="Supplier Name" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="email">Email</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getEmail(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="email" name="email" value="<?php echo $supplierDO->getEmail(); ?>" placeholder="Supplier Email" />
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="address">Address</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getAddress(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="address" name="address" value="<?php echo $supplierDO->getAddress(); ?>" placeholder="Supplier Address" />
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="telephone">Telephone</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getTelephone(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $supplierDO->getTelephone(); ?>" placeholder="Telephone Contact" />
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="contactperson">Contact Person</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getContactperson(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="contactperson" name="contactperson" value="<?php echo $supplierDO->getContactperson(); ?>" placeholder="Contact Person" />
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="status">Status</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getStatus(); ?></p>
       <?php } else { ?>
       <select name="status" id="status" class="form-control">
         <?php 
            $sites = array("DISCONTINUED", "CURRENT");
            $v='';
            for($i=0;$i<sizeof($sites);$i++) {
              if($sites[$i] == $supplierDO->getStatus()) $v='selected="selected"';
              echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
              $v='';
            }
          ?>
       </select>
       <?php } ?>
      </div>



      <div class="form-group">
       <label for="comments">Comments</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $supplierDO->getComments(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="comments" name="comments" value="<?php echo $supplierDO->getComments(); ?>" placeholder="Enter Comments" />
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