<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Assets - All</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/asset/index', 'Assets'); ?></li>
          <li class="active">Assets</li>
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
     echo '<div class="jumbotron" >'. anchor('/asset/asset/0',' New Asset',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).
     anchor('/asset/index','Refresh',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) .

     anchor('/asset/export/all','Export All',array('class'=>'btn btn-warning','role'=>'button', 'style'=>'float:right; margin-right: 30px;')) .

      '</div>';   
?>



      <div>
          <table  id="table_id" class="display">
           <thead>
            <tr>
			       <th>Asset ID</th>
             <th>Ptag Code</th>
             <th>Otag Code</th>
             <th>Comm Code</th>
             <th>Asset Descr </th>
             <th>Serial Num</th>
             <th>Stat</th>
             <th>Pohd Code</th>
            </tr>
           </thead>
           <tbody>
            <?php 

             $i = 1;
             $udo = null;
             while ($assetlist->hasMore()) {
              $udo = $assetlist->next($udo);

              echo '<tr >';
              echo '<td>' . $udo->getAsset_id() . '</td>';
              echo '<td>' . anchor('asset/asset/'.$udo->getAsset_id(), $udo->getPtag_code()) . '</td>';
              echo '<td>' . $udo->getOtag_code(). '</td>';
              echo '<td>' . $udo->getComm_code(). '</td>';
              echo '<td>' . $udo->getAsset_descr(). '</td>';
              echo '<td>' . $udo->getSerial_num(). '</td>';
              echo '<td>' . $udo->getStat(). '</td>';
              echo '<td>' . $udo->getPohd_code(). '</td>';


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



