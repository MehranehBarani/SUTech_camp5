<?php
if(!isset($_GET['task_id'])){
  //  echo "i'm here";
    header("Location :index.php"); 
}
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تودو!</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style-index.css">

</head>

<body dir="rtl">
    <div class="page-container">
        <div class="flex-container">
            <header>
                <div class="header-info">
                    <h1>تودو!</h1>
                    <div class="user-info"> خوش آمدید </div>
                </div>
                <a href="login.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </header>

            <form action="" method="POST">
                <div class="input-wrapper">
                    <input type="text" name="todo" id="todo" placeholder="ویرایش کن! " class="new-todo">
                </div>
                <button type="sumbit" class="add-todo">
                    <i class="fas fa-plus"></i>
                </button>
            </form>

<?php

    require_once 'inc/configs.php';    
    $task_id = $_GET['task_id'];
    $conn = new mysqli ("$db_hostname" , "$db_username" ,"$db_password","$db_database");

    if($conn){

           if(isset($_POST['todo']) && $_POST['todo'] != ''){
                $new_task = $_POST['todo'] ?? '';
                $task_id = $_GET['task_id'];

                $stmt = $conn -> prepare("UPDATE tasks SET task=? WHERE task_id =? ");
                $stmt -> bind_param("ss" , $task , $task_id );
                $stmt->execute();

                if($stmt->affected_rows == 0){
                    echo 'nothind was edited';
               //     header("Location :index.php");
                } 
                else{
                    echo 'your task is changed';
               //     header("Location :index.php");
                }
            }
            
            else{
                echo 'nothing was posted';
            }
                
    }
       else{
          echo 'there is a problem in connection';
    //     header("Location : index.php"); 
     }
    
    
?>
        
</body>

</html>