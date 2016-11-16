<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Report 1 - Requests over a period of time</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <ul class="breadcrumb">
      <li><?php echo anchor('/main/index', 'IVS'); ?></li>
      <li><?php echo anchor('/reports/report1', 'Reports'); ?></li>
      <li class="active">Report 1</li>
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
    
    ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <strong> Report 1 - Requests for a particular date </strong>
        </div>
        <div class="panel-body">
             <div class="form-group">
             <label for="sdate">Date</label>
             <input type="text" class="form-control" id="sdate" name="sdate" value="" placeholder="Select Date" required="required"/>
            </div>

            <button type="submit" class="btn btn-success" id="report1button"><?php echo $btnLabel; ?></button>
            <!--</form>-->
        </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <strong> Report showing - Requests for a particular date </strong>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
          <div id="report">
		  
		  </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->

    <script>

        $(function() {


            $('#report1button').click(function() {

            // clear chart area
            $( "#report" ).empty();

            // get chart data
            var request =  $.ajax({
            type: "POST",
            url: "report1data",
            data: {sdate:$('#sdate').val()},
            dataType: 'json'
            });

            request.done(function( msg ) {
              // build chart
              populateReport1(msg);
            });
            request.fail(function( jqXHR, textStatus){
              alert( "Error loading data: " + text
               );
            });

          });
           
        });

        /* Build bar chart */
        function populateReport1(d) {

			var result='<table width="100%"><tr><th>Name</th><th>Staff ID</th><th>Qty</th><th>Reason</th><th>Staff Email</th><th>Inventory ID</th></tr>';
			for(var i=1; i<d.length; i++)
			{
				result += '<tr>';
				result += '<td>' + d[i].requestorname  + '</td>';
				result += '<td>' + d[i].staffid + '</td>';
				result += '<td>' + d[i].quantityrequested + '</td>';
				result += '<td>' + d[i].reasonforrequest + '</td>';
				result += '<td>' + d[i].staffemail + '</td>';
				result += '<td>' + d[i].inventoryid + '</td>';
				result += '</tr>';
				
			}
			result += '</table>';
			$("#report").html(result);

        }
    </script>

    <script>
        $( document ).ready(function() {
            $( "#sdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#edate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>

    </div>
    <!-- /.jumbotron-->

</div>
<!-- /#page-wrapper -->





