<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (isset($_POST['submit'])) 
{
    unset($_SESSION['error']);
    switch ($_POST['submit'])
    {
        case 'Add':
        if ((empty($_POST['url']) || empty($_POST['type']) || empty($_POST['media']) || empty($_POST['language']))) 
        {
            $_SESSION['error'] = "Input Error";
        }
        else
        {
            $url=$_POST['url'];
            $type=$_POST['type'];
            $media=$_POST['media'];
            $language=$_POST['language'];
            $query = "INSERT INTO ".$media." (URL,Type,Language) VALUES ('".$url."','".$type."','".$language."')";
        }
        break;
        case 'Remove':
        if (empty($_POST['vidid']))
        {
            $_SESSION['error'] = "Input Error";
        }
        else
        {
            $vidid = $_POST['vidid'];
            $media=$_POST['media'];
            $query = "DELETE FROM ".$media." WHERE VidID='".$vidid."'";
        }
        break;
		case 'AddCategory':
        if ((empty($_POST['addcat']) || empty($_POST['cat2add']))) 
        {
            $_SESSION['error'] = "Input Error";
        }
        else
        {
            $category=$_POST['cat2add'];
            $type=$_POST['addcat'];
            $query = "INSERT INTO categories (type,category) VALUES ('".$type."','".$category."')";
        }
        break;		
    }
    if (!isset($_SESSION['error']))
    {
        $db_handle->dbMod($query);
    }
    else
    {
        echo '<script type="text/javascript">alert("Input Error");</script>';
    }
}

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$type=$_POST['type'];
	$media=$_POST['media'];
	$language=$_POST['language'];

	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);

	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}
	$query = "INSERT INTO readings (name, type, size, content, language  ) ".
	"VALUES ('$fileName', '$type', '$fileSize', '$content', '$language')";

	$db_handle->dbMod($query); 
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

    <title> Medicality Admin - Forms </title>

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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> ADMIN <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="login.html"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
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
                
                    <li>
                        <a href="tables.php"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li class="active">
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Forms
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Forms
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
    
    </table> 
    <hr />


                <div class="row">
                    <div class="col-lg-6">

                        <h2>Add to Repository</h2>
    <form id="repository" action ="" method="post" enctype="multipart/form-data" onsubmit= "greeting()">
        <input type="radio" name="media" value="videos">Video</input>
        <br />
        <input type="radio" name="media" value="readings">Reading</input>
        <br />
        <br />
        <input type="radio" name="language" value="English">English</input>
        <br />
        <input type="radio" name="language" value="Spanish">Spanish</input>
        <br />
        <br />
        <input type="radio" name="type" value="Exercise">Exercise</input>
        <br />
        <input type="radio" name="type" value="Disease Management">Disease Management</input>
        <br />
        <input type="radio" name="type" value="Nutrition">Nutrition</input>
        <br />
        <h4>Video URL</h4>
        <input type="text" name="url"></input>
		<input type="submit" name="submit" value="Add">
		<h4>Text file</h4>
		<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
		<tr>
		<td width="246">
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile" type="file" id="userfile">
		</td>
		<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
		</tr>
		</table>
	</form>


        <script type="text/javascript">
            function greeting(){
                alert("Request Sent!!")
            }
        </script>

    </div>
<div class="col-lg-6">
                                
<h2>Remove from Repository</h2>
<form id="remove" action ="" method="post" enctype="multipart/form-data" onsubmit= "greeting()">
        <input type="radio" name="media" value="videos">Video</input>
        <br />
        <input type="radio" name="media" value="reading">Reading</input>
        <br />
        <br />
        <h4>ID</h4>
        <input type="text" name="vidid"></input>
        <input type="submit" name="submit" value="Remove">
        <br>
		</form>
</div>





<br>
</br>
<div class="col-lg-6">

<h3>Add category</h3>
<form id="addcat" action ="" method="post" enctype="multipart/form-data" onsubmit= "greeting()">
        <input type="radio" name="addcat" value="Fitness">Fitness</input>
        <br />
        <input type="radio" name="addcat" value="Nutrition">Nutrition</input>
        <br />
        <br />
        <h4>Category</h4>
        <input type="text" name="cat2add"></input>
        <input type="submit" name="submit" value="AddCategory">
        <br>
</form>
</div>



</form>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
