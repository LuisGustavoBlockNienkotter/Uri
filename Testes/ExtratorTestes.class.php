<?php 
	declare(strict_types=1);
	require_once "autoload.php";
	use PHPUnit\Framework\TestCase;
	final class ExtratorTestes extends TestCase{
		public function testVerificarIntegridade(){
			$extDao = new ExtratorDAO("URITeste");
			$res = $extDao->VerificarIntegridade();
			$this->assertEquals(TRUE,$res);
		}
	}
?>