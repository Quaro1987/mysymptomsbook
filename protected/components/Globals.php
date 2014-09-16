<?php
//this file includes all the global functions made for the needs of the app
class Globals extends CApplicationComponent
{
	//get all symptom categories data
	public function getSymptomCategories()
	{
		 return array(
		 				'Blood, immune sytem' => 'Blood, immune sytem',
		 				'Circulatory' => 'Circulatory',
		 				'Digestive' => 'Digestive',
		 				'Ear, Hearing' => 'Ear, Hearing',
		 				'Eye' => 'Eye',
		 				'Female genital' => 'Female genital',
		 				'General' => 'General',
		 				'Male genital' => 'Male genital',
		 				'Metabolic, endocrine' => 'Metabolic, endocrine',
		 				'Musculoskeletal' => 'Musculoskeletal',
		 				'Neurological' => 'Neurological',
		 				'Psychological' => 'Psychological',
		 				'Respiratory' => 'Respiratory',
		 				'Skin' => 'Skin',
		 				'Social problems' => 'Social problems',
		 				'Urological' => 'Urological',
		 				'Women\'s health, pregnancy' => 'Women\'s health, pregnancy'
		 			  );
	}
}
?>