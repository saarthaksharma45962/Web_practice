<?php 

include"dbconn.php";
  
  $id = $_GET['ID'];
  $file_to_deleted = $_GET['file'];
  $file_size_delete = $_GET['filesize'];
 
  $query = "select Attachments,Attachment_sizes from projects where ID='$id' ";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
    print_r($row);

    $update_files = str_replace($file_to_deleted,"",$row['Attachments']);
    $update_sizes = str_replace($file_size_delete,"",$row['Attachment_sizes']);

    $update_query = "update projects set Attachments = '$update_files' , Attachment_sizes = '$update_sizes' where ID='$id'";
    $exec_update_query  = mysqli_query($connection,$update_query);  
    if($exec_update_query){ 
      $path = "attachments/".$file_to_deleted;
      
      if(unlink($path)){

        header("Location:../project-edit.php?ID=".$id);
        
        }
     
      ;}

?>