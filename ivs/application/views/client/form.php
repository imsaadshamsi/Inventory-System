<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if($mode=='new')  {?> 
                <h1 class="page-header">New Request</h1>
                <?php } ?>
                <?php if($mode=='edit')  {?> 
                <h1 class="page-header">Request Details</h1>
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
	 echo '<input type="hidden" id="requestorid" name="requestorid" value="'.  $requestorid . '" />';
      ?>


      <div class="form-group">
       <label for="title">Title</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getTitle(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="title" name="title" value="<?php echo $requestDO->getTitle(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  
	   <div class="form-group">
       <label for="description">Description</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getDescription(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="description" name="description" value="<?php echo $requestDO->getDescription(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  

	   <div class="form-group">
       <label for="unitid">To Unit</label>
       <select name="unitid" id="unitid" class="form-control" >
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
       <label for="onbehalf">Staff (Select Staff name if you are making request on behalf of someone, otherwise leave default)</label>
       <select name="onbehalf" id="onbehalf" class="form-control" >
           <option value="0">NONE</option>
         <?php 
            
            $v='';
	    $udo = null;
            while ($users->hasMore()) {
		$udo = $users->next($udo);
              if($udo->getUserid() == $requestDO->getOnbehalf()) $v='selected="selected"';
              echo '<option value="' . $udo->getUserid() . '"' . $v . '>' . $udo->getStaffname()  . '</option>';
              $v='';
            }
          ?>
       </select>
      </div>


       <div class="form-group">
       <label for="priority">Priority</label>
       <select id="priority" name="priority" class="form-control"  >
            <option value="2" <?php if($requestDO->getPriority() == 2) echo 'selected="selected"' ?>>No</option>
          <option value="1" <?php if($requestDO->getPriority() == 1) echo 'selected="selected"' ?> >Yes</option>
         
       </select>
      </div>




      <div class="form-group">
       <label for="comments">Comments</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getComments(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="comments" name="comments" value="<?php echo $requestDO->getComments(); ?>" placeholder="" />
       <?php } ?>
      </div>
	  
	 <div class="form-group">
       <label for="status">Status</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $requestDO->getStatus(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="status" name="status" value="<?php echo $requestDO->getStatus(); ?>" placeholder="" readonly />
       <?php } ?>
      </div>
	  
        
        
        
        
        
        
        
	  <?php if($requestDO->getStatus() == "NOT SUBMITTED") { ?>
	  <button style="float:right;" type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
          <?php } ?>
          
          <?php if($mode == "new") { ?>
	  <button style="float:right;" type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
          <?php } ?>
          
      </form>
	  
	  <?php if($mode == "edit") { ?>
	  
	<div>
          <table class="table">
           <thead>
            <tr>
             <th>Stock Number</th>
             <th>Inventory</th>
	     <th>Quantity Req.</th>
             <th>Qty Rem</th>
             <th></th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
			 if($requesteditemslist != null) {
					foreach ($requesteditemslist as $udo) {
					
					  echo '<tr>';
					  echo '<td>' .  $udo->getInventory_record()->getStocknumber() . '</td>';
					  echo '<td>' . $udo->getInventory_record()->getName() . '</td>';
					   echo '<td>' . $udo->getQuantity_requested()  .'</td>';
                                           echo '<td>' . $udo->getQuantity_requested_remaining()  .'</td>';
                                           if($requestDO->getStatus() == "NOT SUBMITTED") {
					    echo '<td>' . anchor('/client/item/remove/' .  $udo->getRequested_item_id(), 'Remove', array())  .'</td>';
                                            echo '<td>' . anchor('/client/item/edit/'.  $udo->getRequested_item_id(),  'Edit' ) . '</td>';
                                           }
					  echo '</tr>';

					 } 
				}
			 

            ?>  
           </tbody>
          </table>
		  <?php if($requestDO->getStatus() == "NOT SUBMITTED") { ?>
		  <?php echo anchor($action2, 'Add Item', array('class'=>'btn btn-primary','role'=>'button')); ?>
                  <?php }?>
      </div>
 
 
 
  <?php echo form_open($action3,array('role'=>'form','style'=>'width:100%;margin-top: 40px;margin-bottom:40px')); 
  echo '<input type="hidden" id="requestid" name="requestid" value="'.  $requestDO->getRequest_id() . '" />'; ?>
  <?php if($requestDO->getStatus() == "NOT SUBMITTED") { ?>
  <div style="float:right"> <button type="submit" class="btn btn-warning">Send Request</button></div>
  <?php }?>
  </form>
  
  
<?php } ?>
    

      

      <div class="app-form-nav-links" >
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>




    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->