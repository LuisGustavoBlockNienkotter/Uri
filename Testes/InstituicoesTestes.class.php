<?php 
	declare(strict_types=1);
	require_once "autoload.php";
	use PHPUnit\Framework\TestCase;
	final class InstituicoesTestes extends TestCase{
		public function testListarAlunosInstituicaoPorScore(){
			$inst = new InstituicaoDAO("URITeste");
			$arr = $inst->ListarAlunosInstituicaoPorScore("nome");
			$aluno = $arr[0];
			$this->assertEquals(10.2, $aluno->getScore());
		}
		public function testListarAlunosInstituicaoPorNome(){
			$inst = new InstituicaoDAO("URITeste");
			$arr = $inst->ListarAlunosInstituicaoPorNome("nome");
			$aluno = $arr[0];
			$this->assertEquals("ele", $aluno->getNome());
		}
		public function testMelhoresInstituicoes(){	
			$inst = new InstituicaoDAO("URITeste");
			$arr = $inst->ListarMelhoresInstituicoes();
			$scoreMaior=$arr[0][1];
			$this->assertEquals(40,$scoreMaior);
		}
	}
?>
