<!DOCTYPE html>
<html dir="ltr" lang="en">
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php 
include("database/db_connection.php"); 
$total_users="SELECT id FROM user_details";
$countUsers=mysqli_num_rows(mysqli_query($dbcon,$total_users));


$total_healthy="SELECT id FROM health_details where (body_temperature between 97 and 100) and (blood_presure between 80 and 120) and (pulse between 60 and 100) and (respiration between 12 and 24) and (glucose between 70 and 99) and (oxygen_saturation between 90 and 100) and (electro_cardiogram between 120 and 200)";
$countHealthy=mysqli_num_rows(mysqli_query($dbcon,$total_healthy));

$total_unhealthy="SELECT id FROM health_details where (body_temperature not between 97 and 100) or (blood_presure not between 80 and 120) or (pulse not between 60 and 100) or (respiration not between 12 and 24) or (glucose not between 70 and 99) or (oxygen_saturation not between 90 and 100) or (electro_cardiogram not between 120 and 200)";
$countUnHealthy=mysqli_num_rows(mysqli_query($dbcon,$total_unhealthy));

if (isset($_POST['username'])){
    $search = $_POST['username'];

    $total_unhealthyBT="SELECT b.user_name,a.body_temperature,a.blood_presure,a.pulse,a.respiration,a.respiration,a.glucose,a.oxygen_saturation,a.electro_cardiogram FROM health_details a,user_details b where a.user_id=b.id and ( b.user_name LIKE '%$search%' OR b.email_id LIKE '%$search%')";
}else{
    $total_unhealthyBT="SELECT b.user_name,a.body_temperature,a.blood_presure,a.pulse,a.respiration,a.glucose,a.oxygen_saturation,a.electro_cardiogram FROM health_details a,user_details b where a.user_id=b.id and ((body_temperature not between 97 and 100) or (blood_presure not between 80 and 120) or (pulse not between 60 and 100) or (respiration not between 12 and 24) or (glucose not between 70 and 99) or (oxygen_saturation not between 90 and 100) or (electro_cardiogram not between 120 and 200))";
}
$run=mysqli_query($dbcon,$total_unhealthyBT);
    //$count = mysqli_num_rows($run);
    $output = "";
    $user_name = Array();
    $user_bt = Array();
    $user_bp = Array();
    $user_pulse = Array();
    $user_resp = Array();
    $user_gluc = Array();
    $user_os = Array();
    $user_ecg = Array();
      while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
       {    
            $user_name[] = $row[0];   
            $user_bp[] = $row[2];
            $user_bt[] = $row[1];
            $user_pulse[] = $row[3];
            $user_resp[] = $row[4];
            $user_gluc[] = $row[5];
            $user_os[] = $row[6];
            $user_ecg[] = $row[7];
      }
     $output = "<input type='hidden' value='".implode(',',$user_name)."' id='user_name'><input type='hidden' value='".implode(',',$user_bp)."' id='user_bp'><input type='hidden' value='".implode(',',$user_bt)."' id='user_bt'><input type='hidden' value='".implode(',',$user_pulse)."' id='user_pulse'><input type='hidden' value='".implode(',',$user_resp)."' id='user_resp'><input type='hidden' value='".implode(',',$user_gluc)."' id='user_gluc'><input type='hidden' value='".implode(',',$user_os)."' id='user_os'><input type='hidden' value='".implode(',',$user_ecg)."' id='user_ecg'>"; 
echo $output;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard">
    <meta name="description"
        content="Admin ">
    <meta name="robots" content="noindex,nofollow">
    <title>Monitoring Health</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" width="30px" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text" style="padding-top: 9px">
                            <!-- dark Logo text --> <h4 style="color:black">Monitoring Health</h4>
                        </span>
                       
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block mr-3" action="dashboard.php" method="post">
                                <input type="text" placeholder="Search..." class="form-control mt-0" name="username">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="logout.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="text-white font-medium">Logout</span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="viewusers.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">View Users</span>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li class="active"><a href="dashboard.php">Refresh</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Employees</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-success"><?php echo $countUsers; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Healthy</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-purple"><?php echo $countHealthy; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Un Healthy</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-info"><?php echo $countUnHealthy; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Health Statictics</h3>
                            <div class="d-md-flex">
                                <ul class="list-inline d-flex ml-auto">
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-success" style="color:springgreen !important"></i>Body Temperature</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-primary" style="color:royalblue !important"></i>Blood Pressure</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-inverse" style="color:darkgrey !important"></i>Pulse</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-info" style="color:deepskyblue !important"></i>Respiration</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-info" style="color:indianred !important"></i>Glucose</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-info" style="color:plum !important"></i>Oxygen Saturation</h5>
                                    </li>
                                    <li class="pl-3">
                                        <h5><i class="fa fa-circle m-r-5 text-info" style="color:pink !important"></i>ElectroCardiogram</h5>
                                    </li>
                                </ul>
                            </div>
                            <div id="ct-visits" style="height: 405px;">
                                <canvas id="employeessChart" style="width:80%;height:80%">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- RECENT SALES -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Employees Details</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">NAME</th>
                                            <th class="border-top-0">MAIL ID</th>
                                            <th class="border-top-0">AGE</th>
                                            <th class="border-top-0">MOBILE NUMBER</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("database/db_connection.php");  
                                            $view_users_query="select * from user_details";//select query for viewing users.  
                                            $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
                                      
                                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                                            {   
                                                $user_id=$row[0];
                                                $user_name=$row[1];
                                                $user_mobile_no=$row[7];  
                                                $user_email=$row[2];  
                                                $user_age=$row[3];
                                      
                                            ?>  
                                      
                                            <tr>  
                                    <!--here showing results in the table -->  
                                                <td class="txt-oflo"><?php echo $user_id;  ?></td>
                                                <td class="txt-oflo"><?php echo $user_name;  ?></td>
                                                <td class="txt-oflo"><?php echo $user_email;  ?></td>
                                                <td class="txt-oflo"><?php echo $user_age;  ?></td>  
                                                <td class="txt-oflo"><?php echo $user_mobile_no;  ?></td>    
                                                 <!--btn btn-danger is a bootstrap button to show danger-->  
                                            </tr>
                                             <?php }   
                                        
                                          ?>
                                    </tbody>
                                    <!--<tbody>
                                        <tr>
                                            <td>7</td>
                                            <td class="txt-oflo">Helping Hands WP Theme</td>
                                            <td>MEMBER</td>
                                            <td class="txt-oflo">April 22, 2017</td>
                                            <td><span class="text-success">$64</span></td>
                                        </tr>
                                    </tbody>-->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> HEALTH MONITORING <a
                    href="dashboard.php">HOME</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>