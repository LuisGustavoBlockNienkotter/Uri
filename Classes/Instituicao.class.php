<?php
    class Instituicao{
        private $codigo;
        private $nome;
        public function __construct($nome = "") {
            $this->nome = $nome;
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
        public function __toString(){
            return "Código: ".$this->getCodigo()."| Nome: ".$this->getNome();
        }
    }
?>