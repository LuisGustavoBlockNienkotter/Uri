<?php
    class Turma{
        private $codigo;
        private $nome;
        private $alunos;
        public function __construct($nome = "", $alunos = array()) {
            $this->nome = $nome;
            $this->alunos = $alunos;
        }
        /**
         * Get the value of codigo
         */ 
        public function getCodigo()
        {
                return $this->codigo;
        }
        /**
         * Set the value of codigo
         *
         * @return  self
         */ 
        public function setCodigo($codigo)
        {
                $this->codigo = $codigo;

                return $this;
        }
        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }
        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }
        
        /**
         * Get the value of alunos
         */ 
        public function getAlunos()
        {
                return $this->alunos;
        }

        /**
         * Set the value of alunos
         *
         * @return  self
         */ 
        public function setAlunos($alunos)
        {
                $this->alunos = $alunos;

                return $this;
        }
        public function listarAlunos(){
            $txt="";
            foreach ($this->getAlunos() as $aluno) {
                $txt.=$aluno;
            }
            return $txt;
        }

        public function addAluno($aluno)
        {
            if ($aluno instanceof Aluno) {
                $arr = $this->getAlunos();
                array_push($arr, $aluno);
                $this->setAlunos($arr);
            }
            return $this->getAlunos();
        }

        public function calculaScore()
        {
            $score = 0;
            foreach ($this->getAlunos() as $key => $value) {
                $score += $value->getScore();
            }
            if ($score == 0) {
                return 0;
            }
            $score = $score/sizeof($this->getAlunos());
            return $score;
        }
        public function __toString(){
            return "Código: ".$this->getCodigo()."| Nome: ".$this->getNome()."| Alunos: ".$this->listarAlunos();
        }
    }
?>