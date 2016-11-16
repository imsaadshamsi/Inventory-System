<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Email</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/request/index', 'Request'); ?></li>
    </ul>
    <!-- /.breadcrumb -->

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
	?>
       
	<div class="form-group">
	 <label for="recipient">To:</label>
	 <input class="form-control" id="recipient" name="recipient" value="<?php echo $recipient; ?>" required="required"/>
	</div>

	<div class="form-group">
	 <label for="from">From:</label>
	 <input class="form-control" id="from" name="from" value="<?php echo $sender; ?>" required="required" readonly/>
	</div>

	<div class="form-group">
	 <label for="subjet">Subject:</label>
	 <input class="form-control" id="subject" name="subject" value="<?php echo $subject; ?>" required="required"/>
	</div>

	<div class="form-group">
	 <label for="message">Message:</label>
	<textarea class="form-control" id="message" name="message" rows="4" cols="50"><?php echo $message; ?>
	</textarea>
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