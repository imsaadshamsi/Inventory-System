<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quote Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/reorder/index/' . $reorderid, 'Reorder'); ?></li>
          <?php if($mode=='remove') { ?>
          <li class="active">Remove Quote</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Quote</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Quote</li>
          <?php } ?>
    </ul>
    <!-- /.breadcrumb -->

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
        echo form_open_multipart($action,array('role'=>'form'));


       echo '<input type="hidden" name="reorderid" value="'. $reorderid .'" />';
       echo '<input type="hidden" name="quoteid" value="'. $quoteid .'" />';
	   echo '<input type="hidden" name="userid" value="'. $quoteDO->getUserid() .'" />';
	   
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
       <label for="title">Title</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getTitle(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="title" name="title" value="<?php echo $quoteDO->getTitle(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>
	  
	        <div class="form-group">
       <label for="note">Note</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getNote(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="note" name="note" value="<?php echo $quoteDO->getNote(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>

    


      <div class="form-group">
       <label for="supplierid">Supplier </label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getQuoteid(); ?></p>
       <?php } else { ?>
       <select name="supplierid" id="supplierid" class="form-control">
         <?php 
          
          $udo = null;
          $v = '';
          while ($supplierlist->hasMore()) {
            $udo = $supplierlist->next($udo);
            if($quoteDO->getSupplierid() == $udo->getSupplierid()) $v='selected="selected"';
              echo '<option value="' . $udo->getSupplierid() . '"' . $v . '>' . $udo->getSuppliername() . '</option>';
              $v='';
           }
           
        ?>
       </select>
       <?php } ?>
      </div>





      <div class="form-group">
       <label for="quoteamount">Quote Amount</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getQuoteamount(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="quoteamount" name="quoteamount" value="<?php echo $quoteDO->getQuoteamount(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>



      <div class="form-group">
       <label for="deliverydate">Delivery Date</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getDeliverydate(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="deliverydate" name="deliverydate" value="<?php echo $quoteDO->getDeliverydate(); ?>" placeholder="" />
       <?php } ?>
      </div>

	
	 <div class="form-group">
	   <label for="userfile">Quote</label>
	   <p><?php if($quoteDO->getQuoteurl() != '') echo anchor(base_url().  'index.php/reorder/viewFile/' . $quoteDO->getQuoteurl(), $quoteDO->getQuoteurl(), array('target'=>'_blank')); ?></p>
	   <input type="file"  id="userfile" name="userfile" value="<?php echo $quoteDO->getQuoteurl(); ?>"  placeholder="Select the file to upload" />
	  </div>
			  
			  
			  
			  
			      <div class="form-group">
       <label for="selected">Selected</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $quoteDO->getSelected() ; ?></p>
       <?php } else { ?>
       <select name="selected" id="selected" class="form-control">
        <option value="Yes" <?php if ( $quoteDO->getSelected() == "Yes" ) {echo 'selected="selected"';} ?>>Yes</option>
        <option value="No" <?php if ( $quoteDO->getSelected() == "No") {echo 'selected="selected"';} ?>>No</option>
       </select>
       <?php } ?>
      </div>

	  
	  

  

      
      <button type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>

      </form>

      <div class="app-form-nav-links" style="float:right">
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>

		  
	<script>
		$(function() {
			$( "#deliverydate" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});
		
    </script>


    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->