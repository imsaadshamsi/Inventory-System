<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reorder History</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/inventory/index', 'History'); ?></li>
          <li class="active">Reorder History</li>
    </ul>
    <!-- /.breadcrumb -->

    <div class="jumbotron" style="padding-left: 20px;">


      <div>
          <table class="table">
           <thead>
            <tr>
			 <th>Date Occurred</th>
			 <th>User ID</th>
             <th>Reorder ID</th>
             <th>Comments</th>
             <th>Status</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($historylist->hasMoreHistory()) {
              $udo = $historylist->next($udo);
      
              echo '<tr>';
              echo '<td>' . $udo->getDateoccurred() . '</td>';
              echo '<td>' . $udo->getUserid() . '</td>';
              echo '<td>' . $udo->getReorderid()     . '</td>';
			  echo '<td>' . $udo->getComments()     . '</td>';
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





