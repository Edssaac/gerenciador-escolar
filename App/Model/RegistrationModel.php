<?php

namespace App\Model;

use App\Model;
use PDO;

/**
 * Classe que representa uma matrícula.
 */
class RegistrationModel extends Model
{
	/**
	 * Método responsável por matricular um aluno em uma turma.
	 *  
	 * @param array $data
	 * @return bool
	 */
	public function register(array $data): bool
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

	/**
	 * Método responsável por verificar se há vagas em uma determinada turma.
	 *  
	 * @param int $idClass
	 * @return bool
	 */
	public function checkAvailableVacancy(int $idClass): bool
	{
		$result = $this->query(
			"SELECT IF(COUNT(r.id_student) < c.vacancies, 1, 0) AS available
				FROM  class c
				LEFT JOIN registration r ON c.id = r.id_class
				GROUP BY c.id
				HAVING c.id = :id_class
			",
			$this->mapToBind([
				"id_class" => $idClass
			])
		);

		$available = $result->fetch(PDO::FETCH_ASSOC)["available"] ?? false;

		return $available;
	}

	/**
	 * Método responsável por retornar os alunos 
	 * matrículados em uma determinada turma.
	 *  
	 * @param int $idClass
	 * @return array
	 */
	public function getClassStudents(int $idClass): array
	{
		$result = $this->query(
			"SELECT s.name, DATE_FORMAT(s.birth_date, '%d/%m/%Y') AS birth_date FROM student s
				LEFT JOIN registration r
				ON s.id = r.id_student AND r.id_class = :id_class
				WHERE r.id_student IS NOT NULL 
				ORDER BY s.name
			",
			$this->mapToBind([
				"id_class" => $idClass
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $students;
	}

	/**
	 * Método responsável por retornar os alunos que não 
	 * estão matrículados em uma determinada turma.
	 *  
	 * @param int $idClass
	 * @return array
	 */
	public function getStudentsAvailableForClass(int $idClass): array
	{
		$result = $this->query(
			"SELECT s.id, s.name FROM student s
				LEFT JOIN registration r
				ON s.id = r.id_student AND r.id_class = :id_class
				WHERE r.id_student IS NULL
			",
			$this->mapToBind([
				"id_class" => $idClass
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return $students;
	}

	/**
	 * Método responsável por verificar se um aluno está 
	 * matriculado em uma determinada turma.
	 *  
	 * @param int $idClass
	 * @param int $idStudent
	 * @return bool
	 */
	public function checkStudentInClass(int $idClass, int $idStudent): bool
	{
		$result = $this->query(
			"SELECT id_student FROM registration 
				WHERE id_class = :id_class AND id_student = :id_student
			",
			$this->mapToBind([
				"id_class" => $idClass,
				"id_student" => $idStudent
			])
		);

		$students = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

		return !empty($students);
	}
}
