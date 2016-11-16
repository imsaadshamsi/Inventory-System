<?php

    $userLoggedOn = false;
    $record = $this->session->logon_userRec;
    if ($record != null || $record != '' || $record != false) {
        $userLoggedOn = true; 
    }
     
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

    <title>Inventory System v 1.1 - 2015</title>

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
	
	<!-- Data Tables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">


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
	
	<!-- Data Tables -->
	<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>



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
                <a class="navbar-brand" href="index.html">IVS v 1.1</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <?php if ($isAdmin == 0 && $userType != 4) { ?>
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
                        <?php if($isAdmin == 1 && $userType == 1) { ?>
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
                        
                        
                        <?php 
                            $i = 1;
                            $udo = null;
                            while ($pages->hasMore()) {
                                $udo = $pages->next($udo);
                             
                                echo '<li>' .  anchor($udo->getUrl(),$udo->getRendername(),array()) . '</li>';
                        
                            }
                        
                        
                        ?>
                        
						

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

<?php } ?>