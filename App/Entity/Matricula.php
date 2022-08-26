<?php

	namespace App\Entity;

    // Dependências necessárias:
    use \App\Database\Connection;
    use \PDO;

	class Matricula {

		private $idAluno;
		private $idTurma;
        private $db;

		public function __construct($idAluno = '', $idTurma = '') {
			$this->idAluno = $idAluno;
			$this->idTurma = $idTurma;
            $this->db = new Connection('matriculas');
		}

		public function setIdAluno($idAluno) {
			$this->idAluno = $idAluno;
		}

		public function setIdTurma($idTurma) {
			$this->idTurma = $idTurma;
		}

		public function getIdAluno() {
			return $this->idAluno;
		}

		public function getIdTurma() {
			return $this->idTurma;
		}

        public function matricular() {
            $this->db->insert([
                "idAluno" => $this->idAluno,
                "idTurma" => $this->idTurma
            ]);

			return true;
        }

		public function getMatriculados() {
			$matriculados = $this->db->select("idTurma=$this->idTurma", null, null, "count(*) AS quantidade")->fetch();

			return intval($matriculados['quantidade']);
		}

		public function vagaDisponivel() {
			$turma = new Turma();
			$vagas = $turma->getVagasTurma($this->idTurma);
			$matriculados = $this->getMatriculados();

			return ($matriculados < $vagas);
		}

	}
?>