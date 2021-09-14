<?php
if(!isset($_GET['task_id'])){
    header("Location:index.php");
}
else{
    require_once 'inc/configs.php';
    $task_id = $_GET['task_id'];
    $conn = new mysqli ("$db_hostname" , "$db_username" ,"$db_password","$db_database");
    if(!$conn){
        echo 'promlem is connection<br><br>';
    }
    else{
        $stmt =$conn ->prepare("DELETE FROM tasks WHERE task_id = ? ") ;
        $stmt -> bind_param("s" , $task_id);
        $stmt-> execute();
  
        if($stmt->affected_rows==0){
            echo 'there is nothing to delete';
        //    header("Location :index.php");
        }
        else{
            echo 'deleted';
        //    header("Location :index.php");
       }
    
    }
    

}