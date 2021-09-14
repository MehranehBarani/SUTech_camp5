<?php
require_once "inc/configs.php";
if (isset($_SESSION['islogin']) &&  ($_SESSION['islogin'])) {
    echo "redirect";
    header("Location:index.php");}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    <link rel="stylesheet" href="assets/css/style-login.css">
</head>
<body dir="rtl">
    <video muted autoplay loop poster="img/poster.jpeg" class="back-footage">
        <source src="video/footage.mp4" type="video/mp4">
    </video>

    <div class="back-overlay"></div>

    <div class="flex-container">
        <div class="card">
            <div class="header">
                <h1>ورود</h1>
            </div>

            <div class="conten">
                <p>
                    برای ورود به حساب خود ایمیل و رمزعبور خود را وارو کنید.
                </p>
                <form action="" method="POST">

                    <input type="email" name="email" id="email" autofocus placeholder="ایمیل خود را ورود کنید...">
                    <!-- <small name="email-error" class="form-error">نام کاربری وجود ندارد</small> -->

                    <input type="password" name="pass" id="pass" placeholder="رمز خود را ورود کنید...">
                    <!-- <small name="pass-error" class="form-error">رمزعبور وجود ندارد</small> -->

                    <button type="submit" >ورود</button>
                </form>
            </div>

            <?php

 
 if($_SERVER['REQUEST_METHOD'] == 'POST'){

     $pass = $_POST['pass'] ?? '';
     $email = $_POST['email'] ?? '';
     
     
     if ($email == '' && $pass == '' ){
         echo 'هشدار : هیچکدام از دو ورودی نمی توانند خالی باشند' ;
     }
     elseif ($pass == '') {
         echo 'هشدار : رمزعبور نمی تواند خالی باشد';
     }
     elseif ($email == '') {
         echo 'هشدار : ایمیل نمی تواند خالی باشد' ;
     }
     else{

             $conn = new mysqli ("$db_hostname" , "$db_username" ,"$db_password","$db_database");
            
             if(! $conn){
                         echo mysqli_error($conn);
                     }
             else{
                 
                 $stmt = $conn -> prepare( "SELECT id, password FROM users WHERE email=(?)");
                 $stmt -> bind_param("s" , $email);
                 $result = $stmt -> execute();
                 $last_result = $stmt->get_result();
                  $row = $last_result -> fetch_assoc();

                 if(! $result){
                     echo "مشکلی در ارتباط با دیتابیس وجود دارد.";
                 }
                 elseif( $last_result ->num_rows == 0){
                     echo "نام کاربری وجود ندارد";
                 }
                 elseif($row['password'] == md5($pass)){
                     session_start();
                     $_SESSION['islogin'] = true;
                     $_SESSION['id'] = $row['id'] ;
                     header("Location:index.php");
                      die();
                 }
                 else
                     echo 'رمزعبور با ایمیل مطابقت ندارد.';

                 $stmt->close();
                 $conn->close();

             }   
     }
     }  

?>


            <div class="footer">
                <p>
                    حساب ندارید؟<a href="register.php">ثبت نام کنید</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>