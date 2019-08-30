<?php 
	declare(strict_types=1);
	require_once "autoload.php";
	use PHPUnit\Framework\TestCase;
	final class TurmaTestes extends TestCase{
		public function testListarAlunosTurmaPorScore(){
			$tur = new TurmaDAO("URITeste");
			$arr = $tur->ListarAlunosTurmaPorScore("nome");
			$aluno = $arr[0];
			$this->assertEquals(10.2,$aluno->getScore());
		}
		public function testListarAlunosTurmaPorNome(){
			$tur = new TurmaDAO("URITeste");
			$arr = $tur->ListarAlunosTurmaPorNome("nome");
			$aluno = $arr[0];
			$this->assertEquals("nome",$aluno->getNome());
		}
	}
?>
