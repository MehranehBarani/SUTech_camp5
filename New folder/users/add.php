<?php 
require_once '../inc/admin_auth.php';
require_once '...inc.configs.php';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .form{
            padding : 10px 20px;
        }
    </style>
</head>
<body dir='rtl'>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">داشبورد</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">پیشخوان</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">تنظیمات</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            مدیریت کاربران
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">جستوجو</button>
      </form>
    </div>
  </div>
</nav>

<form class="form" method="POST">
  <div class="mb-3">
    <h1>افزودن کاربر جدید</h1>
    <label for="name" class="form-label">نام کاربری</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" require>   

    <label for="email" class="form-label">ایمیل</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" require>
    
  <div class="mb-3">
    <label for="pass" class="form-label">رمزعبور</label>
    <input type="password" class="form-control" name="pass" id="pass" placeholder="رمزعبور" require>
  </div>

  <div class="mb-3">
    <input type="repeted_pass" class="form-control" name="repeted_pass" id="repeted_pass" placeholder="تکرار رمزعبور" require>
  </div>

  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  

    $conn = new mysqli("$db_hostname" , "$db_username" ,"$db_password" ,"$db_database");
// $conn = new mysqli("$db_hostname" , "$db_username" ,"$db_password" ,"$db_database");
    //var_dump($conn);
    if(! $conn)
        echo 'is not connect';
    else{
        echo "okey<br>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          echo 'i\'m here<br>';
          $name = $_POST['name'] ?? '';
          //$name = trim($name);
          $pass = $_POST['pass'] ?? '';
          //$pass = trim($pass);
          $email = $_POST['email'] ?? '';
          //$email = trim($email);
          $repeted_pass = $_POST['repeted_pass'] ?? '';
          //$repeted_pass = trim($repeted_pass);
          var_dump($name); echo '<br><br>';
          var_dump($pass); echo '<br><br>';
          var_dump($repeted_pass); echo '<br><br>';
          var_dump($email); echo '<br><br>';
          if ($email == ''  || $pass == '' || $name == '' || $repeted_pass == ''){
            echo 'هشدار : هیچکدام از دو ورودی نمی توانند خالی باشند' ; }

          else{
            if( $pass == $repeted_pass){
            $sql = "INSERT INTO user (user_name , password , email , role ) VALUES (?,?,?,2)";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param("sss",$name , $pass ,$email  );
            $stmt -> execute();
            echo 'user added';
            }
            else{
              var_dump($pass); echo '<br><br>';
              var_dump($repeted_pass); echo '<br><br>';
                echo "رمز عبور یکسان نیست.";}
          }

        
        }
        else
            echo 'nothing is posting';
    }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>