<?php
	require_once "./classes/InputValidator.php";

	class InputValidatorTest extends PHPUnit_Framework_TestCase {
		private $validator;

		//public function __autoload($name) {
			//include_once "./../classes/" . $name . ".php";
		//}

		public function __construct() {
			//trigger_error(getcwd());
		}

		public function setUp() {
			$this->validator = new InputValidator();
		}

		public function testLoginIsUnique() {
			$this->setUp();
			$invalidUsername = "test"; //already exists
			$this->validator->loginIsUnique($invalidUsername, "username");
			$expected = array("status"=>"Error", "problemMsg"=>"Username is not unique!");
			$this->assertEquals($expected, $this->validator->getStatus());
		}

		public function offtestCheckUsernameNull() {
			$this->setUp();
			$username = "";
			$this->validator->checkUsername($username);
			$this->assertNull($this->validator->getStatus());
		}

		//invalid username:: username already exists
		public function offtestCheckUsername() {
			$this->setUp();

			$invalidUsername = "test"; //already exists in db

			$this->validator->checkUsername($invalidUsername);
			$expected = array("status"=>"Error", "problemMsg"=>"Username is not unique!");
			$this->assertEquals($expected, $this->validator->getStatus());
		}
	}
?>