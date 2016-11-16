<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Requests - All From Unit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/client/index', 'IVS'); ?></li>
          <li><?php echo anchor('/client/index', 'Request'); ?></li>
          <li class="active">Requests</li>
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
            echo '<div>'.anchor('client/request/new/0',' New Request',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button'));
      ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th><i class="fa fa-exclamation-circle fa-fw" style="color:red"></i></th>
             <th>ID</td>
             <th>Title</th>
             <th>Date</th>
             <th>Status</th>
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
              if($udo->getPriority() == 1) echo '<i class="fa fa-exclamation-circle fa-fw" style="color:red"></i>';
              echo '</td>';
              echo '<td>' . anchor('/client/request/edit/'. $udo->getRequest_id(),'R'. $udo->getRequest_id()) . '</td>';
              echo '<td>' . $udo->getTitle()     . '</td>';
              echo '<td>' . $udo->getDate_received()  .'</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
			//  echo '<td>' . anchor('/client/request/remove/' .  $udo->getRequest_id(), 'Remove', array())  .'</td>';
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





