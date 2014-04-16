<?php
//form to search for symptoms
class SearchForm extends CFormModel
{
public $symptoms;
public $symptomCategory;
//validation rules, symptom must be selected for search to happen
public function rules()
{
	return array(
		array('symptoms', 'required'),
	);
}

//attribute labels for searchform
public function attributeLabels()
	{
		return array(
			'symptoms'=>'Select Symptom(s) to be Searched.',
		);
	}




}


?>