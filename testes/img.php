<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Imagens</title>
</head>
<body>
    <h1>Add imagens bd</h1>
    <div class="row">
        <div class="col-md-4">
            <form action="./img.php" method="post" enctype="multipart/form-data">
                <label>Selecione a imagem</label>
                <input type="file" name="imagem" accept="image/*" class="form-control">
                <button type="submit" class="btn btn-success">Enviar imagens</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php 
if( isset($_FILES["imagem"]) && !empty($_FILES["imagem"])){
    move_uploaded_file( $_FILES["imagem"]["tmp_name"], "./img/".$_FILES["imagem"]["name"] );
    print ('update realizado');
}
else {
    print('não ta indo');
}
?>