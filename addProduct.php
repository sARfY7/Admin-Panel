<?php
    session_start();
    require("isAuth.php");
?>
<?php
    require("dbConnection.php");
    // require("isAuth.php");

    $prod_name = $_POST["product_name"];
    $prod_price = $_POST["product_price"];
    $prod_desc = $_POST["product_description"];
    $prod_cat_id = $_POST["product_category"];

    if (empty($prod_name) || empty($prod_price) || empty($prod_cat_id)) {
        die("Please Fill All the Fields");
    }

    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'JPEG', 'PNG', 'GIF');
    $fileNames = array();

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['product_image']['name']))) {
        foreach($_FILES['product_image']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['product_image']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["product_image"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    array_push($fileNames, $fileName);
                    $insertValuesSQL = 1;
                }else{
                    $errorUpload .= $_FILES['product_image']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['product_image']['name'][$key].', ';
            }
        }
        
        if($insertValuesSQL == 1){
            // Insert Product into database
            $add_product_stmt = $pdo->prepare("INSERT INTO products(category, name, price, description) VALUES(?, ?, ?, ?)");
            $product_added = $add_product_stmt->execute([$prod_cat_id, $prod_name, $prod_price, $prod_desc]);
            $last_insert_id = "";
            if ($product_added) {
                $last_insert_id = $pdo->lastInsertId();
                foreach ($fileNames as $index => $value) {
                    // Insert image file name into database
                    $insert_images_stmt = $pdo->prepare("INSERT INTO images (product_id, image_name) VALUES (?, ?)");
                    $images_uploaded = $insert_images_stmt->execute([$last_insert_id, $value]);
                    if($images_uploaded){
                        $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                        $statusMsg = "Files are uploaded successfully.".$errorMsg;
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                die("Error Encountered while Adding Product!");
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;
    
?>