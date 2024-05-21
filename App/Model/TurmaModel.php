<?php

namespace App\Model;

use App\Model;
use PDO;

class TurmaModel extends Model
{
	public function cadastrar($data)
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

	public function getTurmas()
	{
		$result = $this->query(
			"SELECT id, description FROM class
			ORDER BY description
		");

		$classes = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $classes;
	}
}
