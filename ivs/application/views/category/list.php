<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
          <li><?php echo anchor('/main/index', 'IVS'); ?></li>
          <li><?php echo anchor('/category/index', 'Category'); ?></li>
          <li class="active">Categories</li>
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
         echo '<div>'.anchor('category/new',' New Category',array('class'=>'btn btn-primary glyphicon glyphicon-plus','role'=>'button')).'</div>';
    ?>

      <div>
          <table class="table">
           <thead>
            <tr>
             <th>#</th>
             <th>Category</th>
             <th>Description</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
             <th>&nbsp;</th>
            </tr>
           </thead>
           <tbody>
            <?php 
             $i = 1;
             $udo = null;
             while ($categorylist->hasMore()) {
              $udo = $categorylist->next($udo);
              echo '<tr><td>'.$i.'</td><td>'.$udo->getCategory().'</td>';
              echo '<td>' . $udo->getDescription() . '</td>';
              echo '<td>'.anchor('category/edit/'.$udo->getCategoryid(),'Edit').'</td>';
              echo '<td>'.anchor('category/remove/'.$udo->getCategoryid(),'Remove').'</td>';
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





