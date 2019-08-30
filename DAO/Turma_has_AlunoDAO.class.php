<?php

class Turma_has_AlunoDAO extends Conexao{
    
    public function inserir($turma){
		if ($turma instanceof Turma) {
            foreach ($turma->getAlunos() as $key => $value) {
                $stmt = $this->getPdo()->prepare('INSERT INTO Turma_has_Aluno (id_Turma, id_Aluno) 
                                            VALUES(:id_Turma , :id_Aluno)');
                $stmt->bindParam(':id_Turma', $idTurma, PDO::PARAM_STR);
                $stmt->bindParam(':id_Aluno', $idAluno, PDO::PARAM_STR);
                $idTurma = $turma->getCodigo();
                $idAluno = $value->getCodigo();
                $stmt->execute();
            }
		}
    }

    public function selectByTurma($turma)
	{
		try{
            $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Turma_has_Aluno
					                           WHERE id_Turma
					                           LIKE :id_Turma
					                           ORDER BY id_Turma;");

			$stmt->bindParam(':id_Turma', $idTurma, PDO::PARAM_STR);
            $idTurma = $turma->getCodigo();
		    $stmt->execute();
			$array = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idAluno = $linha['id_Aluno'];
                $aluno = $control->procurarAlunoPorCodigo($idAluno);
				array_push($array, $aluno);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
    }
    
    public function selectByAluno($aluno)
	{
		try{
            $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Turma_has_Aluno
					                           WHERE id_Aluno
					                           LIKE :id_Aluno
					                           ORDER BY id_Aluno;");

            $stmt->bindParam(':id_Aluno', $idAluno, PDO::PARAM_STR);
            $idAluno = $aluno->getCodigo();
		    $stmt->execute();
			$array = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idTurma = $linha['id_Turma'];
                $turma = $control->procurarAlunoPorCodigo($idAluno);
				array_push($array, $aluno);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function deleteByTurma($turma){
        $control = new Controlador();
		try{
			if ($turma instanceof Turma) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Turma_has_Aluno WHERE id_Turma =
												 :id_Turma');
			    $stmt->bindParam(':id_Turma', $idTurma);
			    $idTurma = $turma->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function deleteByAluno($aluno){
        $control = new Controlador();
		try{
			if ($aluno instanceof Aluno) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Turma_has_Aluno WHERE id_Aluno =
												 :id_Aluno');
			    $stmt->bindParam(':id_Aluno', $idAluno);
			    $idAluno = $aluno->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function deleteByTurmaAluno($turma, $aluno){
        $control = new Controlador();
		try{
			if ($aluno instanceof Aluno) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Turma_has_Aluno WHERE 
				id_Turma = :id_Turma and id_Aluno = :id_Aluno');
				$stmt->bindParam(':id_Turma', $idTurma);
				$stmt->bindParam(':id_Aluno', $idAluno);
				$idTurma = $turma->getCodigo();
			    $idAluno = $aluno->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function update($turma)
	{
		try{
		  $stmt = $this->getPdo()->prepare('UPDATE Turma SET nome = :nome WHERE id = :id');
		  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
		  $stmt->bindParam(':nome', $nome,  PDO::PARAM_STR);
		  $id = $turma->getCodigo();
		  $nome = $turma->getNome();
		  $stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

}






?>