<?php
    require_once "autoload.php";
    $control = new Controlador();
    $ex = new Extrator();
    
    $nomeTurma = isset($_POST['select-turma']) ? $_POST['select-turma']: "0";
    $codAluno = isset($_POST['codigo-aluno']) ? $_POST['codigo-aluno']: "";
    $nomeIns = isset($_POST['select-instituicao']) ? $_POST['select-instituicao']: "0";
    $nomeTurmaNova = isset($_POST['nomeTurmaNova']) ? $_POST['nomeTurmaNova']: "";

    if (isset($_POST['salvar-aluno'])) {
        $aluno = $ex->extrair($codAluno);
        if(is_null($control->procurarAlunoPorCodigo($codAluno))){
            $control->inserirAluno($aluno);
        }
        if ($nomeTurma!="") {
            $turma=$control->procurarTurmaPorNome($nomeTurma);
            $flag=true;
            foreach ($control->procurarAlunosPorTurma($turma) as $key => $value) {
                if ($value->getCodigo()==$aluno->getCodigo()) {
                    $flag=false;
                }
            }
            if($flag){
                $turma->addAluno($aluno);
                $control->atualizarTurma($turma);
            }   
        }
     }
    if ((isset($_POST['criar-turma']))&&($nomeTurmaNova != "")) {
        if (is_null($control->procurarTurmaPorNome($nomeTurmaNova))) {
            $turmaNova = new Turma();
            $turmaNova->setNome($nomeTurmaNova);
            $control->inserirTurma($turmaNova);
        }
     }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Página Inicial</title>
 </head>
<body style="background-color: lightblue;">
    <div class="container">
        <div class="row">
            <div class="col-md-4" align="center">
                <h2>Turmas</h2>    
             </div>
            <div class="col-md-4" align="center">
                <h2>Selecionar Aluno</h2>
             </div>
            <div class="col-md-4" align="center">
                <h2>Instituições</h2>
             </div>
         </div>
        <form method="post">
            <div class="row">
                <div class="form-group col-md-4 d-flex justify-content-center">
                    <input type="text" placeholder="Nome da Turma" class="form-control col-md-7" name="nomeTurmaNova" id="nomeTurmaNova">
                    <input type="submit" value="Adicionar" class="btn btn-primary" name = "criar-turma" id="criar-turma">
                 </div>
                <div class="form-group col-md-4 d-flex justify-content-center">
                    <input type="text" placeholder="Código do Aluno" class="form-control col-md-7" name="codigo-aluno" id="codigo-aluno"
                    value="<?= $codAluno?>">
                    <?php
                        if ($codAluno!="0") {
                            echo "<input type=\"hidden\" value=\"".$codAluno."\" name=\"codigoAluno\">";
                        }
                     ?>
                    <input type="submit" value="Enviar" class="btn btn-primary" name="botao-aluno"> 
                 </div>
                <div class="form-group col-md-4" align="center">
                    <?php
                        $instituicoes = $control->listarInstituicoes();
                        include_once "Componentes/selectInstituicao.php"; 
                        if ($nomeIns!="") {
                            echo "<input type=\"hidden\" value=\"".$nomeIns."\" name=\"nomeInst\">";
                        }
                     ?>
                    <input type="submit" value="Listar" class="btn btn-primary" name = "botao-ins" id="botao-ins">
                 </div>
             </div>
            <div class="row">
                <div class="form-group col-md-4" align="center">
                    <?php  
                        $turmas = $control->listarTurmas();
                        if (!empty($turmas)) { 
                            include_once "Componentes/selectTurma.php"; 
                            if ($nomeTurma!="") {
                                echo "<input type=\"hidden\" value=\"".$nomeTurma."\" name=\"nomeTurma\">
                                <input type=\"submit\" value=\"Listar\" class=\"btn btn-primary\" name = \"botao-turma\" id=\"botao-turma\">";
                            }
                        }
                     ?>
                 </div>
             </div>
         </form>
        <div class="row">
            <div class="col-md-4">
                <?php  
                    if(((isset($_POST['botao-turma']))&&($nomeTurma!="0"))||($nomeTurma!="0")){
                        $turma = $control->procurarTurmaPorNome($nomeTurma);
                        $alunos = $control->procurarAlunosPorTurma($turma);
                        include_once "Componentes/infoTurma.php"; 
                    }
                 ?>
             </div>
            <div class="col-md-4">
                <?php  
                    if(((isset($_POST['botao-aluno']))&&($codAluno!=""))||($codAluno!="")){
                        $aluno = $ex->extrair($codAluno);
                        if (!is_null($aluno)) {
                            include_once "Componentes/infoAluno.php"; 
                        }
                    }
                 ?>
             </div>
            <div class="col-md-4">
                <?php  
                    if(((isset($_POST['botao-ins']))&&($nomeIns!="0"))||($nomeIns!="0")){
                        $ins = $control->procurarInstituicaoPorNome($nomeIns);
                        $alunos = $control->procurarAlunoPorInstituicao($ins);
                        include_once "Componentes/infoInstituicao.php"; 
                    }
                 ?>
             </div>
         </div>
        <br>
        <div class="row">
            <div class="col-md-4" align="center"> 
                <?php
                    if ($nomeTurma!="0") {
                        echo "<a href=\"http://localhost/projetos/Uri/turmaDetalhada.php?nomeTurma=".$nomeTurma."\"><button class=\"btn btn-success\">Ver Detalhes</button></a>";
                    }
                 ?>
             </div>
            <div class="col-md-4" align="center">
                <?php
                    if (($codAluno!="")&&(!is_null($aluno))) {
                        echo "<form method=\"post\">
                                <input type='hidden' value='".$nomeTurma."' name='select-turma'>
                                <input type='hidden' value='".$nomeIns."' name='select-instituicao'>
                                <input type='hidden' value='".$codAluno."' name='codigo-aluno'>
                                <input type=\"submit\" value=\"Salvar\" class=\"btn btn-success\" name = \"salvar-aluno\" id=\"salvar-aluno\">
                            </form><br>";
                    }
                 ?>
                <a href="http://localhost/projetos/Uri/rankings.php">
                    <button class="btn btn-success">Rankings</button>
                </a>
                <a href="http://localhost/projetos/Uri/pesquisas.php">
                    <button class="btn btn-success">Pesquisas</button>
                </a>
             </div>
            <div class="col-md-4" align="center"> 
                <?php
                    if ($nomeIns!="0") {
                        echo "<a href=\"http://localhost/projetos/Uri/instituicaoDetalhada.php?nomeIns=".$nomeIns."\"><button class=\"btn btn-success\">Ver Detalhes</button></a>";
                    }
                 ?>
             </div>
         </div>
        <br>
     </div>
 </body>
</html>