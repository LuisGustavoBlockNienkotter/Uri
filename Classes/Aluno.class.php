<?php
    require_once "autoload.php";
    class Aluno{
        private $codigo;
        private $imagem;
        private $nome;
        private $rankGeral;
        private $instituicao;
        private $dataCadastro;
        private $score;
        private $resolvidos;
        private $tentados;
        private $submetidos;
        public function __construct($codigo=1, $nome = "", $rankGeral = 1, $instituicao = null, $dataCadastro = "01-01-2001", 
            $score = 0, $resolvidos = 0, $tentados = 0, $submetidos = 0, $imagem = "") {
            $this->codigo = $codigo;
            $this->imagem = $imagem;
            $this->nome = $nome;
            $this->rankGeral = $rankGeral;
            $this->instituicao = $instituicao;
            $this->dataCadastro = $dataCadastro;
            $this->score = $score;
            $this->resolvidos = $resolvidos;
            $this->tentados = $tentados;
            $this->submetidos = $submetidos;
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
         * Get the value of rankGeral
         */ 
        public function getRankGeral()
        {
                return $this->rankGeral;
        }
        /**
         * Set the value of rankGeral
         *
         * @return  self
         */ 
        public function setRankGeral($rankGeral)
        {
                $this->rankGeral = $rankGeral;

                return $this;
        }
        /**
         * Get the value of instituicao
         */ 
        public function getInstituicao()
        {
                return $this->instituicao;
        }
        /**
         * Set the value of instituicao
         *
         * @return  self
         */ 
        public function setInstituicao($instituicao)
        {
                $this->instituicao = $instituicao;

                return $this;
        }
        /**
         * Get the value of dataCadastro
         */ 
        public function getDataCadastro()
        {
                return $this->dataCadastro;
        }
        /**
         * Set the value of dataCadastro
         *
         * @return  self
         */ 
        public function setDataCadastro($dataCadastro)
        {
                $this->dataCadastro = $dataCadastro;

                return $this;
        }
        /**
         * Get the value of score
         */ 
        public function getScore()
        {
                return $this->score;
        }
        /**
         * Set the value of score
         *
         * @return  self
         */ 
        public function setScore($score)
        {
                $this->score = $score;

                return $this;
        }
        /**
         * Get the value of resolvidos
         */ 
        public function getResolvidos()
        {
                return $this->resolvidos;
        }
        /**
         * Set the value of resolvidos
         *
         * @return  self
         */ 
        public function setResolvidos($resolvidos)
        {
                $this->resolvidos = $resolvidos;

                return $this;
        }
        /**
         * Get the value of tentados
         */ 
        public function getTentados()
        {
                return $this->tentados;
        }

        /**
         * Set the value of tentados
         *
         * @return  self
         */ 
        public function setTentados($tentados)
        {
                $this->tentados = $tentados;

                return $this;
        }
        /**
         * Get the value of submetidos
         */ 
        public function getSubmetidos()
        {
                return $this->submetidos;
        }
        /**
         * Set the value of submetidos
         *
         * @return  self
         */ 
        public function setSubmetidos($submetidos)
        {
                $this->submetidos = $submetidos;

                return $this;
        }
        /**
         * Get the value of imagem
         */ 
        public function getImagem()
        {
                return $this->imagem;
        }

        /**
         * Set the value of imagem
         *
         * @return  self
         */ 
        public function setImagem($imagem)
        {
                $this->imagem = $imagem;

                return $this;
        }
        public function getImagemHtml()
        {
                return "<img src=\"https://www.gravatar.com/avatar/".$this->getImagem()."?s=125&d=robohash&r=g\" alt=\"\"/>";
        }
        public function __toString(){
                return "Código: ".$this->getCodigo()."| Nome: ".$this->getNome()."| Rank Geral: ".$this->getRankGeral()."| Instituição: ".
                    $this->getInstituicao()."| Data de Cadastro: ".$this->getDataCadastro()."| Score: ".$this->getScore()."| Resolvidos: ".
                    $this->getResolvidos()."| Tentados".$this->getTentados()."| Submetidos: ".$this->getSubmetidos()."| Imagem: ".$this->getImagem();
            }
    }
?>