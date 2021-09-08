<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body dir="rtl">
    <video muted autoplay loop poster="picture/poster.jpeg" class="back-footage">
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
                <form action="C:/Users/ALL DIGITAL/Desktop/SUTech_camp5/day7/mini-project.html" method="POST">

                    <input type="email" name="name" id="name" autofocus placeholder="ایمیل خود را ورود کنید...">
                    <small name="email-error" class="form-error">نام کاربری وجود ندارد</small>

                    <input type="password" name="pass" id="pass" placeholder="رمز خود را ورود کنید...">
                    <small name="pass-error" class="form-error">رمزعبور وجود ندارد</small>

                    <button type="submit">ثبت نام کنید</button>
                </form>
            </div>

            <?php
          

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';

                
                if ($email == '' ){
                    echo $_POST['emial-error'];
                }
                elseif ($pass == '') {
                    echo $_POST['pass-error'];
                }
                else{

                      $conn = mysqli_connect("localhost","root","","");
                      $sql = "CREATE DATABASE mini_project";
                      mysqli_selsect_db($conn , "mini_project");
                      $conn = mysqli_connect("localhost","root","","mini_project");
                      $res = mysqli_query( $conn , $sql);
                    
                      if(! $res){
                          echo mysqli_error($conn);
                      }
                     else {
                         $userPass = "SELECT Password FROM users WHERE email="$email"" ;
                         if($userPass == $pass){
                             echo "کاربر با موفقیت وارد شد."
                         }
                         else{
                             echo "رمز ورود اشتباه است."
                         }
                     }

                     }
             }
                
            ?>

            <div class="footer">
                <p>
                    حساب ندارید؟<a href="#">ثبت نام کنید</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>