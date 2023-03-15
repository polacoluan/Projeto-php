<?php 
require_once("config.php");

// ========================================================
// Diretório
// $name = "images";

// if(!is_dir($name)){
    // Criar o diretório
    // mkdir($name);

    // echo "Diretório criado com sucesso";
// }else{
    // Remover diretório
    // rmdir($name);

    // echo "Já existe o diretório: $name";
// }

// ========================================================
// Arquivos

// $images = scandir("images");
// $data = array();

// foreach($images AS $key => $value){

//     if(!in_array($value, array(".",".."))){
//         $filename = "images/".$value;

//         $info = pathinfo($filename);

//         $info["size"] = filesize($filename);
//         $info["data_modificacao"] = date("Y-m-d H:i", fileatime($filename));
//         $info["url"] = "http://localhost/OO/".$filename;
        
//         array_push($data, $info);
//     }
// }

// echo json_encode($data);

// ========================================================
// Criando Arquivos

// $file = fopen("log.txt", "a+");

// fwrite($file, date("Y-m-d H:i:s"). "\r\n");

// fclose($file);

// echo "Arquivo criado com sucesso!";

// ========================================================
// Criando Arquivos

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM projeto.tb_usuarios");

$headers = array();

foreach ($usuarios[0] as $key => $value) {
    
    array_push($headers, $key);
}

$file = fopen("usuarios.csv", "w+");

fwrite($file, implode(",", $headers) . "\r\n");

foreach ($usuarios as $row) {
    
    $data = array();
    foreach ($row as $key => $value) {
        
        array_push($data, $value);
    }

    fwrite($file, implode(",", $data) . "\r\n");
}

fclose($file);

// unlink("usuarios.csv");

// ========================================================
// Lendo Arquivos

$filename = "usuarios.csv";

$arquivo = fopen($filename, "r");

$cabecalho = explode(",",fgets($arquivo));

unset($row);
$data = array();
while($row = fgets($arquivo)){

    $rowData = explode(",",$row);

    for($i = 0; $i < count($cabecalho); $i++){

        $linha[$headers[$i]] = $rowData[$i];
    }

    array_push($data, $linha);
}
fclose($arquivo);
echo "<pre>";
echo json_encode($data);

?>