<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
	public $verifyPassword;
	public $verifyCode;
	
	public function rules() {
		$rules = array(
			array('username, password, verifyPassword, email, userType', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('AMKA', 'length', 'max'=>11, 'min' => 11,'message' => UserModule::t("Incorrect AMKA number. An AMKA number is made up of 11 digits.")),
			array('AMKA', 'unique', 'message' => UserModule::t("This user's AMKA number already exists.")),
			array('AMKA', 'match', 'pattern' => '/^[0-9_]+$/u','message' => UserModule::t("Incorrect symbols (0-9).")),
			array('doctorSpecialty', 'in', 'range'=>array(null,'Doctor')),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}

	public function validateDoctorSpecialty($attribute, $params)
	{
  		if ($this->userType == 1) {
	        $ev = CValidator::createValidator('in', $this, $attribute, $params);
	        $ev->validate($this);
	  	}
	}
	
}