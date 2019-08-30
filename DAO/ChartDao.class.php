<?php
    require_once "autoload.php";
    class ChartDAO{
        public function graficoBarra($arrayAlunos, $top10){
            if (empty($arrayAlunos)) {
                return null;
            }
            $control = new Controlador();
            $arrayAlunos=$control->ordenarDecrescenteScore($arrayAlunos);
            $c = new Chart;
            $arr=array();
            $cab=array();
            array_push($cab, "Aluno");
            array_push($cab, "Score");
            array_push($cab, "{ role: 'style' }");
            array_push($arr, $cab);
            if ($top10) {
                $nalunos = 10;
                if (sizeof($arrayAlunos)<10) {
                    $nalunos=sizeof($arrayAlunos);
                }
                for ($i=0; $i < $nalunos; $i++) { 
                    $a=array();
                    array_push($a, $arrayAlunos[$i]->getNome());
                    array_push($a, $arrayAlunos[$i]->getScore());
                    array_push($a, "3366cc");
                    array_push($arr, $a);
                }
            } else {
                foreach ($arrayAlunos as $aluno) {
                    $a=array();
                    array_push($a, $aluno->getNome());
                    array_push($a, $aluno->getScore());
                    array_push($a, "3366cc");
                    array_push($arr, $a);
                }
            }
            $c->setArray($arr);
            $title="Melhores Alunos";
            if ($top10) {
                $width=400;
                $height=400;
            } else {
                $width=700;
                $height=700;
            }            
            $group=40;
            $pos="bottom";
            $c->setOptions(array(
                "title"=> $title,
                "width"=> $width,
                "height"=> $height,
                "bar"=> "{groupWidth: '".$group."%'}",
                "legend"=> "{ position: '".$pos."' }",
                "backgroundColor" => "lightblue"
            ));
            return $c;
        }
        public function graficoPizza($arrayAlunos){
            if (empty($arrayAlunos)) {
                return null;
            }
            $control = new Controlador();
            $array=$control->ordenarDecrescenteScore($arrayAlunos);
            $c = new Chart;
            $arr=array();
            $cab=array();
            array_push($cab, "elemnt");
            array_push($cab, "Score");
            array_push($arr, $cab);
            if(sizeof($array)>4){
                $menor =$array[sizeof($array)-1]->getScore();
                $divisoes=sqrt(sizeof($array));
                $diff = ($array[0]->getScore()-$menor)/$divisoes;
                $temp=array();
                for ($i=0; $i < $divisoes; $i++) { 
                    array_push($temp, 0); 
                }
                foreach ($array as $aluno) {
                    $score=$aluno->getScore();
                    for ($i=0; $i < $divisoes; $i++) { 
                        if (($score>=$menor+$diff*$i)&&($score<$menor+$diff*($i+1))) {
                            $temp[$i]++;
                            break;
                        }
                    }
                }
                $temp[sizeof($temp)-1]++;
                for ($i=0; $i < $divisoes; $i++) { 
                    $a=array();
                    array_push($a, number_format(($menor+$diff*$i), 2, '.', ',')."-".number_format(($menor+$diff*($i+1)), 2, '.', ','));
                    array_push($a, $temp[$i]);
                    array_push($arr, $a);   
                }
            }else{
                foreach ($array as $aluno) {
                    $a=array();
                    array_push($a, $aluno->getNome());
                    array_push($a, $aluno->getScore());
                    array_push($arr, $a);
                }
            }
            $c->setArray($arr);
            $title="Alunos por Score";
            $c->setOptions(array(
                "title" => $title,
                "backgroundColor" => "lightblue"	
            ));
            return $c;
        }
    }
?>