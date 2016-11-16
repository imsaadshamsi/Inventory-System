<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Disbursements</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
        <li><?php echo anchor('/main/index', 'IVS'); ?></li>
        <li><?php echo anchor('/disbursement/index', 'Disbursements'); ?></li>
        <li class="active">Disbursements</li>
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
         // echo '<div>'.anchor('users/user',' New User',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>



    


          


    

          <table class="table">
           <thead>
            <tr>
             <th>Disbursement</th>
             <th>Code</th>
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
                echo '<td>' . anchor('/disbursement/view/edit/'.  $udo->getDisbursementuuid() . '/' . $udo->getRequestid(), 'Disbursement-' . $i ) .  '</td>';
                echo '<td>' . $udo->getCode() . '</td>';
                echo '<td>' . $udo->getStatus() . '</td>';
                echo '<td>' . $udo->getUser_id()  .'</td>';
                echo '<td>' . $udo->getDate_disbursed() .'</td>';
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





