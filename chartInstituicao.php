<?php
    require_once "autoload.php";
    $control = new Controlador();
    $nomeIns = isset($_POST['nomeIns']) ? $_POST['nomeIns']: "";
    $ins = $control->procurarInstituicaoPorNome($nomeIns);
    $alunos = $control->procurarAlunoPorInstituicao($ins);
    $c = $control->gerarGraficoBarra($alunos, false);
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
        var options = <?= isset($c)?$c->optionsToJs():"[]"?>; 
        div="chartBar";
        <?php 
        if (isset($c)) {
            echo "google.charts.load('current', {callback: function () {
            drawBarChart(array, options, div);},
            packages: ['corechart']});";
		}?>
	</script>
    <title>Instituição Detalhada</title>
</head>
<body style="background-color: lightblue; ">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <?php
                    if ($nomeIns!="0") {
                        echo "<a href=\"http://localhost/projetos/Uri/instituicaoDetalhada.php?nomeIns=".$nomeIns."\"><button class=\"btn btn-primary\">Voltar</button></a>";
                    }
                ?>
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
            <div class="col-md-12 d-flex justify-content-center">
                <div id="chartBar"></div>
            </div>
        </div>
    </div>
</body>
</html>