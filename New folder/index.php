<?php
require_once "inc/configs.php";
session_start();
if(!isset($_SESSION['islogin']) || ($_SESSION['islogin']) == false)
    header("Location:login.php");
    ?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تودو!</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawsome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style-index.css">

</head>

<?php

    $conn = new mysqli("$db_hostname" , "$db_username" ,"$db_password","$db_database");
    echo 'sessioin' ;var_dump($_SESSION['id']); echo '<br><br>';
    $id = $_SESSION['id'];
    $sql2 = "SELECT user_name From users WHERE id = $id ";
    $result2 = $conn -> query($sql2);
    $row2 = $result2 -> fetch_assoc();
    $_SESSION['name'] = $row2['user_name']; 
?>

<body dir="rtl">
    <div class="page-container">
        <div class="flex-container">
            <header>
                <div class="header-info">
                    <h1>تودو!</h1>
                    <div class="user-info"><?=$_SESSION['name']?>خوش آمدید </div>
                </div>
                <a href="login.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </header>

            <form action="" method="POST">
                <div class="input-wrapper">
                    <input type="text" name="todo" id="todo" placeholder="یک کار جدید اضافه کن ;)" class="new-todo">
                </div>
                <button type="submit" class="add-todo">
                    <i class="fas fa-plus"></i>
                </button>
            </form>

 <?php 
        
        
        $sql = "SELECT task , task_id FROM tasks";
        $result = $conn -> query($sql);

        if($result -> num_rows == 0 ){
            echo "there is nothing to show";
        }
        else{
            $counter = 1;
            ?>

            <div class="todo-list-container">
                <ul class="list">

            <?php
               
               while($row = $result->fetch_assoc() ){
                $task_id = $row['task_id'];
                $task = $row['task'];

            ?>

                <li class="todo-item">
                <div class="desc">
                    <?= $task ?>  
                </div>
                <div class="options">
                    <!-- <div class="todo-btn">
                        <a  href="delet.php?task_id= < ?= $row['task_id'] ?>">
                            <i class="far fa-trash-alt"></i>  
                        </a>
                    </div> -->
                    <!-- < ?php echo 'task_id befor delete: ' ; var_dump($task_id); echo '<br><br>';?> -->
                    
                    <a href="delete.php?task_id=<?=$task_id?>">delete</a>
                    <!-- <div class="todo-btn">
                        <a  href="edit.php?task_id= < ?= $row['task_id'] ?>">
                            <i class="far fa-edit"></i>  
                        </a>
                    </div> -->

                    <a href="edit.php?task_id=<?=$task_id?>">edit</a>

                    <button class="todo-btn">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </li>
            
            <?php
            $counter++;
            }//end while
        }//end else

            ?>
                  
                           
                </ul>
            </div>

        </div>
    </div>
<?php

    // if(isset($_POST['todo']) == true){
        $conn = new mysqli("$db_hostname" , "$db_username" ,"$db_password","$db_database");

        if($conn -> connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        else{
            $task = $_POST['todo'] ?? '';;
           if($task == ''){
                echo "nothing to add.";
            }

            else{
                $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
                $sql = "INSERT INTO tasks (task) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $task );
                $res = $stmt->execute();

               if(!$res)
                    echo 'there is a problem in connecting';
                else{
                    echo "new task added<br><br>";
                    $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
                    if(mysqli_connect_errno()){
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    if( $result = mysqli_query($con, "SELECT task , task_id FROM tasks ORDER BY task_id DESC LIMIT 1")){
                        $row = $result->fetch_assoc();
                        $new_task = $row['task'];
                        $new_task_id = $row['task_id'];

                    ?>    

                    <li class="todo-item">
                    <div class="desc">
                    <?= $new_task ?>  
                </div>
                <div class="options">
                    
                    <a href="delete.php?task_id=<?=$new_task_id?>">delete</a>
                    <a href="edit.php?task_id=<?=$new_task_id?>">edit</a>
  
                    <button class="todo-btn">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </li>

        <?php
            header("Location:index.php");  
                    }//end if
                }//end else   
            }//else end
        }//end end
   
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- <script>
        $(document).ready(function(){
            $('.add-todo').click(function(){

                if($('#todo').val() != ''){
                var newitem = '<li class="todo-item animate__animated animate__fadeInDown"><div class="desc">'+ $('#todo').val() +'</div> <div class="options"> <button class="todo-btn"> <i class="far fa-trash-alt delete"></i> </button> <button class="todo-btn"> <i class="far fa-edit"></i> </button> <button class="todo-btn"> <i class="fas fa-times"></i> </button> </div></li>';
                $('ul.list').append(newitem);
                $('#todo').val(''); }
            });
            $('li.delete').click(function(){
                $('li.delete').parent().parent().parent().removeClass('todo-item');
            });
        }); -->
    </script> 
</body>

</html>