<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Receive Record</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/Receive Records/index', 'Receive Record'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Receive Record</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Receive Record</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Receive Record</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       echo '<input type="hidden" name="uuid" value="'. $recordDO->getRecorduuid().'" />';
       echo '<input type="hidden" name="reorderid" value="'.$recordDO->getReorderid() .'" />';
       echo '<input type="hidden" name="userid" value="'. $recordDO->getUserid().'" />';

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
            <h3 class="panel-title">Reordered Items</h3>
          </div>
          <div class="panel-body">

          <table class="table">
           <table class="table">
           <thead>
            <tr>
             <th>Item</th>
             <th>Inventory</th>
             <th>Qty Reorderd</th>
             <th>Date Received</th>
             <th style="color:red">Received Qty </th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             $s = '';
             if ($mode == 'edit') $s = ' readonly ';
                if($reorderitemslist != null) {
                    foreach ($reorderitemslist as $udo) {
                      echo '<tr>';
                      echo '<td>' . anchor('/inventory/edit/'.  $udo->getInventoryrecord()->getInventoryid(),  $udo->getInventoryrecord()->getStocknumber() ) . '</td>';
                      echo '<td>' . $udo->getInventoryrecord()->getName() . '</td>';
                      echo '<td>' . $udo->getQuantity()  .'</td>';
                      echo '<td>' . $udo->getReceive_record()->getDatereceived()  .'</td>';
                      echo '<td style="color:red"><input class="form-control" name="xxx' . $udo->getItemid()  .'" id="xxx' . $udo->getItemid() . '"'.  $s  .  ' value="' . $udo->getReceive_record()->getQtyreceived()    . '"/></td>';
                      echo '</tr>';
                     } 
                   }
            
            ?>  
           </tbody>
          </table>
       
      
      </div>

    </div>

      <button type="submit" class="btn btn-success" style="float:right" <?php echo $state; ?> ><?php echo $btnLabel; ?></button>
      </form>



   
      <div class="app-form-nav-links" >
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->