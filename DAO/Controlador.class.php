<?php
require_once "autoload.php";
class Controlador{
    private $instituicao;
    private $alunos;
    private $turmas;
    private $turmas_has_alunos;
    private $graficos;

    public function __construct() {
        $this->instituicao = new InstituicaoDAO();
        $this->alunos = new AlunoDAO();
        $this->turmas = new TurmaDAO();
        $this->turmas_has_alunos = new Turma_has_AlunoDAO();
        $this->graficos = new chartDao();
    }

    public function calculaScoreInstituicao($ins)
    {
        $alunos = $this->procurarAlunoPorInstituicao($ins);
        $score = 0;
        foreach ($alunos as $key => $value) {
            $score += $value->getScore();
        }
        if ($score != 0) {
            $score = $score/sizeof($alunos);
        }
        return $score;
    }
    public function gerarGraficoPizza($arr)
    {
        return $this->graficos->graficoPizza($arr);
    }
    public function gerarGraficoBarra($arr, $top10)
    {
        return $this->graficos->graficoBarra($arr, $top10);
    }
    public function inserirInstituicao($ins)
    {
        $this->instituicao->inserir($ins);
    }
    public function listarInstituicoes()
    {
        return $this->instituicao->selectAll();
    }
    public function procurarInstituicaoPorCodigo($codigo)
    {
        return $this->instituicao->selectById($codigo);
    }
    public function procurarInstituicaoPorNome($nome)
    {
        return $this->instituicao->selectByNome($nome);
    }
    public function deletarInstituicao($inst)
    {
        $this->instituicao->delete($inst);
    }
    public function atualizarInstituicao($inst)
    {
        $this->instituicao->update($inst);
    }
    public function inserirAluno($aluno)
    {
        $this->alunos->inserir($aluno);
    }
    public function atualizarAluno($aluno)
    {
        $this->alunos->update($aluno);
    }
    public function listarAlunos()
    {
        return $this->alunos->selectAll();
    }
    public function procurarAlunoPorCodigo($codigo)
    {
        return $this->alunos->selectById($codigo);
    }
    public function procurarAlunoPorNome($nome)
    {
        return $this->alunos->selectByNome($nome);
    }
    public function procurarAlunoPorNomeUsandoLike($nome)
    {
        return $this->alunos->selectByNomeUsingLike($nome);
    }
    public function procurarAlunoPorInstituicao($ins)
    {
        return $this->alunos->selectByInstituicao($ins);
    }
    public function procurarAlunoPorScoreNoIntervalo($min, $max)
    {
        return $this->alunos->selectByScoreInRange($min, $max);
    }
    public function deletarAluno($aluno)
    {
        $this->alunos->delete($aluno);
    }
    public function inserirTurma($turma)
    {
        $this->turmas->inserir($turma);
    }
    public function listarTurmas()
    {
        return $this->turmas->selectAll();
    }
    public function procurarTurmaPorCodigo($codigo)
    {
        return $this->turmas->selectById($codigo);
    }
    public function procurarTurmaPorNome($nome)
    {
        return $this->turmas->selectByNome($nome);
    }
    public function deletarTurma($turma)
    {
        $this->turmas->delete($turma);
    }
    public function atualizarTurma($turma)
    {
        $this->turmas->update($turma);
    }
    public function inserirTurmaHasAluno($turma)
    {
        $this->turmas_has_alunos->inserir($turma);
    }
    public function procurarAlunosPorTurma($turma)
    {
        return $this->turmas_has_alunos->selectByTurma($turma);
    }
    public function deletarTurmaHasAlunoPorTurma($turma)
    {
        $this->turmas_has_alunos->deleteByTurma($turma);
    }
    public function deletarTurmaHasAlunoPorAluno($aluno)
    {
        $this->turmas_has_alunos->deleteByAluno($aluno);
    }
    public function deletarTurmaHasAlunoPorTurmaAluno($turma, $aluno)
    {
        $this->turmas_has_alunos->deleteByTurmaAluno($turma, $aluno);
    }
    public function ordenarDecrescenteScore($arr){
        if(empty($arr)){
            return $arr;
        }
        usort($arr, function($a, $b){
            if( $a->getScore() == $b->getScore() ) return 0;
            return ( ( $a->getScore() < $b->getScore() ) ? 1 : -1 ); 
        });
        return $arr;
    }
    public function pegarAllIdsAlunos()
    {
        return $this->alunos->selectAllIds();
    }
    public function atualizarAlunos()
    {
        $idsalunos = $this->pegarAllIdsAlunos();
        $ext = new Extrator();
        foreach ($idsalunos as $id) {
            $alunoAt = $ext->extrair($id);
            if (!is_null($alunoAt)) {
                $this->atualizarAluno($alunoAt);
            }
        }
    }
}



?>