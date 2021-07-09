<!DOCTYPE html>
<html lang="en">
<head>
          
<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

    <body>
    <div class="container mt-5">
        <div class="display-4 m-4">
            <form method="POST" action='' enctype='multipart/form-data'>
                <p class="text-dark text-center">
                    Upload files to the Server 
                    <input type="file" class="form-control file_input mt-4" id="inputFile" name="inputFile[]" multiple>
                </p>
                <input type="submit" class="btn btn-dark d-block" id="submit" name="submit" value="Upload">
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 -->
    <script src="../../plugins/bootstrap5/js/bootstrap.bundle.min.js"></script>
    </body>

</html>




<?php  

    include"dbconn.php";

    
    if(isset($_POST['submit']) && isset($_FILES['inputFile'])){
        $id = $_GET['ID'];
#----fetch existing attachments and their sizes
        $fetch_query = "select Attachments, Attachment_sizes from projects where ID='$id'";
        $fetch_fire = mysqli_query($connection,$fetch_query);
        $result = mysqli_fetch_assoc($fetch_fire);
#---creating variables for accessing information of new files      
        $filename = "";
        $file_tmp = "";  #------temporary location---------
        $file_size = "";
        $file_location = "attachments/";
        $data = $result['Attachments'];
        $data_sizes = $result['Attachment_sizes'];
      
        #-------------------------moving all the uploaded files from temporary location to their destination------------          
        foreach($_FILES['inputFile']['name'] as $key => $value){
          $filename = $_FILES['inputFile']['name'][$key];
          $file_tmp = $_FILES['inputFile']['tmp_name'][$key];
          $file_size = $_FILES['inputFile']['size'][$key];
          move_uploaded_file($file_tmp,$file_location.$filename);
          $data .=$filename." ";
          $data_sizes.=$file_size." ";   
         # echo $data_sizes;----- used for debugging whether sizes were concatenated properly or not 
         }

         $query_update = "update projects set Attachments='$data' ,Attachment_sizes = '$data_sizes'";
         $update_exec = mysqli_query($connection,$query_update);

         if($update_exec){
             ?>
            <script>  alert("Data saved successfully"); </script>
        <?php

            header("Location:../project-edit.php?ID=".$id);
          
         }
    }

?>








