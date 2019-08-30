<?php
require_once "autoload.php";
$control = new Controlador();
$nomePesquisa = isset($_POST["nome"]) ? $_POST["nome"] : "";
$scoreI = isset($_POST["scoreI"]) ? $_POST["scoreI"] : 0;
$scoreF = isset($_POST["scoreF"]) ? $_POST["scoreF"] : 0;
if ($scoreI > $scoreF) {
    $aux = $scoreF;
    $scoreF = $scoreI;
    $scoreI = $aux;
}
$pesquisaNome = array();
if (strcmp($nomePesquisa, "")) {
    $pesquisaNome = $control->procurarAlunoPorNomeUsandoLike($nomePesquisa);
}
$pesquisaRange = array();
if ($scoreF > 0) {
    if(isset($_POST['scoreI'])){
        $pesquisaRange = $control->procurarAlunoPorScoreNoIntervalo($scoreI, $scoreF);
    }else{
        $pesquisaRange = $control->procurarAlunoPorScoreNoIntervalo(0, $scoreF);
    }
    
}
$alunos = array();
if (sizeof($pesquisaNome) > 0 || sizeof($pesquisaRange) > 0) {
    foreach ($pesquisaNome as $key => $value) {
        foreach ($pesquisaRange as $key => $value2) {
            if ($value->getCodigo() == $value2->getCodigo()) {
                array_push($alunos, $value);
            }
        }
    }
}
if(sizeof($pesquisaNome) == 0 ){
    $alunos = $pesquisaRange;
}
if(sizeof($pesquisaRange) == 0 ){
    $alunos = $pesquisaNome;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Pesquisas</title>
</head>
<body style="background-color: lightblue;">
    <div class="container">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-start">
                <a href="index.php">
                    <button class="btn btn-primary">Voltar</button>
                </a>
            </div>
            <div class="col-md-7 d-flex justify-content-start">
                <h1>Pesquisas</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" align="center">
                <h3>Nome</h3>    
            </div>
            <div class="col-md-3" align="center">
                <h3>Score início</h3>
            </div>
            <div class="col-md-3" align="center">
                <h3>Score fim</h3>
            </div>
        </div>
        <form method="post">
            <div class="row">
                <div class="form-group col-md-3 d-flex justify-content-center">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome da pessoa" value="<?=$nomePesquisa?>">
                </div>
                <div class="form-group col-md-3 d-flex justify-content-center">
                    <input type="number" name="scoreI" id="scoreI" step="0.01" class="form-control" placeholder="0,00" value="<?=$scoreI?>">
                </div>
                <div class="form-group col-md-3 d-flex justify-content-center">
                    <input type="number" name="scoreF" id="scoreF" step="0.01" class="form-control" placeholder="0,00" value="<?=$scoreF?>">
                </div>
                <div class="col-md-3">
                    <input type="submit" value="Pesquisar" class="btn btn-primary col-md-12">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <?php
                    include_once "Componentes/pesquisa.php";
                ?>
            </div>
        </div>
    </div>
</body>
</html>