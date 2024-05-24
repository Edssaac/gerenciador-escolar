<?php

namespace App\Model;

use App\Model;
use PDO;

/**
 * Classe que representa uma turma.
 */
class ClassModel extends Model
{
	/**
	 * Método responsável por cadastrar uma turma.
	 *  
	 * @param array $data
	 * @return bool
	 */
	public function register(array $data): bool
	{
		$this->query(
			"INSERT INTO class SET
				description = :description, 
				year = :year, 
				vacancies = :vacancies
			",
			$this->mapToBind($data)
		);

		return true;
	}

	/**
	 * Método responsável retornar as turmas cadastradas.
	 *  
	 * @return array
	 */
	public function getClasses(): array
	{
		$result = $this->query(
			"SELECT id, description FROM class
			ORDER BY description
			"
		);

		$classes = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $classes;
	}
}
