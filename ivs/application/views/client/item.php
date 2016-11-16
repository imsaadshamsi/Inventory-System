<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if($mode=='new')  {?> 
                <h1 class="page-header">New Item</h1>
                <?php } ?>
                <?php if($mode=='edit')  {?> 
                <h1 class="page-header">Item Details</h1>
                <?php } ?>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
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
	 echo '<input type="hidden" id="requesteditemid" name="requesteditemid" value="'.  $requestedItemDO->getRequested_item_id() . '" />';
	 
	  echo '<input type="hidden" id="requestid" name="requestid" value="'.  $requestedItemDO->getRequest_id() . '" />';
	  
      ?>

	<div class="form-group">
       <label for="inventoryid">Inventory</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestedItemDO->getInventory_record()->getName(); ?></p>
       <?php } else { ?>
       <select name="inventoryid" id="inventoryid" class="form-control" >
         <?php 
            
            $v='';
			$udo = null;
            while ($inventorylist->hasMore()) {
			 $udo = $inventorylist->next($udo);
              if($udo->getInventoryid() == $requestedItemDO->getInventory_record()->getInventoryid()) $v='selected="selected"';
              echo '<option value="' . $udo->getInventoryid() . '"' . $v . '>' . $udo->getName() . '(' . $udo->getUnitname() . ')' . '</option>';
              $v='';
		
			  
            }
          ?>
       </select>
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="reason">Reason</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestedItemDO->getReason_for_request(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="reason" name="reason" value="<?php echo $requestedItemDO->getReason_for_request(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  
	   <div class="form-group">
       <label for="quantity">Quantity</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestedItemDO->getQuantity_requested(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $requestedItemDO->getQuantity_requested(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>




      <div class="form-group">
       <label for="quantity_remaining">Quantity Remaining</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestedItemDO->getQuantity_requested_remaining(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="quantity_remaining" name="quantity_remaining" value="<?php echo $requestedItemDO->getQuantity_requested_remaining(); ?>" placeholder="" disabled />
       <?php } ?>
      </div>
	  
	  <button style="float:right;" type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
      </form>
	  
      </div>
 </form>
 
      <div class="app-form-nav-links" >
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>




    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->