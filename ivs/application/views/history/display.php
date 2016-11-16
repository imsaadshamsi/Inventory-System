<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $pagetitle; ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li class="active">History</li>
    </ul>
    <!-- /.breadcrumb -->

    <div class="jumbotron" style="padding-left: 20px;">


      <div>
          <table class="table">
           <thead>
            <tr>
            <th>Date Occurred</th>
            <th>User ID </th>
            <th>Table Name </th>
            <th>Query Type </th>
            <th>Changes</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $udo = null;
             while ($history->hasMore()) {
              $udo = $history->next($udo);
              echo '<tr>';
              echo '<td>' . $udo->getDate() . '</td>';
              echo '<td>' . $udo->getUserid() . '</td>';
              echo '<td>' . $udo->getTablename()     . '</td>';
              echo '<td>' . $udo->getQuerytype()     . '</td>';
              echo '<td>' . $udo->getFieldname() . '</br>' . $udo->getFieldvalue()  . '</td>';
	
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





