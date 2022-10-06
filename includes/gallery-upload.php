<?php
    include_once 'dbh.php';

    if(isset($_POST['submit'])){
        $newFileName = $_POST['filename'];
        if(empty($_POST['filename'])){
           $newFileName = "gallery"; 
        }else{
            $newFileName =strtolower(str_replace(" ","-",$newFileName));
        }
        $imgTitle = $_POST['filetitle'];
        $imgDesc = $_POST['filedesc'];

         $fileName = $_FILES['file']['name'];
         $fileTmpName = $_FILES['file']['tmp_name'];
         $fileSize = $_FILES['file']['size'];
         $fileError = $_FILES['file']['error'];
         $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png');
        if(in_array($fileActualExt, $allowed)){
             if($fileError === 0){
                 if($fileSize < 1000000){
                    $imageFullName =$newFileName. "." .uniqid("",true). "." .$fileActualExt;//give the file a unique name to prevent that file from more upload
                    $fileDestination = '../img/gallery/'.$imageFullName;
                     
                     if(empty($imgTitle) || empty($imgDesc)){
                         header("Location: ../index.php?upload=empty");
                         exit();
                     }else{
                        $sql = "SELECT * FROM gallery;";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                          echo "SQL statement failed!";  
                        }else{
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);
                            $setImageOrder = $rowCount + 1;
                            
                         $sql ="INSERT INTO gallery(titleGallery, descGallery, imgFullNameGallery, orderGallery) values(?, ?, ?, ?);";   
                         if(!mysqli_stmt_prepare($stmt, $sql)){
                           echo "SQL statement failed!";
                        }else{
                             mysqli_stmt_bind_param($stmt, "ssss", $imgTitle, $imgDesc, $imageFullName, $setImageOrder);
                             mysqli_stmt_execute($stmt);
                             move_uploaded_file($fileTmpName, $fileDestination);
                             header("Location: ../index.php?upload=success");
                         }
                        }
                     }
                 }else{
                     echo "You file is too big";
                      exit();
                 }
             }else{
                 echo "There was an error uploading your file";
                  exit();
             }
         }else{
             echo "You cannot upload files of this type";
             exit();
         }
    }