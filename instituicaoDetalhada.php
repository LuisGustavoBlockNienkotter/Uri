<?php
    require_once "autoload.php";
    $control = new Controlador();
    $nomeIns = isset($_GET['nomeIns']) ? $_GET['nomeIns']: "";
    $ins = $control->procurarInstituicaoPorNome($nomeIns);
    $alunos = $control->procurarAlunoPorInstituicao($ins);
    $c = $control->gerarGraficoBarra($alunos, true);
    $c1 = $control->gerarGraficoPizza($alunos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="javascript/charts.js"></script>
    <script>
        var array=<?= isset($c)?$c->arrayToJs():"[]"?>;
        var array1=<?= isset($c1)?$c1->arrayToJs():"[]"?>;
        var options = <?= isset($c)?$c->optionsToJs():"[]"?>; 
        var options1 = <?= isset($c1)?$c1->optionsToJs():"[]"?>; 
        div="chartBar";
        div1="chartPie";
        <?php 
        if (isset($c)) {
            echo "google.charts.load('current', {callback: function () {
            drawBarChart(array, options, div),
            drawPieChart(array1, options1, div1);},
            packages: ['corechart']});";
		}?>
	</script>
    <title>Instituição Detalhada</title>
</head>
<body style="background-color: lightblue; ">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <a href="index.php">
                    <button class="btn btn-primary">Voltar</button>
                </a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <h3 class="">
                <?php
                    echo "Nome: ".$ins->getNome();
                ?>
                </h3>
            </div>
            <div class="col-md-6">
                <h3>
                <?php
                    echo "Score: ".$control->calculaScoreInstituicao($ins);
                ?> 
                </h3>      
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-end">
                <div id="chartBar"></div>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
                <div id="chartPie"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="chartInstituicao.php" method="post">
                    <input type="hidden" name="nomeIns" id="nomeIns" value="<?=$nomeIns?>">
                    <input type="submit" value="Mostrar todos" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <?php  
                    include_once "Componentes/infoInstituicaoDetalhada.php"; 
                ?>
            </div>
        </div>
    </div>
</body>
</html>