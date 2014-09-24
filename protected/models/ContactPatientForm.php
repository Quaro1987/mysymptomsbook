<?php

/**
 * ContactPatientForm class.
 * ContactPatientForm is the data structure for keeping
 * contact form data. It is used to contact the patient from 'SymptomHistoryController'.
 */
class ContactPatientForm extends CFormModel
{
	public $name;
	public $doctorEmail;
	public $patientEmail;
	public $subject;
	public $body;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, doctorEmail, , patientEmail, subject, body', 'required'),
			// email has to be a valid email address
			array('doctorEmail, patientEmail', 'email'),
		);
	}

}

?>