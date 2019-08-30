<?php
    require_once "autoload.php";
    $control = new Controlador();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Buscas</title>
</head>
<body style="background-color: lightblue;">
    <div class="container">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-center">
                <a href="http://localhost/projetos/Uri/index.php">
                    <button class="btn btn-primary">Voltar</button>
                </a>
            </div>
            <div class="col-md-7">
                    <h2>Buscas</h2>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" placeholder="Nome" class="form-control col-md-12" name="nomeBusca" id="nomeBusca">
                </div>
                <div class="col-md-3">
                    <input type="text" placeholder="Score Minímo" class="form-control col-md-12" name="nomeBusca" id="nomeBusca">
                </div>
                <div class="col-md-3">
                    <input type="text" placeholder="Score Máximo" class="form-control col-md-12" name="nomeBusca" id="nomeBusca">
                </div>
                <div class="col-md-3">
                    <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>
</html>