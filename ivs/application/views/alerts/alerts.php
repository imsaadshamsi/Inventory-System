<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Alerts - All in Unit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/alerts', 'Alerts'); ?></li>
          <li class="active">Alerts</li>
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
         //echo '<div>'.anchor('inventory/new',' New Inventory',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).
         echo  '<div>' . anchor('inventory/alerts','Refresh',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) . '</div>';

       
    ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th><i class="fa fa-bell fa-fw" style="color:red"></i></th>
             <th>Stock Number</th>
             <th>Name</th>
             <th>Status</th>
             <th>Qty</th>
             <th>Min</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 

             $i = 1;
             $udo = null;
             while ($inventorylist->hasMore()) {
              $udo = $inventorylist->next($udo);
              $low = 0; // 2 = No
              $color = '';
              if ($udo->getFlag() == 1) {  // 1 = Yes
                $low = 1;
                $color = ' bgcolor="#F5BFBF" ';
              }

              echo '<tr >';
              echo '<td>'; 
              if($low) echo '<i class="fa fa-bell fa-fw" style="color:red"></i>';
              echo '</td>';
              //echo '<td>'. anchor('inventory/edit/'.$udo->getInventoryid(),'' . $udo->getStocknumber()) .'</td>';
              echo '<td>' . $udo->getStocknumber() . '</td>';
              echo '<td>' . $udo->getName() . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
              echo '<td>' . $udo->getQuantityavailable() . '</td>';
              echo '<td>' . $udo->getMinimumquantity() . '</td>';
              
              // echo '<td><button type="button" class="btn btn-outline btn-primary btn-circle" title="History"><i class="fa fa-history"></i></button></td>';

             // echo '<td>' .anchor('inventory/history/'.$udo->getInventoryid(),'<i class="fa fa-history"></i>', array('class'=>'btn btn-outline btn-primary btn-circle','role'=>'button', 'title'=>'History')) . '</td>';
             
             // echo '<td><button type="button" class="btn btn-outline btn-primary btn-circle" title="Requests"><i class="fa fa-envelope-o"></i></button></td>';

            //  echo '<td>' .anchor('inventory/requests/'.$udo->getInventoryid(),'<i class="fa fa-envelope-o"></i>', array('class'=>'btn btn-outline btn-primary btn-circle','role'=>'button', 'title'=>'Requests')) . '</td>';

              //if($low) echo '<td><button type="button" class="btn btn-outline btn-danger btn-circle" title="Reorder"><i class="fa fa-shopping-cart" ></i></button></td>';
              //else echo '<td></td>';

              //if($low) echo '<td>' .anchor('inventory/reorders/'.$udo->getInventoryid(),'<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-outline btn-warning btn-circle','role'=>'button', 'title'=>'Reorder')) . '</td>';
              //else echo '<td></td>';

              $i = $i + 1;
             }
            ?>  
           </tbody>
          </table>
      </div>

    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->





