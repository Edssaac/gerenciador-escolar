<?php

namespace App\Model;

use App\Model;
use PDO;

class MatriculaModel extends Model
{
	public function matricular($data)
	{
		$this->query(
			"INSERT INTO registration SET
				id_student = :id_student, 
				id_class = :id_class,
				registration_date = NOW()
			",
			$this->mapToBind($data)
		);

		return true;
	}

	public function verificarVagaDisponivel($idClass)
	{
		$result = $this->query(
			"SELECT IF(COUNT(r.id_student) < c.vacancies, 1, 0) AS available
				FROM  class c
				LEFT JOIN registration r ON c.id = r.id_class
				GROUP BY c.id
				HAVING c.id = :id_class
			",
			$this->mapToBind([
				'id_class' => $idClass
			])
		);

		$available = $result->fetch(PDO::FETCH_ASSOC)['available'] ?? false;

		return $available;
	}

	public function verificarAlunoNaTurma($idClass, $idStudent)
	{
		$result = $this->query(
			"SELECT id_student FROM registration 
				WHERE id_class = :id_class AND id_student = :id_student
			",
			$this->mapToBind([
				'id_class' => $idClass,
				'id_student' => $idStudent
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return empty($students);
	}
}
