<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Units</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/unit/index', 'Units'); ?></li>
          <li class="active">Units</li>
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
         echo '<div>'.anchor('unit/new',' New Unit',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>#</th>
             <th>Unit Name</th>
             <th>Site</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($unitlist->hasMore()) {
              $udo = $unitlist->next($udo);
              echo '<tr><td>'.$i.'</td><td>'.$udo->getUnitname().'</td>';
              echo '<td>' . $udo->getSite() . '</td>';
              echo '<td>'.anchor('unit/edit/'.$udo->getUnitid(),'Edit').'</td>';
              echo '<td>'.anchor('unit/remove/'.$udo->getUnitid(),'Remove').'</td>';
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





