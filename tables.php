<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$fitArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='Exercise' ORDER BY VidID ASC");
$healthArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='disease management' ORDER BY VidID ASC");
$dietArray = $db_handle->runQuery("SELECT * FROM videos WHERE type='Nutrition' ORDER BY VidID ASC");
$catArray = $db_handle->runQuery("SELECT * FROM categories ORDER BY categoryid ASC");
$commentArray = $db_handle->runQuery("SELECT * FROM comments GROUP BY vidID");
?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Medicality Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li class="active">
                        <a href="tables.php"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tables
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="tables.php"><i class="fa fa-fw fa-bar-chart-o"></i> Tables</a>
                    </li>
                    
                            <li class="active">
                                <i class="fa fa-table"></i> Tables
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row"  >
                    <div class="col-lg-6" >
                        
                            <h2>Video Usage</h2>
                            <div style="width:150%">
                        <div class="table-responsive" >


                            <table class="table table-bordered table-hover" >
                                <thead>
                                     <tr>
        <th>ID</th>
        <th>URL</th>
        <th>Views</th>
        <th>Type</th>
        <th>Language</th>
		<th>Likes</th>
		<th>Dislikes</th>
      </tr>
        <?php
        if (!empty($fitArray)) { 
            foreach($fitArray as $key=>$value)
            {
            ?>
                <tr>
                    <td>
                        <?php echo $fitArray[$key]["VidID"] ?>
                    </td>
                    <td>
                        <?php echo $fitArray[$key]["URL"] ?>
                    </td>
                    <td>
                        <?php echo $fitArray[$key]["ViewCount"] ?>
                    </td>
                    <td>
                        <?php echo $fitArray[$key]["Type"] ?>
                    </td>
                    <td>
                        <?php echo $fitArray[$key]["Language"] ?>
                    </td>
					<td>
                        <?php echo $fitArray[$key]["approve"] ?>
                    </td>
					<td>
                        <?php echo $fitArray[$key]["dislike"] ?>
                    </td>
                </tr>
            <?php
            }
        }?>
        <?php
        if (!empty($healthArray)) { 
            foreach($healthArray as $key=>$value)
            {
            ?>
                <tr>
                    <td>
                        <?php echo $healthArray[$key]["VidID"] ?>
                    </td>
                    <td>
                        <?php echo $healthArray[$key]["URL"] ?>
                    </td>
                    <td>
                        <?php echo $healthArray[$key]["ViewCount"] ?>
                    </td>
                    <td>
                        <?php echo $healthArray[$key]["Type"] ?>
                    </td>
                    <td>
                        <?php echo $healthArray[$key]["Language"] ?>
                    </td>
					<td>
                        <?php echo $healthArray[$key]["approve"] ?>
                    </td>
					<td>
                        <?php echo $healthArray[$key]["dislike"] ?>
                    </td>
                </tr>
            <?php
            }
        }?>
                <?php
        if (!empty($dietArray)) { 
            foreach($dietArray as $key=>$value)
            {
            ?>
                <tr>
                    <td>
                        <?php echo $dietArray[$key]["VidID"] ?>
                    </td>
                    <td>
                        <?php echo $dietArray[$key]["URL"] ?>
                    </td>
    
                    <td>
                        <?php echo $dietArray[$key]["ViewCount"] ?>
                    </td>
                    <td>
                        <?php echo $dietArray[$key]["Type"] ?>
                    </td>
                    <td>
                        <?php echo $dietArray[$key]["Language"] ?>
                    </td>
					<td>
                        <?php echo $dietArray[$key]["approve"] ?>
                    </td>
					<td>
                        <?php echo $dietArray[$key]["dislike"] ?>
                    </td>
                </tr>
            <?php
         }
        }?>
    </table> 
	<h2>Search Categories</h2>
	<table class="table table-bordered table-hover" >
                                <thead>
                                     <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Category</th>
      </tr>
        <?php
        if (!empty($catArray)) { 
            foreach($catArray as $key=>$value)
            {
            ?>
                <tr>
                    <td>
                        <?php echo $catArray[$key]["categoryid"] ?>
                    </td>
                    <td>
                        <?php echo $catArray[$key]["type"] ?>
                    </td>
                    <td>
                        <?php echo $catArray[$key]["category"] ?>
                    </td>
                </tr>
            <?php
            }
        }?>
    </table> 
	<h2>Comments</h2>
	<table class="table table-bordered table-hover" >
                                <thead>
                                     <tr>
        <th>Video ID</th>
        <th>Comment</th>
      </tr>
        <?php
        if (!empty($commentArray)) { 
            foreach($commentArray as $key=>$value)
            {
            ?>
                <tr>
                    <td>
                        <?php echo $commentArray[$key]["vidID"] ?>
                    </td>
                    <td>
                        <?php echo $commentArray[$key]["comment"] ?>
                    </td>
                </tr>
            <?php
            }
        }?>
    </table> 
    
</div>

                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>