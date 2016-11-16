<?php

    $userLoggedOn = false;
    $record = $this->session->logon_userRec;
    if ($record != null || $record != '' || $record != false) {
        $userLoggedOn = true; 
    }



     // $logon_userRec = $this->session->userdata('logon_userRec');
     // if ($logon_userRec == null) {
     //    $userLoggedOn = false; 
     // }
     
     $logon_loginName = $this->session->loginName;
     if ($logon_loginName == null) {
      $loginName = '';
     }
     elseif (is_string($logon_loginName)) {
      $loginName = $logon_loginName;
     }
     else {
      $loginName = '';
     }


     $logon_isAdmin = $this->session->isAdmin;
     if ($logon_isAdmin === FALSE || $logon_isAdmin == null) {
      $isAdmin = 0;
     }
     else {
      $isAdmin = intval($logon_isAdmin);
     }


     // $logon_menuOption = $this->session->userdata('menuoption');
     // if (is_bool($logon_menuOption) && $logon_menuOption === FALSE) {
     //  $menuOption = 0;
     // }
     // else {
     //  $menuOption = intval($logon_menuOption);
     // } 

     $logon_userType = $this->session->userType;
     if($logon_userType != null || $logon_userType != '') {
        $userType = 1; //Regular User
        if( $logon_userType == 'Super User') $userType = 2; // Super user
        if( $logon_userType == 'Client User') $userType = 3; // Client user
     }
     
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory System v 1.0 - 2015</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/morrisjs/morris.min.js"></script>



</head>

<body>

<div id="wrapper">
    
