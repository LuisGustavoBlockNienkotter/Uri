<?php

class AlunoDAO extends Conexao{
    
    public function inserir($aluno){
		  if ($aluno instanceof Aluno) {
          $control = new Controlador();
          $stmt = $this->getPdo()->prepare('INSERT INTO Aluno (id, nome, rankGeral, 
                                              id_Instituicao, dataCadastro, score, 
                                              tentados, resolvidos, submissoes) VALUES(:id , :nome , 
                                              :rankGeral , :id_Instituicao, :dataCadastro , :score ,
                                              :tentados , :resolvidos , :submissoes)');
          $stmt->bindParam(':id', $id, PDO::PARAM_STR);
          $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
          $stmt->bindParam(':rankGeral', $rank, PDO::PARAM_STR);
          $stmt->bindParam(':id_Instituicao', $ins, PDO::PARAM_INT);
          $stmt->bindParam(':dataCadastro', $data, PDO::PARAM_STR);
          $stmt->bindParam(':score', $score, PDO::PARAM_STR);
          $stmt->bindParam(':tentados', $tentados, PDO::PARAM_INT);
          $stmt->bindParam(':resolvidos', $resolvidos, PDO::PARAM_INT);
          $stmt->bindParam(':submissoes', $submetidos, PDO::PARAM_INT);
          $id = $aluno->getCodigo();
          $nome = $aluno->getNome();
          $rank = $aluno->getRankGeral();
          $instituicao = $aluno->getInstituicao();
          if (is_null($instituicao->getCodigo())) {
            $control->inserirInstituicao($instituicao);
          }
          foreach ($control->listarInstituicoes() as $key => $value) {
            if (strcmp($value->getNome(), $instituicao->getNome()) == 0) {
              $ins = $value->getCodigo();
            }
          }
          $data = $aluno->getDataCadastro();
          $score = $aluno->getScore();
          $tentados = $aluno->getTentados();
          $resolvidos = $aluno->getResolvidos();
          $submetidos = $aluno->getSubmetidos();
          $stmt->execute();
      }

    }

  public function selectAll(){
    $control = new Controlador();
		try{
			$consulta = $this->getPdo()->query("SELECT * FROM Aluno;");
			$array = array();
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
                $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
                $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
                $linha['tentados'], $linha['submissoes']);
			    array_push($array, $aluno);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }

  public function selectById($id){
		try{
      $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Aluno
					                           WHERE id
					                           LIKE :id
					                           ORDER BY id;");
		  $stmt->bindParam(':id', $id, PDO::PARAM_STR);
		  $stmt->execute();
			$aluno = null;
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
        $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
        $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
        $linha['tentados'], $linha['submissoes']);
			}
			return $aluno;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }
  
  public function selectByNome($nome){
		try{
      $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Aluno
					                           WHERE nome
					                           LIKE :nome
					                           ORDER BY nome;");
		  $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		  $stmt->execute();
			$arr = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
        $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
        $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
        $linha['tentados'], $linha['submissoes']);
        array_push($arr, $aluno);
      }
			return $arr;  
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }

  public function selectByNomeUsingLike($nome){
		try{
      $control = new Controlador();
      $nome = "%". $nome . "%";
			$stmt = $this->getPdo()->prepare("SELECT * FROM Aluno
					                           WHERE nome
					                           LIKE :nome 
					                           ORDER BY nome;");
		  $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		  $stmt->execute();
			$arr = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
        $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
        $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
        $linha['tentados'], $linha['submissoes']);
        array_push($arr, $aluno);
      }
			return $arr;  
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }

  public function selectByScoreInRange($min, $max){
		try{
      $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM aluno WHERE score 
                                        BETWEEN ". $min ." AND ". $max ." ORDER BY score;");
		  $stmt->execute();
			$arr = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
        $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
        $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
        $linha['tentados'], $linha['submissoes']);
        array_push($arr, $aluno);
      }
			return $arr;  
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }
  
  public function selectByInstituicao($ins){
		try{
      $control = new Controlador();
			$stmt = $this->getPdo()->prepare("SELECT * FROM Aluno
					                           WHERE id_Instituicao
					                           LIKE :id_Instituicao
                                     ORDER BY id_Instituicao;");
      $cod = $ins->getCodigo(); 
		  $stmt->bindParam(':id_Instituicao', $cod, PDO::PARAM_INT);
		  $stmt->execute();
			$arr = array();
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aluno = new Aluno($linha['id'], $linha['nome'], $linha['rankGeral'], 
        $control->procurarInstituicaoPorCodigo($linha['id_Instituicao']), 
        $linha['dataCadastro'], $linha['score'], $linha['resolvidos'], 
        $linha['tentados'], $linha['submissoes']);
        array_push($arr, $aluno);
      }
			return $arr;  
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }
  
  public function delete($aluno)
	{
    $control = new Controlador();
		try{
			if ($aluno instanceof Aluno) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Aluno WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $id = $aluno->getCodigo();
        $control->deletarTurmaHasAlunoPorAluno($aluno);
        $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }
  
  public function update($aluno)
	{
		try{
		  $stmt = $this->getPdo()->prepare('UPDATE Aluno SET nome = :nome ,
                                       rankGeral = :rankGeral , id_Instituicao = :id_Instituicao, 
                                       dataCadastro = :dataCadastro , score = :score ,
                                       tentados = :tentados , resolvidos = :resolvidos , 
                                       submissoes = :submissoes WHERE id = :id');
		  $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
      $stmt->bindParam(':rankGeral', $rank, PDO::PARAM_STR);
      $stmt->bindParam(':id_Instituicao', $ins, PDO::PARAM_INT);
      $stmt->bindParam(':dataCadastro', $data, PDO::PARAM_STR);
      $stmt->bindParam(':score', $score, PDO::PARAM_STR);
      $stmt->bindParam(':tentados', $tentados, PDO::PARAM_INT);
      $stmt->bindParam(':resolvidos', $resolvidos, PDO::PARAM_INT);
      $stmt->bindParam(':submissoes', $submetidos, PDO::PARAM_INT);
		  $id = $aluno->getCodigo();
      $nome = $aluno->getNome();
      $rank = $aluno->getRankGeral();
      $ins= $aluno->getInstituicao()->getCodigo();
      $data = $aluno->getDataCadastro();
      $score = $aluno->getScore();
      $tentados = $aluno->getTentados();
      $resolvidos = $aluno->getResolvidos();
      $submetidos = $aluno->getSubmetidos();
		  $stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

  public function selectAllIds()
  {
    $control = new Controlador();
		try{
			$consulta = $this->getPdo()->query("SELECT id FROM Aluno;");
			$array = array();
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
			    array_push($array, $linha['id']);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
  }
}




?>