
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reorder Details <?php if($mode=='new') echo '-New'; ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
          <li><?php echo anchor('/reorder/index' , 'Reorder'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Reorder</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Reorder</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Reorder</li>
          <?php } ?>
    </ul>
    <!-- /.breadcrumb -->

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));

       echo '<input type="hidden" id="reorderid" name="reorderid" value="'.$reorderDO->getReorderid().'" />';
       echo '<input type="hidden" id="userid" name="userid" value="'. $reorderDO->getUserid() .'" />';
       echo '<input type="hidden" id="unitid" name="unitid" value="'. $reorderDO->getUnitid() . '" />';

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
        <p class="form-control-static" style="text-align:center">**************<?php echo $reorderDO->getStatus(); ?>****************</p>
      </div>


      <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Reorder Details</h3>
          </div>
          <div class="panel-body">

                <div class="form-group">
                 <label for="description">Description</label>
                 <?php if ($mode == 'remove') { ?>
                  <p class="form-control-static"><?php echo $reorderDO->getDescription(); ?></p>
                 <?php } else { ?>
                 <input type="text" class="form-control" id="description" name="description" value="<?php echo $reorderDO->getDescription(); ?>" placeholder="" required="required" />
                 <?php } ?>
                </div>

                 <div class="form-group">
                 <label for="comments">Comments**</label>
                 <?php if ($mode == 'remove') { ?>
                  <p class="form-control-static"><?php echo $reorderDO->getComments(); ?></p>
                 <?php } else { ?>
                 <input type="text" class="form-control" id="comments" name="comments" value="<?php echo $reorderDO->getComments(); ?>" placeholder=""  />
                 <?php } ?>
                </div>



          <?php if($mode != 'new') { ?>

                <div class="form-group">
                 <label for="dateinitiated">Date Initiated</label>
                 <?php if ($mode == 'remove') { ?>
                  <p class="form-control-static"><?php echo $reorderDO->getDateinitiated; ?></p>
                 <?php } else { ?>
                 <input type="text" class="form-control" id="dateinitiated" name="dateinitiated" value="<?php echo $reorderDO->getDateinitiated(); ?>" placeholder="" required="required" />
                 <?php } ?>
                </div>





                <div class="form-group">
                 <label for="status">Status</label>
                 <?php if ($mode == 'remove') { ?>
                  <p class="form-control-static"><?php echo $reorderDO->getStatus(); ?></p>
                 <?php } else { ?>
                 <select name="status" id="status" class="form-control">
                   <?php 

                      $sites = $statusarray;
                      $v='';
                      for($i=0; $i<sizeof($sites); $i++) {
                        if($sites[$i] == $reorderDO->getStatus()) $v='selected="selected"';
                        echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
                        $v='';
                      }
                    ?>
                 </select>
                 <?php } ?>
                </div>

<?php } ?>

   <button type="submit" style="float:right" class="btn btn-success" <?php echo $state; ?>  ><?php echo $btnLabel; ?></button>
      </form>

