<?php

	namespace App\Entity;

    // Dependências necessárias:
    use \App\Database\Connection;
	use \PDO;

	class Aluno {

        private $id;
		private $nome;
		private $dataNascimento;
		private $cpf;
        private $db;

		public function __construct($id = '', $nome = '', $dataNascimento = '', $cpf = '') {
			$this->id = $id;
			$this->nome = $nome;
			$this->dataNascimento = $dataNascimento;
			$this->cpf = $cpf;
			$this->db = new Connection('alunos');
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function setDataNascimento($dataNascimento) {
			$this->dataNascimento = $dataNascimento;
		}

		public function setCpf($cpf) {
			$this->cpf = $cpf;
		}

		public function getId() {
			return $this->id;
		}

		public function getNome() {
			return $this->nome;
		}

		public function getDataNascimento() {
			return $this->dataNascimento;
		}

		public function getCpf() {
			return $this->cpf;
		}

        public function cadastrar() {
            $this->db->insert([
                "nome" => $this->nome,
                "dataNascimento" => $this->dataNascimento,
                "cpf" => $this->cpf
            ]);

			return true;
        }

		public function getAlunos() {
			$alunos = $this->db->select()->fetchAll(PDO::FETCH_CLASS);

			return $alunos;
		}

		public function getAlunosOptions() {
			$alunos = $this->getAlunos();
			$options = "";

			foreach ($alunos as $aluno) {
				$options .= "<option value='{$aluno->id}'>{$aluno->nome}</option>";
			}

			return $options;
		}

		public function getAlunosChamada($idTurma) {
			$alunos = $this->db->select("id IN (SELECT idAluno FROM matriculas WHERE idTurma=$idTurma)")->fetchAll(PDO::FETCH_CLASS);
			$linhas = "";
			
			foreach ($alunos as $aluno) {
				$dataNascimento = date('d/m/Y', strtotime($aluno->dataNascimento));

				$linhas .= 
				"<tr>
					<td>{$aluno->nome}</td>
					<td>{$dataNascimento}</td>
					<td></td>
				</tr>";
			}

			return $linhas;
		}

	}
?>