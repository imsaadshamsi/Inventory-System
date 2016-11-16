<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
        <li><?php echo anchor('/main/index', 'IVS'); ?></li>
        <li><?php echo anchor('/users/index', 'Users'); ?></li>
        <li class="active">Users</li>
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
         echo '<div>'.anchor('users/user',' New User',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>#</th>
             <th>Name</th>
             <th>LDAP User Name</th>
             <th>Is Admin</th>
             <th>Status</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($userList->hasMore()) {
              $udo = $userList->next($udo);
              echo '<tr><td>'.$i.'</td><td>'.$udo->getUserName().'</td>';
              echo '<td>'.$udo->getLdapUserCode().'</td>';
              echo '<td>'.($udo->getIsAdmin()==1?'Yes':'No').'</td>';
              echo '<td>'.($udo->getUserActive()==1?'Active':'Inactive').'</td>';
              echo '<td>'.anchor('users/edit/'.$udo->getUserId(),'Edit').'</td>';
              echo '<td>'.anchor('users/remove/'.$udo->getUserId(),'Remove').'</td>';
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





