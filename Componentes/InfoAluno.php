<div class="card">
    <h5 class="card-header">Aluno</h5>
    <div class="card-body">
        <table>
            <tr><td colspan = 2><?= $aluno->getImagemHtml()?></td></tr>
            <tr><td><b><?= $aluno->getNome()?></b></td></tr>
            <tr><td><b>Rank Geral: </b><?= $aluno->getRankGeral()?></td></tr>
            <tr><td><b>Instituição: </b><?= $aluno->getInstituicao()->getNome()?></td></tr>
            <tr><td><b>Conta criada em: </b><?= $aluno->getDataCadastro()?></td></tr>
            <tr><td><b>Pontuação: </b><?= $aluno->getScore()?></td></tr>
            <tr><td><b>Resolvidos: </b><?= $aluno->getResolvidos()?></td></tr>
            <tr><td><b>Tentados: </b><?= $aluno->getTentados()?></td></tr>
            <tr><td><b>Submetidos: </b><?= $aluno->getSubmetidos()?></td></tr>
        </table>
    </div>
</div>