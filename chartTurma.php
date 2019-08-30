<?php
    require_once "autoload.php";
    $control = new Controlador();
    $nomeTurma = isset($_POST['nomeTurma']) ? $_POST['nomeTurma']: "";
    $turma = $control->procurarTurmaPorNome($nomeTurma);
    $c = $control->gerarGraficoBarra($turma->getAlunos(), false);
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
        div1="chartPie";
        <?php 
        if (isset($c)) {
            echo "google.charts.load('current', {callback: function () {
            drawBarChart(array, options, div);},
            packages: ['corechart']});";
		}?>
	</script>
    <title>Turma Detalhada</title>
</head>
<body style="background-color: lightblue; ">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <?php
                    if ($nomeTurma!="0") {
                        echo "<a href=\"http://localhost/projetos/Uri/turmaDetalhada.php?nomeTurma=".$nomeTurma."\"><button class=\"btn btn-primary\">Voltar</button></a>";
                    }
                ?>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <h3 class="">
                <?php
                    echo "Nome: ".$turma->getNome();
                ?>
                </h3>
            </div>
            <div class="col-md-6">
                <h3>
                <?php
                    echo "Score: ".$turma->calculaScore();
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