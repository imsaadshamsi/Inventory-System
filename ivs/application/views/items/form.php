<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reorder Item</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/reorder/index', 'Reorder Items'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Reorder Item</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Reorder Item</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Reorder Item</li>
          <?php } ?>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
      <?php
       $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));

       echo '<input type="hidden" name="reorderid" value="'. $reorderDO->getReorderid() .'" />';
       echo '<input type="hidden" name="itemid" value="'. $itemDO->getItemid() . '" />';

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
       <label for="inventoryid">Inventory</label>

       <select name="inventoryid" id="inventoryid" class="form-control">
        <?php 
           $udo = null;
           $i=0;
            $v = '';
            while ($inventorylist->hasMore()) {
              $udo = $inventorylist->next($udo);
              if($itemDO->getInventory_id() == $udo->getInventoryid()) $v=' selected="selected" '; 
              echo '<option value="' .$udo->getInventoryid() . '" ' . $v . '>' . $udo->getName() . '</option>';
              $v='';
             } 
     
         ?>
       </select>
      </div>



      <div class="form-group">
       <label for="Quantity">Quantity</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $itemDO->getQuantity() ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $itemDO->getQuantity(); ?>" placeholder="Enter the Reorder Items name" required="required"/>
       <?php } ?>
      </div>


      <div class="form-group">
       <label for="comments">Comments</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $itemDO->getComments(); ?></p>
       <?php } else { ?>
       <input  type="text" class="form-control" id="comments" name="comments" value="<?php echo $itemDO->getComments(); ?>" placeholder="" />
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