<form method="post" enctype="multipart/form-data">
    <input type="file" name="file"/>
    <button type="submmit">Send</button>
</form>

<?php 

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $file = $_FILES["file"];

    if($file["error"]){

        throw new Exception("Error: ".$file["error"]);
    }

    $dirUploads = "uploads";

    if(!is_dir($dirUploads)){

        mkdir($dirUploads);
    }

    if(move_uploaded_file($file["tmp_name"], $dirUploads."/".$file["name"])){

        echo "Upload realizado com sucesso";
    }else{

        throw new Exception("Não foi possível realizar o upload");
    }
    
}