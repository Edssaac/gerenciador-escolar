<?php

namespace App\Model;

use App\Model;
use PDO;

class StudentModel extends Model
{
	public function register($data)
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

	public function getStudentsAvailableForClass($idClass)
	{
		$result = $this->query(
			"SELECT s.id, s.name FROM student s
				LEFT JOIN registration r
				ON s.id = r.id_student AND r.id_class = :id_class
				WHERE r.id_student IS NULL
			",
			$this->mapToBind([
				'id_class' => $idClass
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $students;
	}
}
