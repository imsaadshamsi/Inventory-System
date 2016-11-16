 <?php
  $requestcount = 0;
 $udo = null;
 while ($request->hasMore()) {
  $udo = $request->next($udo);
  $requestcount  = $requestcount  + 1;

 }

 $alertcount = 0;
 $udo = null;
 while ($alert->hasMore()) {
  $udo = $alert->next($udo);
  $alertcount  = $alertcount  + 1;
 }

 $inventorycount = 0;
 $udo = null;
 while ($inventory->hasMore()) {
  $udo = $inventory->next($udo);
  $inventorycount  = $inventorycount  + 1;
 }

 $reorderscount = 0;
 $udo = null;
 while ($reorders->hasMore()) {
  $udo = $reorders->next($udo);
  $reorderscount  = $reorderscount  + 1;
 }

?>


 <div id="page-wrapper">
 
 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
			
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bell fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $alertcount; ?></div>
                                    <div>Alerts!</div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        echo anchor('inventory/alerts', '<div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>', array('class'=>'text-center'));
                        ?>
                    </div>
                </div>
                <!-- / Reorders -->

             

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $reorderscount; ?></div>
                                    <div>Reorders!</div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        echo anchor('reorder/index', '<div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>', array('class'=>'text-center'));
                        ?>
                    </div>
                </div>
              

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $inventorycount; ?></div>
                                    <div>Inventory!</div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        echo anchor('inventory/index', '<div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>', array('class'=>'text-center'));
                        ?>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-envelope fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $requestcount; ?></div>
                                    <div>Requests!</div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        echo anchor('request/index', '<div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>', array('class'=>'text-center'));
                        ?>
                    </div>
                </div>
                <!-- / Requests -->
                
            </div>
            <!-- /.row -->



<!-- SHOW -->
  

<!-- SHOW -->















            
        </div>
        <!-- /#page-wrapper -->
