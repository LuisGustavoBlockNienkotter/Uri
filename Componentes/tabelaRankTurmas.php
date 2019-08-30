<?php
    $tabela="";
    foreach ($turmas as $key => $value) {
        $tabela.="<tr><td>".$value->getNome()."</td><td>".$value->calculaScore()."</td></tr>";
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<table id="tabelaTurma" class="display">
<thead><tr><th>Nome</th><th>Score</th></tr></thead>
    <form method="post" name="Form">
        <input type="hidden" name="codigo" id="codigo">
        <tbody><?= $tabela?></tbody>
    </form>
</table>
<script>
    $(document).ready( function () {
        $('#tabelaTurma').DataTable();
    });
</script>