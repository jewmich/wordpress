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
		global $wpdb;
		$query = 'UPDATE People SET firstname = ?, lastname = ?, fullname = ?, email = ?, phone = ?, is_student = ?, student_year = ? WHERE id = ?';
		$query = $wpdb->prepare($query, $this->firstName, $this->lastName, $this->fullName, $this->email, $this->phone, $this->isStudent, $this->studentYear, $this->id);
		$wpdb->query($query);
		return true;
	}

	private static function getByField($fieldName, $fieldValue) {
		global $wpdb;
		$sql = $wpdb->prepare("SELECT * FROM People WHERE $fieldName = ?", $fieldValue);
		$row = $wpdb->get_row($sql, ARRAY_A);
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
		global $wpdb;
		$query = 'SELECT id FROM People WHERE firstname = ? AND lastname = ? AND fullname = ? AND email = ? AND phone = ? AND is_student = ? AND student_year = ?';
		$query = $wpdb->prepare($query, $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);
		$row = $wpdb->get_row($query, ARRAY_A);
		if ($row) return new self($row['id'], $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);

		$query = 'INSERT INTO People SET firstname = ?, lastname = ?, fullname = ?, email = ?, phone = ?, is_student = ?, student_year = ?';
		$query = $wpdb->prepare($query, $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);
		$wpdb->query($query);
		return new self($wpdb->insert_id, $firstName, $lastName, $fullName, $email, $phone, $isStudent, $studentYear);
	}
}
