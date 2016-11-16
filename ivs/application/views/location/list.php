<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Locations</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/location/index', 'Location'); ?></li>
          <li class="active">Locations</li>
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
         echo '<div>'.anchor('location/new',' New Location',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>#</th>
             <th>Location</th>
             <th>Description</th>
             <th>Location Code</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($locationlist->hasMore()) {
              $udo = $locationlist->next($udo);
              echo '<tr><td>'.$udo->getLocationid().'</td><td>'.$udo->getLocation().'</td>';
              echo '<td>' . $udo->getDescription() . '</td>';
              echo '<td>' . $udo->getLocationcode() . '</td>';
              echo '<td>'.anchor('shelving/index/'.$udo->getLocationid(),'Shelving').'</td>';
              echo '<td>'.anchor('location/edit/'.$udo->getLocationid(),'Edit').'</td>';
              echo '<td>'.anchor('location/remove/'.$udo->getLocationid(),'Remove').'</td>';

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





