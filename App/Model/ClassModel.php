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
	 * Método responsável por retornar as turmas cadastradas.
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

	/**
	 * Método responsável por retornar uma determinada turma.
	 *  
	 * @param int $idClass
	 * @return array
	 */
	public function getClass(int $idClass): array
	{
		$result = $this->query(
			"SELECT id, description, year, vacancies FROM class
				WHERE id = :id
			",
			$this->mapToBind([
				"id" => $idClass
			])
		);

		$class = $result->fetch(PDO::FETCH_ASSOC) ?? [];

		return $class;
	}
}
