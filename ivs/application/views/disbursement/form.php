<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Disbursement Record</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/Disbursements/index', 'Disbursement'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Disbursement</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Disbursement</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Disbursement</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="disbursementuuid" value="'. $disbursementDO->getDisbursementuuid().'" />';
       echo '<input type="hidden" name="requestid" value="'.$requestid.'" />';
       echo '<input type="hidden" name="userid" value="'.$userid.'" />';

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

    
	   <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Details</h3>
          </div>
          <div class="panel-body">


              	   <div class="form-group">
                     <label for="comments">Comments</label>
                     <?php if ($mode == 'remove') { ?>
                      <p class="form-control-static"><?php echo $disbursementDO->getComments(); ?></p>
                     <?php } else { ?>
                     <input type="text" class="form-control" id="comments" name="comments" value="<?php echo $disbursementDO->getComments(); ?>" placeholder="" required="required"/>
                     <?php } ?>
                    </div>
              	  
                  <?php if ($mode == 'edit') { ?>
              	  	 <div class="form-group">
                     <label for="date_disbursed">Date Disbursed</label>
                     <?php if ($mode == 'remove') { ?>
                      <p class="form-control-static"><?php echo $disbursementDO->getDate_disbursed(); ?></p>
                     <?php } else { ?>
                     <input readonly type="text" class="form-control" id="date_disbursed" name="date_disbursed" value="<?php echo $disbursementDO->getDate_disbursed(); ?>" placeholder="" required="required" readonly/>
                     <?php } ?>
                    </div>
                  <?php } ?>
              	  

              	  <?php if ($mode != 'new') { ?> 
              	  <div class="form-group">
                     <label for="user">User</label>
                     <?php if ($mode == 'remove') { ?>
                      <p class="form-control-static"><?php echo $userDO->getStaffname(); ?></p>
                     <?php } else { ?>
                     <input type="text" class="form-control" id="user" name="user" value="<?php echo $userDO->getStaffname(); ?>" placeholder="" required="required" readonly/>
                     <?php } ?>
                    </div>
              	  
              	  
              	  <div class="form-group">
                     <label for="code">**Enter Code Here</label>
                     <?php if ($mode == 'remove') { ?>
                      <p class="form-control-static"></p>
                     <?php } else { ?>
                     <input type="text" class="form-control" id="code" name="code" value="" placeholder=""  />
                     <?php } ?>
                    </div>
                  <?php } ?>
              	  
              	 <div class="form-group">
              			   <label for="status">Status</label>
              			   <?php if ($mode == 'remove') { ?>
              				<p class="form-control-static"><?php echo $disbursementDO->getStatus(); ?></p>
              			   <?php } else { ?>
              			   <select name="status" id="status" class="form-control" >
              				 <?php 
              					$sites = array("PICKUP", "COLLECTED","CANCELLED");
              					$v='';
              					for($i=0; $i<sizeof($sites); $i++) {
              					  if($sites[$i] == $disbursementDO->getStatus()) $v='selected="selected"';
              					  echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
              					  $v='';
              					}
              				  ?>
              			   </select>
              			   <?php } ?>
                    </div>
                    
      </div>

      </div>

    
      <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Requested Items</h3>
          </div>
          <div class="panel-body">

          <table class="table">
           <table class="table">
           <thead>
            <tr>
             <th>Stock Number</th>
             <th>Inventory</th>
             <th>Quantity Req.</th>
             <th>Remaining </th>
             <th>Reason</th>
             <th style="color:green">Availability</th>
             <th style="color:red">Disburse</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             $s = '';
             if ($mode == 'edit') $s = ' readonly ';
             if($requesteditemslist != null) {
                foreach ($requesteditemslist as $udo) {
                
                  echo '<tr>';
                  echo '<td>' . anchor('/inventory/edit/'.  $udo->getInventory_record()->getInventoryid(),  $udo->getInventory_record()->getStocknumber() ) . '</td>';
                  echo '<td>' . $udo->getInventory_record()->getName() . '</td>';
                  echo '<td>' . $udo->getQuantity_requested()  .'</td>';
                  echo '<td>' . $udo->getQuantity_requested_remaining()  .'</td>';
                  echo '<td>' . $udo->getReason_for_request()  .'</td>';
                  echo '<td style="color:green">' . $udo->getInventory_record()->getQuantityavailable() . '</td>';
                  echo '<td style="color:red"><input class="form-control" name="xxx' . $udo->getRequested_item_id()  .'" id="xxx' . $udo->getRequested_item_id() . '"'.  $s  .  ' value="' . $udo->getDisbursement_records()->getQuantity_disbursed()    . '"/></td>';
                  echo '</tr>';
                 } 
              }
            
            ?>  
           </tbody>
          </table>
       
      
      </div>

    </div>

      <?php
      $status='';
       if($disbursementDO->getStatus() == 'COLLECTED' || $disbursementDO->getStatus() == 'CANCELLED' ) $status=' disabled ';

      ?>
      <button type="submit" class="btn btn-success" style="float:Right" <?php echo $status ?> ><?php echo $btnLabel; ?></button>
      </form>



   
      <div class="app-form-nav-links" >
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->