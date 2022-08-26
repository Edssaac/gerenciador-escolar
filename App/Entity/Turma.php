<?php

	namespace App\Entity;

    // Dependências necessárias:
    use \App\Database\Connection;
    use \PDO;

	class Turma {

		private $id;
		private $descricao;
		private $ano;
		private $vagas;
        private $db;

		public function __construct($id = '', $descricao = '', $ano = '', $vagas = '') {
			$this->id = $id;
			$this->descricao = $descricao;
			$this->ano = $ano;
			$this->vagas = $vagas;
            $this->db = new Connection('turmas');
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function setDescricao($descricao) {
			$this->descricao = $descricao;
		}

		public function setAno($ano) {
			$this->ano = $ano;
		}

		public function setVagas($vagas) {
			$this->vagas = $vagas;
		}

		public function getId() {
			return $this->id;
		}

		public function getDescricao() {
			return $this->descricao;
		}

		public function getAno() {
			return $this->ano;
		}

		public function getVagas() {
			return $this->vagas;
		}

        public function cadastrar() {
            $this->db->insert([
                "descricao" => $this->descricao,
                "ano" => $this->ano,
                "vagas" => $this->vagas
            ]);

			return true;
        }

		public function getTurmas() {
			$turmas = $this->db->select(null, null, null, "id, descricao")->fetchAll(PDO::FETCH_CLASS);
			$options = "";

			foreach ($turmas as $turma) {
				$options .= "<option value='{$turma->id}'>{$turma->descricao}</option>";
			}

			return $options;
		}

		public function getVagasTurma($id) {
			$matriculados = $this->db->select("id=$id", null, null, "vagas")->fetch();

			return intval($matriculados['vagas']);
		}

	}
?>