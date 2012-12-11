<?php


class AuthUtility {
	
	public $authenticated = false;
	public $failed = false;

	private $mySQL = null;

	public function __construct() {
		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);

		if ((isset($_SESSION['auth'])) && ($_SESSION['auth'] === true)) {
			$this->authenticated = true;
			return;
		}

		if ((isset($_COOKIE['a'])) && ($_COOKIE['a'] != '')) {
			$cookie = $this->mySQL->cleanString($_COOKIE['a']);
			$result = $this->mySQL->sendQuery("SELECT _id FROM auth WHERE cookie = '$cookie' AND valid_until > NOW()");
			if ($result !== false) {
				$_SESSION['auth'] = true;
				$this->authenticated = true;
				return;
			}

		}
	}

	public function login($username, $password, $remember) {

		if (($username == CMS_USERNAME) && ($password == CMS_PASSWORD)) {
			$_SESSION['auth'] = true;
			$this->authenticated = true;
		}

		if ($this->authenticated) {
			if (intval($remember) === 1) {
				$rand = randomString(16);
				setcookie('a', $rand, time() + (60 * 60 * 24 * 365));
				$this->mySQL->sendQuery("INSERT INTO auth SET cookie = '$rand', valid_until=DATE_ADD(NOW(), INTERVAL 1 YEAR)");
			}

			return true;

		} else {
			$this->failed = true;
			return false;
		}

	}

	public function logout()
	{
		$this->authenticated = false;
		$_SESSION['auth'] = false;
		if ((isset($_COOKIE['a'])) && ($_COOKIE['a'] != '')) {
			$this->mySQL->sendQuery("DELETE FROM auth WHERE cookie = '{$_COOKIE['a']}'");
			setcookie('a', '', time() - 3600);
		}

	}

}



?>