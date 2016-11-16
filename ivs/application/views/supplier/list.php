<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Suppliers</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/supplier/index', 'Suppliers'); ?></li>
          <li class="active">Suppliers</li>
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
         echo '<div>'.anchor('supplier/new',' New Supplier',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>#</th>
             <th>Supplier</th>
             <th>Telephone</th>
			 <th>Contact Person</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($supplierlist->hasMore()) {
              $udo = $supplierlist->next($udo);
              echo '<tr><td>'.$i.'</td><td>'.$udo->getSuppliername().'</td>';
              echo '<td>' . $udo->getTelephone() . '</td>';
			  echo '<td>' . $udo->getContactperson() . '</td>';
              echo '<td>'.anchor('supplier/edit/'.$udo->getSupplierid(),'Edit').'</td>';
              echo '<td>'.anchor('supplier/remove/'.$udo->getSupplierid(),'Remove').'</td>';
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





