<?php
    $tabela="";
    if (!empty($turma->getAlunos())) {
        $control = new Controlador();
        $arr=$control->ordenarDecrescenteScore($turma->getAlunos());
        $num=1;
        foreach ($arr as $aluno) {
            $tabela.="<tr><td>".$num."</td>".
            "<td>".$aluno->getNome()."</td><td>".$aluno->getScore().
            "</td><td>".$aluno->getRankGeral()."</td><td>".$aluno->getDataCadastro().
            "</td><td>".$aluno->getResolvidos()."</td><td>".$aluno->getTentados().
            "</td><td>".$aluno->getSubmetidos()."</td>".
            "<td><button class='btn btn-danger' onclick='codigo.value=\"".$aluno->getCodigo()."\"; return remove();'>Excluir</button></td></tr>";
            $num++;
        }
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<table id="tabelaTurma" class="display">
<thead><tr><th>Colocação</th><th>Nome</th><th>Score</th><th>Rank Geral</th><th>Data</th><th>Resolvidos</th><th>Tentados</th><th>Submetidos</th><th>Deletar</th></tr></thead>
    <form method="post" name="Form">
        <input type="hidden" name="codigo" id="codigo">
        <tbody><?= $tabela?></tbody>
    </form>
</table>
<script>
    function remove(){
        document.Form.submit();
        return true;
    }
    $(document).ready( function () {
        $('#tabelaTurma').DataTable();
    } );
</script>