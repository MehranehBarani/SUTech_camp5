<?php
require_once "<inc/configs.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="assets/css/style-register.css">
</head>
<body dir="rtl">
    <video muted autoplay loop poster="img/poster.jpeg" class="back-footage">
        <source src="video/footage.mp4" type="video/mp4">
    </video>

    <div class="back-overlay"></div>

    <div class="flex-container">
        <div class="card">
            <div class="header">
                <h1>ثبت نام</h1>
            </div>

            <div class="conten">
                <p>
                    برای ایجاد یک حساب کاربری اطلاعات زیر را وارد نمایید.
                </p>
                <form action="" method="POST">

                    <div class="wrapper">
                        

                    <?php
                        echo 'befor resqusr method<br><br>';
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            echo 'after resqusr method<br><br>';
                        $pass = $_POST['pass'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $user_name = $_POST['username'];
                        $repeted_pass = $_POST['repetedpass'];

                        if ($email == '' || $pass == ''|| $user_name = '' || $repeted_pass == '' ){
                            echo 'هشدار : هیچکدام از ورودی ها نمی توانند خالی باشند' ;
                        }
                        else{
                            echo 'try to connect<br><br>'; $conn = new mysqli ("$db_hostname" , "$db_username" ,"$db_password","$db_database");
                       
                            if(! $conn)
                                        echo mysqli_error($conn);
                                    
                            else {
                                echo 'connected<br><br>';
                                    if($repeted_pass == $pass){
                                        
                                        $stmt = $conn->prepare("INSERT INTO users ( user_name , password ,email , role) VALUES (  ? , ? , ? , 2)");
                                        $passw = md5($pass);
                                        var_dump($passw); echo '<br><br>';
                                        $stmt -> bind_param("sss" , $user_name , $passw , $emial);
                                        $result = $stmt ->execute();
                                        var_dump($stmt->affected_rows); echo '<br><br>';
                                        var_dump($result); echo '<br><br>';
                                        if($stmt->affected_rows > 0){
                                        echo 'added';
                                        // header("Location:login.php");
                                        
                                    }
                                    
                                    }
                                    else{
                                        var_dump($pass); echo '<br><br>';
                                        var_dump($repeted_pass); echo '<br><br>';
                                        echo 'pass in no equles';
                                    }
                                   
                                
                            }
                        }
                        }
                    ?>

                        <div class="grid1"><input autofocus type="text" name="username" id="" placeholder="نام و نام خانوادگی"></div> 

                        <div class="grid3">
                            <input type="email" name="email" id="" placeholder="ایمیل">
                            <!-- <small class="form-error">این ایمیل قبلا ثبت شده است.</small> -->
                        </div>

                        <div class="grid2">
                            <input type="password" name="pass" id="" placeholder="رمزعبور">
                            <!-- <small class="form-error">رمزعبور با تکرارآن مطابقت ندارد</small> -->
                        </div> 
                        
                        <div class="grid4"><input type="password" name="repetedpass" id="" placeholder="تکرار رمز عبور"></div>   

                        
                    </div>
                        <button type="submit">ثبت نام کنید</button>
                </form> 
                    
            </div>
                
                <div class="footer">
                <p>
                     حساب دارید؟<a href="login.php">وارد شوید!</a>
                </p>
            
        </div>
    </div>

</body>
</html>