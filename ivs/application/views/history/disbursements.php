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
        <?php $action= '/history/disbursementhistory';
        $btnLabel = 'Find';
        
        
        ?>

          <?php $this->load->helper('form');
       echo form_open($action,array('role'=>'form'));
       
       echo '<input type="hidden" id="id" name="id" value="'.  $id . '" />';
       ?>
        
          <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Disbursements between:</strong>
        </div>
        <div class="panel-body">
            
           
             <div class="form-group">
             <label for="sdate">From Date</label>
             <input type="text" class="form-control" id="sdate" name="sdate" value="" placeholder="Select Date" required="required"/>
            </div>
            
            <div class="form-group">
             <label for="tdate">To Date</label>
             <input type="text" class="form-control" id="tdate" name="tdate" value="" placeholder="Select Date" required="required"/>
            </div>

            <button type="submit" class="btn btn-success" ><?php echo $btnLabel; ?></button>
          
        </div>
    </div>  
        
                </form>


      <div>
          <table class="table">
           <thead>
            <tr>
                <th>UUID </th>
            <th>Date Occurred</th>
            <th>Status</th>
            <th>Quantity </th>
            <th>From Unit </th>
            <th>Comments</th>
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
              echo '<td>' . $udo->getDisbursementuuid() . '</td>';
              echo '<td>' . $udo->getDate_disbursed() . '</td>';
              echo '<td>' . $udo->getStatus() . '</td>';
              echo '<td>' . $udo->getQuantity_disbursed()     . '</td>';
              echo '<td>' . $udo->getUnitname()     . '</td>';
              echo '<td>' . $udo->getComments()     . '</td>';
	
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

<script>
        $( document ).ready(function() {
            $( "#sdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#tdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>





