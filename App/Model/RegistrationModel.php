<?php

namespace App\Model;

use App\Model;
use PDO;

class RegistrationModel extends Model
{
	public function register($data)
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

	public function checkAvailableVacancy($idClass)
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

	public function getClassStudents($idClass)
	{
		$result = $this->query(
			"SELECT s.name, DATE_FORMAT(s.birth_date, '%d/%m/%Y') AS birth_date FROM student s
				LEFT JOIN registration r
				ON s.id = r.id_student AND r.id_class = :id_class
				WHERE r.id_student IS NOT NULL 
				ORDER BY s.name
			",
			$this->mapToBind([
				'id_class' => $idClass
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $students;
	}

	public function checkStudentInClass($idClass, $idStudent)
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

		return !empty($students);
	}
}
