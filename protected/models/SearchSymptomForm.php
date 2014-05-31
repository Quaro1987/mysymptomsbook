<?php

/**
 *
 */
class SearchSymptomForm extends CFormModel
{
	public $symptomCode;
	

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// symptomCode is required
			array('symptomCode', 'required'),
		);
	}

}
?>