</div>
</div>

      

      <?php if($mode == 'edit') { ?>

        <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Items on this Reorder</h3>
          </div>
          <div class="panel-body">
              <table class="table">
                  <thead>
                  <tr>
                    <th>Item ID</th>
                    <th>Inventory</th>
                    <th>Reorder Quantity</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                 $udo = null;
                 $i=0;
                 if($reordereditemslist != null) {
                    foreach ($reordereditemslist as $udo) {
                      $i++;
                      echo '<tr>';
                      echo '<td>' . anchor('/reorder/reorderitem/edit/'.  $reorderDO->getReorderid() . '/' . $udo->getItemid(), 'Item-' .$i ) . '</td>';
                      echo '<td>' . $udo->getInventoryrecord()->getName() . '</td>';
                      echo '<td>' . $udo->getQuantity()  .'</td>';
                      echo '</tr>';

                     } 
                  }
                 

                      ?>  
                     </tbody>
                </table>
               
              
              
                <?php 
           
                if($state == 'disabled') {
                    echo anchor($action2, 'Add Item', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right', 'disabled'=>'disabled'));
                } else {
                    echo anchor($action2, 'Add Item', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right'));
                }
           
                ?>
          </div>

        </div>



        <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Receive Records</h3>
          </div>
          <div class="panel-body">
              <table class="table">
                  <thead>
                  <tr>
                    <th>Record</th>
                    <th>User</th>
                    <th>Date Received</th>
                    <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                 $udo = null;
                 $i = 0;
                 //if($receiverecords != null) {
                    while ($receiverecords->hasMore()) {
                      $udo = $receiverecords->next($udo);
                      $i++;
                      echo '<tr>';
                      echo '<td>' . anchor('/reorder/receiverecord/edit/'. $udo->getRecordUUID() . '/' .  $udo->getReorderid() , 'Record-' . $i ) . '</td>';
                      echo '<td>' . $udo->getUserid() . '</td>';
                      echo '<td>' . $udo->getDatereceived()  .'</td>';
                       echo '<td>' . $udo->getStatus()  .'</td>';
                      echo '</tr>';
                     } 
                 // }
                 

                      ?>  
                     </tbody>
                </table>
                
              
              <?php 
           
                if($state == 'disabled') {
                    echo anchor($action3, 'Add Record', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right', 'disabled'=>'disabled'));
                } else {
                    echo anchor($action3, 'Add Record', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right'));
                }
           
                ?>
              
          </div>
        </div>

        <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Attachments</h3>
          </div>
          <div class="panel-body">

              <table class="table">
                  <thead>
                  <tr>
                    <th>Attachment Name</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Type</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                 $udo = null;
            
                    while ($attachments->hasMore()) {
                      $udo = $attachments->next($udo);
       
                      echo '<tr>';
                      echo '<td>' . anchor('/reorder/attachment/edit/'.  $udo->getAttachmentid() . '/' . $udo->getReorderid(), $udo->getTitle() ) . '</td>';
                      echo '<td>' . $udo->getUserid() . '</td>';
                      echo '<td>' . $udo->getDateadded()  .'</td>';
                      echo '<td>' . $udo->getType()  .'</td>';
                     // echo '<td>' . anchor('/reorder/attachment/view', 'View')  .'</td>';
                      echo '</tr>';
                     } 

                      ?>  
                     </tbody>
                </table>
                
              
              
                <?php 
           
               // if($state == 'disabled') {
                  //  echo anchor($action4, 'Add Attachement', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right', 'disabled'=>'disabled'));
               // } else {
                    echo anchor($action4, 'Add Attachement', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right'));
               //}
           
                ?>
              
              

          </div>
        </div>

        <div class="panel panel-primary" style="margin-top: 50px">
          <div class="panel-heading">
            <h3 class="panel-title">Quotes</h3>
          </div>
          <div class="panel-body">

            <table class="table">
                  <thead>
                  <tr>
                    <th>Selected</th>
                    <th>Quote Name</th>
                    <th>User</th>
                    <th>Supplier</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                 $udo = null;
                 
                
                    while ($quotes->hasMore()) {
                      $udo = $quotes->next($udo);
                      
                      echo '<tr>';
                      echo '<td>' . $udo->getSelected() . '</td>';
                      echo '<td>' . anchor('/reorder/quote/edit/'. $udo->getReorderid() . '/' . $udo->getQuoteid(), $udo->getTitle() ) . '</td>';
                      echo '<td>' . $udo->getUserid() . '</td>';
                      echo '<td>' . $udo->getSupplierid()  . '</td>';
                      echo '</tr>';
                     } 
                 
                 

                      ?>  
                     </tbody>
                </table>
                
                <?php 
           
                if($state == 'disabled') {
                    echo anchor($action5, 'Add Quote', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right', 'disabled'=>'disabled'));
                } else {
                    echo anchor($action5, 'Add Quote', array('class'=>'btn btn-primary','role'=>'button', 'style'=>'float:right'));
                }
           
                ?>
              
              
          </div>
        </div>

        
      <?php } ?>



   



      <div class="app-form-nav-links" style="float:left">
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>

    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->