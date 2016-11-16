<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Attachment</h1>
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
          <li class="active">Remove Attachment</li>
          <?php } else if($mode=='edit') {?>
          <li class="active">Edit Attachment</li>
          <?php } else if($mode=='new')  {?>
          <li class="active">New Attachment</li>
          <?php } ?>
    </ul>
    <!-- /.breadcrumb -->

    <div class="jumbotron" style="padding-left: 20px;">
      
      <?php
       $this->load->helper('form');
        echo form_open_multipart($action,array('role'=>'form'));


       echo '<input type="hidden" id="reorderid" name="reorderid" value="'.$reorderid.'" />';
       echo '<input type="hidden" id="attachmentid" name="attachmentid" value="'.$attachmentid.'" />';
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
        <p class="form-control-static"><?php echo $attachmentDO->getTitle(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="title" name="title" value="<?php echo $attachmentDO->getTitle(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>

<!--      <div class="form-group">
       <label for="userfile">URL</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $attachmentDO->getUrl(); ?></p>
       <?php } else { ?>
       <input type="file" id="userfile" name="userfile" class="form-control" value="<?php echo $attachmentDO->getUrl(); ?>" placeholder=""  />
        <p class="form-control-static"><?php echo $attachmentDO->getUrl(); ?></p>
       <?php } ?>
      </div>-->
        
        
	 <div class="form-group">
	   <label for="userfile">Quote</label>
	   <p><?php if($attachmentDO->getUrl() != '') echo anchor(base_url().  'index.php/reorder/viewFile/' . $attachmentDO->getUrl(), $attachmentDO->getUrl(), array('target'=>'_blank')); ?></p>
	   <input type="file"  id="userfile" name="userfile" value="<?php echo $attachmentDO->getUrl(); ?>"  placeholder="Select the file to upload" />
	  </div>

      <div class="form-group">
       <label for="type">Type</label>
        <select  name="type" id="type" class="form-control" >
        <?php 
            
             $sites = array("RECEIVE RECEIPT", "INVOICE", "OTHER" , "NOTE");
            $v='';
            for($i=0; $i<sizeof($sites); $i++) {
              if($sites[$i] == $attachmentDO->getType()) $v='selected="selected"';
              echo '<option value="' . $sites[$i] . '"' . $v . '>' . $sites[$i]  . '</option>';
              $v='';
            }
            
          ?>
       </select>
      </div>

      <div class="form-group">
       <label for="Userid">Userid</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $attachmentDO->getUserid(); ?></p>
       <?php } else { ?>
       <input type="text" class="form-control" id="userid" name="userid" value="<?php echo $attachmentDO->getUserid(); ?>" placeholder="" required="required" />
       <?php } ?>
      </div>



      <div class="form-group">
       <label for="dateadded">Date Added</label>
       <?php if ($mode == 'remove') { ?>
        <p class="form-control-static"><?php echo $attachmentDO->getDateadded(); ?></p>
       <?php } else { ?>
       <input readonly type="text" class="form-control" id="dateadded" name="dateadded" value="<?php echo $attachmentDO->getDateadded(); ?>" placeholder="" />
       <?php } ?>
      </div>



     

      
      <button type="submit" class="btn btn-success" ><?php echo $btnLabel; ?></button>

      </form>

      <div class="app-form-nav-links" style="float:right">
       <?php echo anchor($backAction, 'Back', array('class'=>'btn btn-primary','role'=>'button')); ?>
      </div>

		  



    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->