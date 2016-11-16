<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Charts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/charts/index', 'Charts'); ?></li>
          <li class="active">Charts</li>
    </ul>

    <div class="jumbotron" style="padding-left: 20px;">
       <?php 
         if (isset($msg) && strlen($msg) > 0) { //display the message
          if ($msgType == 'error') {
           echo '<div class="alert alert-danger">';
          }
          elseif ($msgType == 'success') {
           echo '<div class="alert alert-success">';
          }
          else {
           echo '<div class="alert">';
          }
          echo $msg.'</div>';
         }
    
    ?>






    <!--
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong> Chart 2 - Requests over a period of time </strong>
        </div>
        <div class="panel-body">
            <?php
            $this->load->helper('form');
            echo form_open($action_1, array('role'=>'form'));
            ?>
             <div class="form-group">
             <label for="sdate">Start Date</label>
             <input type="text" class="form-control" id="sdate" name="sdate" value="" placeholder="Start Date" required="required"/>
            </div>

            <div class="form-group">
             <label for="edate">End Date</label>
             <input type="text" class="form-control" id="edate" name="edate" value="" placeholder="End Date" required="required"/>
            </div>

            <button type="submit" class="btn btn-success"><?php echo $btnLabel; ?></button>
            </form>
        </div>
    </div>
  -->



    


    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->





