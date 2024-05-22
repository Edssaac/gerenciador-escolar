<?php

namespace App\Model;

use App\Model;
use PDO;

class ClassModel extends Model
{
	public function register($data)
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

	public function getClasses()
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
