<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <link type="text/css" rel="stylesheet" href="bootstrap\dist\css\bootstrap.min.css">  
    <title>Registration</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
  
</style>  
<body background="#313131">  
  
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->  
    <div class="row"><!-- row class is used for grid system in Bootstrap-->  
        <div class="col-md-4 col-md-offset-4" style="margin: 0 auto"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading" >
                <form>  
                    <h3 class="panel-title">Registration</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="registration.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Username" name="name" type="text" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Mobile Number" name="mobile_no" type="Number" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="E-mail" name="email_id" type="email" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Age" name="age" type="age" autofocus>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Admin" name="admin" type="Number" autofocus>  
                            </div>  
  
  
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Add User" name="register" style="background-color: black;">  
  
                        </fieldset>  
                    </form>   
                </form>
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
  
</body>  
  
</html>  
  
<?php  
  
include("database/db_connection.php");//make connection here  
if(isset($_POST['register']))  
{  
    $user_name=$_POST['name'];//here getting result from the post array after submitting the form.  
    $user_mobile_no=$_POST['mobile_no'];//same  
    $user_email=$_POST['email_id'];//same  
    $user_age=$_POST['age'];//same 
    $user_pass=$_POST['pass'];//same 
    $user_admin=$_POST['admin'];//same  
  
  
    if($user_name=='')  
    {  
        //javascript use for input checking  
        "<script>alert('Please enter the name')</script>";  
exit();//this use if first is not work then other will not show  
    }  
    if($user_mobile_no=='')  
    {  
        echo"<script>alert('Please enter the Mobile Number')</script>";
        exit();
     }
     if($user_email=='')  
    {  
        echo"<script>alert('Please enter the email')</script>";  
    exit();  
    }
  
    if($user_pass=='')  
    {  
        echo"<script>alert('Please enter the password')</script>";  
exit();  
    }  
  
      
//here query check weather if user already registered so can't register again.  
    $check_email_query="select * from user_details WHERE email_id='$user_email'";  
    $run_query=mysqli_query($dbcon,$check_email_query);  

    if(mysqli_num_rows($run_query)>0)  
    {  
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";  
exit();  
    }  
//insert the user into the database. 
    $insert_user="insert into user_details (user_name,mobile_no,email_id,age,password,is_admin) VALUE ('$user_name','$user_mobile_no','$user_email','$user_age','$user_pass','$user_admin')";  
    if(mysqli_query($dbcon,$insert_user))  
    {  
        echo"<script>window.open('view_users.php','_self')</script>";  
    }  
} 
?>  