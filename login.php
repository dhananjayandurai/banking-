<?php  
session_start();//session starts here  
  
?>  
  
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <link type="text/css" rel="stylesheet" href="bootstrap\dist\css\bootstrap.min.css">  
    <title>Login</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  
  
<body style="color: black";>  
  
<div class="container" >  
    <div class="row" >  
        <div class="col-md-4 col-md-offset-4" style="margin: 0 auto">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Sign In</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="login.php">  
                        <fieldset>  
                            <div class="form-group"  >  
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">  
                            </div>
  
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" style="background-color: black;">  
  
                            <!-- Change this to a button or input when using this as a form -->  
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->  
                        </fieldset>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
</body>  
  
</html>  
  
<?php  
  
include("database/db_connection.php");  
  
if(isset($_POST['login']))  
{  
    $user_email=$_POST['email'];  
    $user_pass=$_POST['pass'];  
  
    $check_user="select is_admin from user_details WHERE email_id='$user_email' AND password='$user_pass'";  
  
    $run=mysqli_query($dbcon,$check_user);  
  
    if(mysqli_num_rows($run))  
    {  
        if(mysqli_fetch_array($run)[0] == 0){
            echo "<script>alert('You dont have access!')</script>";  
        }else{
            echo "<script>window.open('welcome.php','_self')</script>";  
            $_SESSION['email']=$user_email;//here session is used and value of $user_email store in $_SESSION. 
        } 
    }  
    else  
    {  
      echo "<script>alert('Email or password is incorrect!')</script>";  
    }  
}  
?>