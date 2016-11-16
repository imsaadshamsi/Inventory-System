		<!-- Page Content -->
		<div id="page-wrapper" style="margin-left: 20px;margin-right: 10px">
		    
			<?php echo '<div>'.anchor('client/request',' Request',array('class'=>'btn btn-default glyphicon glyphicon-plus', 'style'=>'float:right; ' , 'role'=>'button')) . '</div>';
         	  	 ?>
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
	         	  	$this->load->helper('form');
	       			  echo form_open($action, array('role'=>'form'));
       			?>


       				<div class="input-group custom-search-form">
                        <input type="text" class="form-control" id="staffid" name="staffid" placeholder="Search..." value="">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" >
                            <i class="fa fa-search"></i>
                        </button>
                    	</span>
                    </div>

                   </form>


                   <div>
                   	<?php
                   		if($requestlist != null) {
                   	?>
                   	<div>
                      <table class="table">
                       <thead>
                        <tr>
                         <th><i class="fa fa-exclamation-circle fa-fw" style="color:red"></i></th>
                         <th>ID</td>
                         <th>Request</th>
                         <th>Qty Req</th>
                         <th>Qty App</th>
                         <th>Requestor</th>
                         <th>Status</th>
                         <th>&nbsp;</th>
                         <th>&nbsp;</th>
                         <th>&nbsp;</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php 
                         $udo = null;
                         while ($requestlist->hasMoreRequest()) {
                          $udo = $requestlist->next($udo);
                  
                          echo '<tr>';
                          echo '<td>'; 
                          if($udo->getPriority() == 1) echo '<i class="fa fa-exclamation-circle fa-fw" style="color:red"></i>';
                          echo '</td>';
                          echo '<td>' .'R'. $udo->getRequestid(). '</td>';
                          //echo '<td>' . anchor('request/handle/'. $udo->getRequestid(),'R'. $udo->getRequestid()) . '</td>';
                          echo '<td>' . $udo->getInventoryname()     . '</td>';
                          echo '<td>' . $udo->getQuantityrequested()  .'</td>';
                          echo '<td>' . $udo->getQuantityapproved()  .'</td>';
                          echo '<td>' . $udo->getStaffid()           . '</td>';
                          echo '<td>' . $udo->getStatus() . '</td>';
                          //echo '<td>' . anchor('request/handle/'. $udo->getRequestid(),'Email') . '</td>';
                          echo '</tr>';

                         }
                        ?>  
                       </tbody>
                      </table>
                    </div>
                   	<?php
                   		}
                   	?>
                  </div>

		 	</div>
    		<!-- /.jumbotron-->

		</div>
		<!-- /#page-wrapper -->

    
</div>
<!-- /#wrapper -->

