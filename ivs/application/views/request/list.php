<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Requests - All in Unit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/request/index', 'Request'); ?></li>
          <li class="active">Request</li>
    </ul>
    <!-- /.breadcrumb -->

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

         <?php 
                $this->load->helper('form');
                //echo form_open($action, array('role'=>'form'));
         ?>


             <!-- <div class="input-group custom-search-form" style="padding-top: 20px; padding-bottom: 20px;padding-right: 10px">
                        <input type="text" class="form-control" id="staffid" name="staffid" placeholder="Enter Staff ID..." value="">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" >
                            <i class="fa fa-search"></i>
                        </button>
                      </span>
              </div> -->

                   </form>

      <?php       
            // echo '<div>'.anchor('Request/new',' New Request',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button'));
            echo '<div>' . anchor('request/index','Refresh',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) . '</div>';

           
      ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th><i class="fa fa-exclamation-circle fa-fw" style="color:red"></i></th>
             <th>ID</td>
             <th>Request</th>
             <th>Status</th>
             <th>Date Received</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($requestlist->hasMore()) {
              $udo = $requestlist->next($udo);
      
              echo '<tr>';
              echo '<td>'; 
              if($udo->getPriority() == 1 && $udo->getStatus() != 'COMPLETED') echo '<i class="fa fa-exclamation-circle fa-fw" style="color:red"></i>';
              echo '</td>';
              echo '<td>' . anchor('request/handle/'. $udo->getRequest_id(),'R'. $udo->getRequest_id()) . '</td>';
              echo '<td>' . $udo->getTitle()     . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
              echo '<td>' . $udo->getDate_received() . '</td>';
              echo '<td>' . anchor('request/email/'. $udo->getRequest_id(),'Email') . '</td>';
              echo '</tr>';

             }
            ?>  
           </tbody>
          </table>
      </div>

    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->





