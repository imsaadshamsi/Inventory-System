<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inventory - All in Unit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
          <li class="active">Inventory</li>
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


            <!--  <div class="input-group custom-search-form" style="padding-top: 20px; padding-bottom: 20px; padding-right: 10px">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Enter Stock Number..." value="">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" >
                            <i class="fa fa-search"></i>
                        </button>
                      </span>
               </div>
			    </form>
-->
         



<?php 
         echo '<div>'.anchor('inventory/new',' New Inventory',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).
        '</div>';

       
?>



      <div style="margin-top: 20px">
	  
          <table id="table_id" class="display">
           <thead>
            <tr>
             <th><i class="fa fa-bell fa-fw" style="color:red"></i></th>
			
             <th>Stock Number</th>
             <th>Name</th>
             <th>Status</th>
             <th>Qty</th>
             <th>Min</th>
			 <th>H</th>
			 <th>P</th>

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
			  //echo '<td>' . $udo->getInventoryid() . '</td>';
              echo '<td>'. anchor('inventory/edit/'.$udo->getInventoryid(),'' . $udo->getStocknumber()) .'</td>';
              echo '<td>' . $udo->getName() . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
              echo '<td>' . $udo->getQuantityavailable() . '</td>';
              echo '<td>' . $udo->getMinimumquantity() . '</td>';
              

              echo '<td>' .anchor('history/disbursementhistory/'.$udo->getInventoryid(),'<i class="fa fa-history"></i>', array('class'=>'btn btn-outline btn-primary btn-circle','role'=>'button', 'title'=>'History')) . '</td>';
             
              //echo '<td>' .anchor('inventory/requests/'.$udo->getInventoryid(),'<i class="fa fa-envelope-o"></i>', array('class'=>'btn btn-outline btn-success btn-circle','role'=>'button', 'title'=>'Requests')) . '</td>';

              //echo '<td>' .anchor('inventory/reorders/'.$udo->getInventoryid(),'<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-outline btn-warning btn-circle','role'=>'button', 'title'=>'Reorder')) . '</td>';
      
              echo '<td>' . anchor('inventory/pdf/' . $udo->getInventoryid() ,'PDF') . '</td>';

               echo '</tr>';

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


<script type="text/javascript">

//$(document).ready( function () {
    $('#table_id').DataTable(
      {
        "paging": true,
        "lengthChange": true,
		"stateSave": true
      });
//} );

</script>





