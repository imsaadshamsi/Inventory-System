<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Settings</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
        <li><?php echo anchor('/main/index', 'IVS'); ?></li>
        <li><?php echo anchor('/setting/index', 'Settings'); ?></li>
        <li class="active">Settings</li>
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
         echo '<div>'.anchor('setting/new',' New Setting',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>Name</th>
             <th>Email</th>
             <th>Setting Type</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($settingList->hasMoreSettings()) {
              $udo = $settingList->next($udo);
              echo '</tr>';
              echo '<td>'.$udo->getName().'</td>';
              echo '<td>'.$udo->getEmail().'</td>';
              echo '<td>'.$udo->getSettingtype().'</td>';
              echo '<td>'.anchor('setting/edit/'.$udo->getSettingid(),'Edit').'</td>';
              echo '<td>'.anchor('setting/remove/'.$udo->getSettingid(),'Remove').'</td>';
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





