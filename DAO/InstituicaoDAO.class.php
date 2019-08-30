<?php

class InstituicaoDAO extends Conexao {
    
    public function inserir($inst){
		if ($inst instanceof Instituicao) {
			$stmt = $this->getPdo()->prepare('INSERT INTO Instituicao (nome) VALUES(:nome)');
		    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		    $nome = $inst->getNome();
		    $stmt->execute();
		}
    }
    
    public function selectAll(){
		try{
			$consulta = $this->getPdo()->query("SELECT * FROM Instituicao;");
			$array = array();
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $inst = new Instituicao($linha['nome']);
                $inst->setCodigo($linha['id']);
			    array_push($array, $inst);
			}
			return $array;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
    }
    
    public function selectById($id)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM Instituicao
					                           WHERE id
					                           LIKE :id
					                           ORDER BY id;");
		    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
		    $stmt->execute();
			$Instituicao = null;
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $Instituicao = new Instituicao($linha['nome']);
                $Instituicao->setCodigo($linha['id']);
			}
			return $Instituicao;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectByNome($nome)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM Instituicao
					                           WHERE nome = :nome
					                           ORDER BY nome;");

		    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		    $stmt->execute();
			$Instituicao = null;
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $Instituicao = new Instituicao($linha['nome']);
                $Instituicao->setCodigo($linha['id']);
			}
			return $Instituicao;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function delete($Instituicao){
        $control = new Controlador();
		try{
			if ($Instituicao instanceof Instituicao) {
				$stmt = $this->getPdo()->prepare('DELETE FROM Instituicao WHERE id = :id');
			    $stmt->bindParam(':id', $id);
			    $id = $Instituicao->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function update($Instituicao)
	{
		try{
		  $stmt = $this->getPdo()->prepare('UPDATE Instituicao SET nome = :nome WHERE id = :id');
		  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
		  $stmt->bindParam(':nome', $nome,  PDO::PARAM_STR);
		  $id = $Instituicao->getCodigo();
		  $nome = $Instituicao->getNome();
		  $stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

}


?>
