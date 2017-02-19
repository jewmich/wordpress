<?php

class User {
	public $person;
	public $passwordHash;
	const PASSWORD_COST = 12;

	public function __construct(Person $person, $passwordHash) {
		$this->person = $person;
		$this->passwordHash = $passwordHash;
	}

	public function getName() { return $this->person->getName(); }

	public function updatePassword($password) {
		$this->passwordHash = self::hashPassword($password);
		$GLOBALS['wpdb']->update('Users', ['password' => $this->passwordHash], ['person_id' => $this->person->id]);
	}

	public function generatePasswordResetToken($expireTime) {
		// this isn't as secure as it could be because an attacker could forge reset links if they 
		// gain access to both the code and DB, but the worst they could do is reserve shabbat dinners 
		// under someone else's name, which isn't exactly the end of the world
		return sha1(RESET_LINK_SALT . $this->passwordHash . $expireTime);
	}

	private function checkPassword($password) {
		$passwordHash = new PasswordHash(self::PASSWORD_COST, false);
		return $passwordHash->CheckPassword($password, $this->passwordHash);
	}

	private static function getByField($fieldName, $fieldValue) {
	}

	public static function getByEmail($email) {
		global $wpdb;
		$sql = $wpdb->prepare("SELECT person_id, password FROM Users JOIN People ON (person_id = id) WHERE email = %s", $email);
		if (!$row = $wpdb->get_row($sql, ARRAY_A)) return null;
		return new self(Person::getFromId($row['person_id']), $row['password']);
	}

	private static function hashPassword($password) {
		$passwordHash = new PasswordHash(self::PASSWORD_COST, false);
		return $passwordHash->HashPassword($password);
	}

	public static function login($email, $password) {
		$user = self::getByEmail($email);
		if (!$user) return false;

		if ($user->checkPassword($password)) {
			session_regenerate_id(true);
			$_SESSION['user'] = $user;
			return true;
		}
		return false;
	}

	public static function getLoggedInUser() {
		return isset($_SESSION['user']) ? $_SESSION['user'] : null;
	}

	public static function create(Person $person, $password) {
		$GLOBALS['wpdb']->insert('Users', [
			'person_id' => $person->id,
			'password' => $passwordHash,
			'created' => date('Y-m-d H:i:s'),
		]);
	}

	public static function isEmailTaken($email) {
		return !is_null(self::getByEmail($email));
	}
}
