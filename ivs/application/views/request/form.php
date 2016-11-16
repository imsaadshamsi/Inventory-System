<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if($mode=='new')  {?> 
                <h1 class="page-header">New Request</h1>
                <?php } ?>
                <?php if($mode=='edit')  {?> 
                <h1 class="page-header">Request Details <?php echo ' - R' .$requestDO->getRequest_id() ?></h1>
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
	   echo '<input type="hidden" id="requestid" name="requestid" value="'.  $requestDO->getRequest_id() . '" />';
	 
      ?>



<div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Request Details</h3>
          </div>
          <div class="panel-body">

      <div class="form-group">
       <label for="title">Title</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getTitle(); ?></p>
       <?php } else { ?>
       <input disabled type="text" class="form-control" id="title" name="title" value="<?php echo $requestDO->getTitle(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  
	   <div class="form-group">
       <label for="description">Description</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getDescription(); ?></p>
       <?php } else { ?>
       <input disabled  type="text" class="form-control" id="description" name="description" value="<?php echo $requestDO->getDescription(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  

	   <div class="form-group">
       <label for="unitid">Unit</label>
       <select disabled  name="unitid" id="unitid" class="form-control" >
         <?php 
            
            $v='';
			     $udo = null;
            while ($unitlist->hasMore()) {
			       $udo = $unitlist->next($udo);
              if($udo->getUnitid() == $requestDO->getUnit_id()) $v='selected="selected"';
              echo '<option value="' . $udo->getUnitid() . '"' . $v . '>' . $udo->getUnitname()  . '</option>';
              $v='';
            }
          ?>
       </select>
      </div>


       <div class="form-group">
       <label for="priority">Priority</label>
       <select disabled  id="priority" name="priority" class="form-control"  >
          <option value="1" <?php if($requestDO->getPriority() == 1) echo 'selected="selected"' ?> >Yes</option>
          <option value="2" <?php if($requestDO->getPriority() == 2) echo 'selected="selected"' ?>>No</option>
       </select>
      </div>


      <div class="form-group">
       <label for="comments">Comments</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getComments(); ?></p>
       <?php } else { ?>
       <input disabled  type="text" class="form-control" id="comments" name="comments" value="<?php echo $requestDO->getComments(); ?>" placeholder="" />
       <?php } ?>
      </div>

      <div class="form-group">
       <label for="datereceived">Date Received</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getDate_received(); ?></p>
       <?php } else { ?>
       <input disabled  type="text" class="form-control" id="datereceived" name="datereceived" value="<?php echo $requestDO->getDate_received();; ?>" placeholder="" />
       <?php } ?>
      </div>
	  
	   <div class="form-group">
			   <label for="status">Status</label>
			   <?php if ($mode == 'remove') { ?>
				<p class="form-control-static"><?php echo $requestDO->getStatus(); ?></p>
			   <?php } else { ?>
			   <select name="status" id="status" class="form-control" >
  				 <?php 
  					$sites = $statusarray;
  					$v='';
  					for($i=0; $i<sizeof($sites); $i++) {
  					  if($sites[$i] == $requestDO->getStatus()) $v=' selected="selected" ';
  					  echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
  					  $v='';
  					}
  				?>
			   </select>
			   <?php } ?>
      </div>
	  
   <button style="float:right;" type="submit" class="btn btn-success" <?php echo $state; ?> ><?php echo $btnLabel; ?></button>
  </form>
  
  </div>
  </div>  
	  
	  <?php if($mode == "edit") { ?>


	<div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Requested Items</h3>
          </div>
          <div class="panel-body">

          <table class="table">
          
           <thead>
            <tr>
             <th>Stock Number</th>
             <th>Inventory</th>
             <th>Quantity Req.</th>
             <th>Remaining </th>
             <th>Reason</th>
             <th style="color:green">Availability</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             if($requesteditemslist != null) {
                foreach ($requesteditemslist as $udo) {
                
                  echo '<tr>';
                  echo '<td>' . anchor('/inventory/edit/'.  $udo->getInventory_record()->getInventoryid(),  $udo->getInventory_record()->getStocknumber() ) . '</td>';
                  echo '<td>' . $udo->getInventory_record()->getName() . '</td>';
                  echo '<td>' . $udo->getQuantity_requested()  .'</td>';
                  echo '<td>' . $udo->getQuantity_requested_remaining()  .'</td>';
                  echo '<td>' . $udo->getReason_for_request()  .'</td>';
                  echo '<td style="color:green">' . $udo->getInventory_record()->getQuantityavailable() . '</td>';
                  echo '</tr>';
                 } 
              }
            
            ?>  
           </tbody>
          </table>
		  
      </div>

    </div>


      <!-- Disbursement Records -->
      <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Disbursement Records</h3>
          </div>
          <div class="panel-body">

          <table class="table">
           <thead>
            <tr>
             <th>Disbursement</th>
             <th>Status</th>
             <th>User</th>
             <th>Date Disbursed</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             $i=0;
             while ($disbursements->hasMore()) {
                $i++;
                $udo= $disbursements->next($udo);
                echo '<tr>';
                echo '<td>' . anchor('disbursement/view/edit/'.  $udo->getDisbursementuuid() . '/' . $udo->getRequestid(), 'Disbursement-' . $i ) . '</td>';
                echo '<td>' . $udo->getStatus() . '</td>';
                echo '<td>' . $udo->getUser_id()  .'</td>';
                echo '<td>' . $udo->getDate_disbursed() .'</td>';
                echo '</tr>';
             }
            ?>  
           </tbody>
          </table>

              
           <?php 
           
                if($state == 'disabled') {
                    echo anchor($action2, 'Add Disbursement', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right', 'disabled'=>'disabled'));
                } else {
                    echo anchor($action2, 'Add Disbursement', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right'));
                }
           
           ?>
        
      
      </div>

    </div>
 


  
<?php } ?>
    

      

      <div class="app-form-nav-links" >
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->