<?php

class Person {
	public $id;
	public $firstName;
	public $lastName;
	public $fullName;
	public $email;
	public $phone;
	public $isStudent;
	public $studentYear;

	public function __construct($id, $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear) {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->fullName = $fullName;
		$this->email = $email;
		$this->phone = $phone;
		$this->isStudent = $isStudent;
		$this->studentYear = $studentYear;
	}

	public function getName() {
		if (!empty($this->fullName)) return $this->fullName;
		return $this->firstName . ' ' . $this->lastName;
	}

	public function save() {
		$query = 'UPDATE People SET firstname = ?, lastname = ?, fullname = ?, email = ?, phone = ?, is_student = ?, student_year = ? WHERE id = ?';
		getDb()->prepare($query)->execute(array($this->firstName, $this->lastName, $this->fullName, $this->email, $this->phone, $this->isStudent, $this->studentYear, $this->id));
		return true;
	}

	private static function getByField($fieldName, $fieldValue) {
		$query = "SELECT * FROM People WHERE $fieldName = ?";
		$stmt = getDb()->prepare($query);
		$stmt->execute(array($fieldValue));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row) return null;
		return new self($row['id'], $row['firstname'], $row['lastname'], $row['fullname'], $row['email'], $row['phone'], $row['is_student'], $row['student_year']);
	}

	public static function getFromId($id) { return self::getByField('id', $id); }

	public static function getByPhone($phone) {
		$toReplace = array('-', ' ', '(', ')', '.');

		$phone = str_replace($toReplace, array(), $phone);

		$fieldName = 'phone';
		foreach ($toReplace as $char) $fieldName = "REPLACE($fieldName, '$char', '')";

		return self::getByField($fieldName, $phone);
	}

	public static function getOrCreate($firstName = '', $lastName = '', $fullName = '', $email = '', $phone = '', $isStudent = '', $studentYear = '') {
		$query = 'SELECT id FROM People WHERE firstname = ? AND lastname = ? AND fullname = ? AND email = ? AND phone = ? AND is_student = ? AND student_year = ?';
		$stmt = getDb()->prepare($query);
		$stmt->execute(array($firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) return new self($row['id'], $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);

		$query = 'INSERT INTO People SET firstname = ?, lastname = ?, fullname = ?, email = ?, phone = ?, is_student = ?, student_year = ?';
		getDb()->prepare($query)->execute(array($firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear));
		return new self(getDb()->lastInsertId(), $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);
	}
}
