<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quote Listing</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'Inventory'); ?></li>
          <li><?php echo anchor('/reorder/index/' . $reorderDO->getInventoryid(), 'Reorders'); ?></li>
          <li><?php echo anchor('/quote/index/' . $reorderDO->getReorderid(), 'Quote'); ?></li>
          <li class="active">Quote</li>
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

         if($reorderDO->getStatus() == "PENDING")
         echo '<div>'.anchor('quote/new/' . $reorderDO->getReorderid() ,' New Quote',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')) . '</div>';

       
    ?>


      <div>
          <table class="table">
           <thead>
            <tr>
             <th>Quote ID</th>
             <th>Supplier</th>
             <th>Quote Amount</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($quotelist->hasMoreQuotes()) {
              $udo = $quotelist->next($udo);
      
              echo '<tr>';
              echo '<td>' . anchor('quote/edit/'. $udo->getQuoteid() . '/' . $reorderDO->getReorderid(), $udo->getQuoteid()) . '</td>';
              echo '<td>' . $udo->getSuppliername() . '</td>';
              echo '<td>' . $udo->getQuoteamount() . '</td>';

              if($reorderDO->getStatus() == "PENDING")
              echo '<td>' .anchor('quote/remove/'.$udo->getQuoteid(),'Remove' ) . '</td>';
              else echo '<td>Cannot Remove </td>';
      
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