<?php if ($userLoggedOn) { ?> 

      
    <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">IVS v 1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <?php if ($isAdmin == 0 && $userType != 3) { ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">

                        <?php 

                             $requestcount = 0;
                             $udo = null;
                             if($requests != null) {
                               while ($requests->hasMore() && $requestcount<=10) {
                                $udo = $requests->next($udo);
                                echo '<li>';
                                echo anchor('request/handle/' . $udo->getRequest_id(), '<div><strong>R' . $udo->getRequest_id() .
                                              ':</strong>' . $udo->getTitle(). ' Request<span class="pull-right text-muted"><em>' . $udo->getDate_received() . '</em></span>' .
                                          '</div>');
                                echo  '</li><li class="divider"></li>';
                                $requestcount  = $requestcount  + 1;

                               }
                            }
                        ?> 

                        <li>
                            <?php echo anchor('request/index', '<strong>See All Requests</strong> <i class="fa fa-angle-right"></i>', array('class'=>'text-center'));
                            ?>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">

                        <?php 

                             $alertcount = 0;
                             $udo = null;
                             if($alerts != null) {
                               while ($alerts->hasMore() && $alertcount<=10) {
                                $udo = $alerts->next($udo);
                                echo '<li>';
                                echo anchor('inventory/edit/' . $udo->getInventoryid(), '<div>' . $udo->getName() .
                                              '<span class="pull-right text-muted small"> ' . $udo->getStocknumber() . '</span>' .
                                          '</div>');
                                echo  '</li><li class="divider"></li>';
                                $alertcount  = $alertcount  + 1;
                               }
                            }
							 
							 
                        ?> 

                        <li>
                            <?php echo anchor('inventory/alerts', '<strong>See All Alerts</strong> <i class="fa fa-angle-right"></i>', array('class'=>'text-center'));
                            ?>
                        </li>

                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->

                <?php }  ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                       <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li> -->
                        <li> <?php echo anchor('main/logout','<i class="fa fa-sign-out fa-fw"></i> Logout: ' . $loginName ,array()); ?></li>
                         <li class="divider"></li>
                        <?php if($isAdmin == 0 && $userType == 1) { ?>
                        <li> <?php echo anchor('setting/index','<i class="fa fa-gear fa-fw"></i> Settings',array()); ?> 
                        </li>
                        <?php } ?>

                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                           <!-- <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> -->
                            <!-- /input-group -->
                        </li>

                        <?php if ($isAdmin == 0 ) { // Not Administrator ?>
						
				<?php if ($userType == 1 || $userType == 2) {  // Regular User and Super User?>
                            <li>
                                 <?php echo anchor('dashboard/index','<i class="fa fa-dashboard fa-fw"></i> Dashboard',array()); ?>
                            </li>

                            <li>
                                <?php echo anchor('inventory/index','<i class="fa fa-file-text-o fa-fw"></i> Inventory Management',array()); ?>

                            </li>

                            <li>
                                <?php echo anchor('inventory/alerts','<i class="fa fa-bell fa-fw"></i> Alerts',array()); ?>
                            </li>

                            <li>
                                <?php echo anchor('request/index','<i class="fa fa-envelope-o fa-fw"></i> Requests',array()); ?>
                            </li>

                            <li>
                                <?php echo anchor('reorder/index','<i class="fa fa-shopping-cart fa-fw"></i> Reorders',array()); ?>
                            </li>

                            <li>
                                <?php echo anchor('disbursement/index','<i class="fa fa-send fa-fw"></i> Disbursements',array()); ?>
                            </li>

                            <li>
                                <?php echo anchor('#','<i class="fa fa-history fa-fw"></i><span class="fa arrow"></span> History',array()); ?>
                                <ul >
                                   
<!--                                    <li>
                                        <?php // echo anchor('history/reorders','All Reorder History',array()); ?>
                                    </li>-->
                                    <li>
                                        <?php echo anchor('history/requesthistory','Requests History',array()); ?>
                                    </li>
                                    
                                    <li>
                                        <?php echo anchor('history/inventoryhistory','Inventory History',array()); ?>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                           <?php } ?>

                            <?php if ($userType == 2) {  // Super User Only?>
                            
                                <li>
                                    <?php echo anchor('#','<i class="fa fa-chain fa-fw"></i><span class="fa arrow"></span> Subsidiary',array()); ?>
                                    <ul >
                                        <li>
                                            <?php echo anchor('category/index','Category',array()); ?>
                                        </li>
                                        <li>
                                            <?php echo anchor('location/index','Location',array()); ?>
                                        </li>
                                        <li>
                                            <?php echo anchor('supplier/index','Suppliers',array()); ?>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>

                                <li>
                                    <?php // echo anchor('#','<i class="fa fa-files-o fa-fw"></i><span class="fa arrow"></span> Reports',array()); ?>
                                    <ul >
                                        <li>
                                            <?php //echo //anchor('reports/report1','Report 1',array()); ?>
                                        </li>
                                        <!--<li>
                                            <?php //echo //anchor('reports/report2','Report 2',array()); ?>
                                        </li> -->
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <?php //echo anchor('#','<i class="fa fa-bar-chart-o fa-fw"></i><span class="fa arrow"></span> Charts',array()); ?>
                                    <ul >
                                        <li>
                                            <?php //echo anchor('charts/chart1','Chart 1',array()); ?>
                                        </li>
                                        <!--<li>
                                            <?php // echo anchor('charts/chart2','Chart 2',array()); ?>
                                        </li> -->
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <?php // echo anchor('#','<i class="fa fa-table fa-fw"></i><span class="fa arrow"></span> Tables',array()); ?>
                                    <ul >
                                        <li>
                                            <?php //echo anchor('tables/table1','Table 1',array()); ?>
                                        </li>
                                        <!-- <li>
                                            <?php //echo anchor('tables/table2','Table 2',array()); ?>
                                        </li> -->
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                             <?php } ?>
							 
							 <?php if( $userType == 3) { // Client User?>
								<li>
									 <?php echo anchor('client/index','<i class="fa fa-home fa-fw"></i> Home',array()); ?>
								</li>
								<li>
									<?php echo anchor('client/requestlist','<i class="fa fa-envelope-o fa-fw"></i> Requests',array()); ?>
                                </li>
							<?php } ?>

                        <?php } ?>
						
						<?php if ($isAdmin == 1) { // Administrator ?>
                            <li>
                                 <?php echo anchor('users/index','<i class="fa fa-user fa-fw"></i> Users',array()); ?>
                            </li>
                            <li>
                                 <?php echo anchor('unit/index','<i class="fa fa-th fa-fw"></i> Units',array()); ?>
                            </li>
                        <?php } ?>
						
						

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

<?php } ?>