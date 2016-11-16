<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inventory Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Inventory</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Inventory</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Inventory</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="inventoryid" value="'.$inventoryDO->getInventoryid().'" />';
       echo '<input type="hidden" name="unitid" value="'.$inventoryDO->getUnitid().'" />';
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

      <div style="float:right"> 
        <?php 
        if($inventoryDO->getFlag() == 1) echo '<i class="fa fa-bell fa-fw" style="color:red"></i>';
        else echo '<i class="fa fa-bell fa-fw" ></i>';

        ?>
      </div>

      <div class="form-group">
       <label for="stocknumber">Stock Number</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getStocknumber(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="stocknumber" name="stocknumber" value="<?php echo $inventoryDO->getStocknumber(); ?>" placeholder="Enter Stock Number" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="name">Name</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getName(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="name" name="name" value="<?php echo $inventoryDO->getName(); ?>" placeholder="Enter Name" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="categoryid">Category</label>
       <select id="categoryid" name="categoryid"  class="form-control"  >
        <?php 
          
          $udo = null;
          $v = '';
          while ($categorylist->hasMore()) {
            $udo = $categorylist->next($udo);
            if($inventoryDO->getCategoryid() == $udo->getCategoryid()) $v='selected="selected"';
              echo '<option value="' . $udo->getCategoryid() . '"' . $v . '>' . $udo->getCategory() . '</option>';
              $v='';
           }
           
        ?>
       </select>
      </div>

      <div class="form-group">
       <label for="minimumquantity">Minimum Qty</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getMinimumquantity(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="minimumquantity" name="minimumquantity" value="<?php echo $inventoryDO->getMinimumquantity(); ?>" placeholder="Enter Minimum Qty" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="quantityavailable">Available Qty</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getQuantityavailable(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="quantityavailable" name="quantityavailable" value="<?php echo $inventoryDO->getQuantityavailable(); ?>" placeholder="Enter Available Qty" required="required"/>
       <?php } ?>
      </div>

   

      <div class="form-group">
         <label for="shelvingid">Shelving</label>
         <select id="shelvingid" name="shelvingid"  class="form-control"  >
          <?php 

            $i = 1;
             $udo = null;
             $v = '';
             while ($shelvinglist->hasMore()) {
              $udo = $shelvinglist->next($udo);
              if($udo->getShelvingid() == $inventoryDO->getShelvingid()) $v = 'selected="selected"';
              echo '<option value="' . $udo->getShelvingid() . '"' . $v . '>' .$udo->getShelving() .'(' . $udo->getLocation() . ')</option>';  
              $v = '';
            }

          ?>
         </select>
      </div>

      <div class="form-group">
       <label for="status">Status</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getStatus(); ?></p>
       <?php } else { ?>
       <select name="status" id="status" class="form-control">
         <?php 
            $sites = array("DISCONTINUED", "AVAILABLE", "OUT OF STOCK");
            $v='';
            for($i=0; $i<sizeof($sites); $i++) {
              if($sites[$i] == $inventoryDO->getStatus()) $v='selected="selected"';
              echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
              $v='';
            }
          ?>
       </select>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="description">Description</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getDescription(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="description" name="description" value="<?php echo $inventoryDO->getDescription(); ?>" placeholder="Enter Description" required="required"/>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="comments">Comments</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getComments(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="comments" name="comments" value="<?php echo $inventoryDO->getComments(); ?>" placeholder="Enter Comments" required="required"/>
       <?php } ?>
      </div>

      <?php if($mode == 'edit') { ?>
      <div class="form-group">
      <label for="reason">Reason for Edit</label>
      <input type="text" class="form-control" id="reason" name="reason" value=""  />
      </div>
      <?php }?>

      <div class="form-group">
       <label for="dateadded">Date Added</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $inventoryDO->getDateadded(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="dateadded" name="dateadded" value="<?php echo $inventoryDO->getDateadded(); ?>" readonly />
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