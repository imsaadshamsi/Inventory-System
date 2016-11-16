<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reorders: <?php echo $inventoryDO->getName(); ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
          <li><?php echo anchor('/reorder/index/' . $inventoryDO->getInventoryid(), 'Reorder'); ?></li>
          <li class="active">Reorder</li>
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
        echo '<div>'.anchor('reorder/new/' . $inventoryDO->getInventoryid() ,' New Reorder',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button'));
        echo  anchor('reorder/index','Refresh',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) . '</div>';

       
    ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th>Reorder ID</th>
             <th>Description</th>
             <th>Date Initiated</th>
             <th>Status</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($reorderlist->hasMoreReorder()) {
              $udo = $reorderlist->next($udo);
      
              echo '<tr>';
              echo '<td>' . $udo->getReorderid() . '</td>';
              echo '<td>' . anchor('reorder/edit/'. $udo->getReorderid(), $udo->getDescription()) . '</td>';
              
              echo '<td>' . $udo->getDateinitiated()     . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';

              echo '<td>' .anchor('quote/index/'.$udo->getReorderid(),'Quotes' ) . '</td>';

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





