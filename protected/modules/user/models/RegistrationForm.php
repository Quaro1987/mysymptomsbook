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
			array('username, password, verifyPassword, email, phoneNumber, userType', 'required'),
			array('aboutDoctor, doctorSpecialty', 'required','on'=>'doctor'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('aboutDoctor','safe'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('phoneNumber', 'length', 'max'=>18, 'min' => 7,'message' => UserModule::t("A phone number must be between 7 and 18 digits.")),
			array('phoneNumber', 'unique', 'message' => UserModule::t("This phone number already belongs to another user.")),
			array('phoneNumber', 'match', 'pattern' => '/^[0-9_]+$/u','message' => UserModule::t("Incorrect symbols (0-9).")),
			array('doctorSpecialty', 'in', 'range'=>array('0','Cardiologost', 'Dentist', 'Dermatologist', 'Pathologist')),
			array('doctorSpecialty', 'in', 'range'=>array('Cardiologost', 'Dentist', 'Dermatologist', 'Pathologist'), 'on'=>'doctor', 'message'=>"You must select a specialty Doctor."),
			array('aboutDoctor', 'length', 'max'=> 4096, 'min'=>1, 'on'=>'doctor', 'message'=>"You must write a small document/CV about yourself."),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}

	
	
}
