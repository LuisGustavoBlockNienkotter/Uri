<?php 
	declare(strict_types=1);
	require_once "autoload.php";
	use PHPUnit\Framework\TestCase;
	final class AlunoTestes extends TestCase{
		public function testConsultarAluno(){
			$alunoDao = new AlunoDAO("URITeste");
			$aluno = $AlunoDao->ConsultarAluno("nome");
			$this->assertEquals(TRUE,!is_null($aluno));
		}
		public function testConsultarAlunoNull(){
			$alunoDao = new AlunoDAO("URITeste");
			$aluno = $AlunoDao->ConsultarAluno("nome1");
			$this->assertEquals(TRUE,is_null($aluno));
		}
	}
?>