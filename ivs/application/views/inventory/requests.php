<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inventory: Requests for <?php echo $inventoryDO->getName() ?> </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
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
        // echo '<div>'.anchor('Request/new',' New Request',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button'));
       // echo '<div>' . anchor('request/index','Refresh',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) . '</div>';

       
    ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th><i class="fa fa-exclamation-circle fa-fw" style="color:red"></i></th>
             <th>ID</td>
             <th>Request</th>
             <th>Qty Req</th>
             <th>Qty App</th>
             <th>Requestor</th>
             <th>Date needed</th>
             <th>Status</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($requestlist->hasMoreRequest()) {
              $udo = $requestlist->next($udo);
      
              echo '<tr>';
              echo '<td>'; 
              if($udo->getPriority() == 1) echo '<i class="fa fa-exclamation-circle fa-fw" style="color:red"></i>';
              echo '</td>';
              echo '<td>' . anchor('request/handle/'. $udo->getRequestid(),'R'. $udo->getRequestid()) . '</td>';
              echo '<td>' . $udo->getInventoryname()     . '</td>';
              echo '<td>' . $udo->getQuantityrequested()  .'</td>';
              echo '<td>' . $udo->getQuantityapproved()  .'</td>';
              echo '<td>' . $udo->getStaffid()           . '</td>';
              echo '<td>' . $udo->getDateneeded()            . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
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





