<?php  

    include"phfiles/dbconn.php";

    $id = $_GET['ID'];

    $delete_query = "delete from projects where ID='$id' ";

    $exec_query = mysqli_query($connection,$delete_query);
    
    if($exec_query){
        header("Location:projects.php");
    }
?>