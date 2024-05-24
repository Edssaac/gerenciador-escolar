<?php

namespace App\Model;

use App\Model;
use PDO;

/**
 * Classe que representa um aluno.
 */
class StudentModel extends Model
{
	/**
	 * Método responsável por cadastrar um novo aluno no sistema.
	 *  
	 * @param array $data
	 * @return bool
	 */
	public function register(array $data): bool
	{
		$this->query(
			"INSERT INTO student SET
				name = :name, 
				birth_date = :birth_date, 
				cpf = :cpf
			",
			$this->mapToBind($data)
		);

		return true;
	}
}
