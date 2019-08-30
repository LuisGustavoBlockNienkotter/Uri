<?php
    require_once "autoload.php";
    class Extrator{
        private $control;

        public function __construct() {
            $this->control = new Controlador();
        }
        public function extrair($codigo){
            $control = new Controlador();
            $file = @file_get_contents("https://www.urionlinejudge.com.br/judge/en/profile/".$codigo);
            if ($file==false) {
                return null;
            }
            $imagem1 = explode("img src=\"https://www.gravatar.com/avatar/",$file);
            $imagem = explode("?s=",$imagem1[1])[0];

            $nome1 = explode($codigo."\">", $imagem1[1]);
            $nome = explode("</a>",$nome1[1])[0];

            $rankGeral1 = explode("Place:</span>",$nome1[1]);
            $rankGeral = trim(explode("</li>", $rankGeral1[1])[0]);

            $instituicao1 = explode("'name'>", $rankGeral1[1]); 
            $instituicao = explode("</i>", $instituicao1[1])[0];
            
            $flag = true;
            foreach ($control->listarInstituicoes() as $key => $value) {
                if ($value->getNome() == $instituicao) {
                    $ins = $value;
                    $flag = false;
                }
            }
            if ($flag) {
                $ins = new Instituicao($instituicao);
            }

            $data1 = explode("Since:</span>", $instituicao1[1]);
            $data = trim(explode("</li>", $data1[1])[0]); 

            $dataFormatada = date("Y-m-d", strtotime($data));

            $score1 = explode("Points:</span>", $data1[1]);
            $score = trim(explode("</li>", $score1[1])[0]); 

            $score = str_replace(",", "", $score);
            $score = floatval($score);

            $resolvidos1 = explode("Solved:</span>", $score1[1]);
            $resolvidos = trim(explode("</li>", $resolvidos1[1])[0]); 

            $tentados1 = explode("Tried:</span>", $resolvidos1[1]);
            $tentados = trim(explode("</li>", $tentados1[1])[0]); 

            $submetidos1 = explode("Submissions:</span>", $tentados1[1]);
            $submetidos = trim(explode("</li>", $submetidos1[1])[0]); 

            $aluno = new Aluno($codigo, $nome, $rankGeral , $ins , $dataFormatada , 
                                $score, $resolvidos, $tentados, $submetidos, $imagem);

            return $aluno   ;
        }
    }
?>