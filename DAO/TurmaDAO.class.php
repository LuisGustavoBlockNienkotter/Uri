<?php

class TurmaDAO extends Conexao{
    
    public function inserir($turma){
		if ($turma instanceof Turma) {
            $turma_has_aluno = new Turma_has_AlunoDAO();
			$stmt = $this->getPdo()->prepare('INSERT INTO Turma (nome) VALUES(:nome)');
		    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $nome = $turma->getNome();
            $stmt->execute();
            if (!is_null($turma->getAlunos())) {
                $turma_has_aluno->inserir($turma);
            }
		}
    }

    public function selectAll(){
		try{
            $control = new Controlador();
			$consulta = $this->getPdo()->query("SELECT * FROM Turma;");
			$array = array();
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $turma = new Turma($linha['nome']);
                $turma->setCodigo($linha['id']);
                $turma->setAlunos($control->procurarAlunosPorTurma($turma));
			    array_push($array, $turma);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
    }

    public function selectById($id)
	{
		try{
            $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Turma
					                           WHERE id
					                           LIKE :id
					                           ORDER BY id;");
		    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
		    $stmt->execute();
			$turma = null;
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $turma = new Turma($linha['nome'], null);
                $turma->setCodigo($linha['id']);
                $alunos = $control->procurarAlunosPorTurma($turma);
                $turma->setAlunos($alunos);
			}
			return $turma;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
    }
    
    public function selectByNome($nome)
	{
		try{
            $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Turma
					                           WHERE nome
					                           LIKE :nome
					                           ORDER BY nome;");
		    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		    $stmt->execute();
            $turma = null;
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $turma = new Turma($linha['nome'], null);
				$turma->setCodigo($linha['id']);
                $alunos = $control->procurarAlunosPorTurma($turma);
                $turma->setAlunos($alunos);
			}
			return $turma;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
    }
    
    public function delete($turma){
        $control = new Controlador();
		try{
			if ($turma instanceof Turma) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Turma WHERE id = :id');
			    $stmt->bindParam(':id', $id);
				$id = $turma->getCodigo();
				$control->deletarTurmaHasAlunoPorTurma($turma);
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function update($turma)
	{
		$control = new Controlador();
		try{
			$stmt = $this->getPdo()->prepare('UPDATE Turma SET nome = :nome WHERE id = :id');
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':nome', $nome,  PDO::PARAM_STR);
			$id = $turma->getCodigo();
			$nome = $turma->getNome();
			$control->deletarTurmaHasAlunoPorTurma($turma);
			$control->inserirTurmaHasAluno($turma);
			$stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

}



?>