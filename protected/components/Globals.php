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
	//function to return the portlet menu
	public function getSidePortletMenu()
	{
		return array(
			array(
					'label'=>'Add Symptom', 
					'url'=>array('/symptomhistory/addSymptom'),
					'visible'=>(Yii::app()->user->usertype==0),
			),
			array(
					'label'=>'Find a Doctor', 
					'url'=>array('/symptomhistory/usersSymptomHistory'),
					'visible'=>(Yii::app()->user->usertype==0),
			),
			array(
					'label'=>'Manage User Requests ', 
					'url'=>array('/doctorRequests/manageRequests'),
					'visible'=>(Yii::app()->user->usertype==1),
					'itemOptions'=>array('id'=>'manageRequestsLink')
			),
			array(
					'label'=>'Manage User Relations', 
					'url'=>array('/doctorRequests/manageUserRelations'),
					'visible'=>!(Yii::app()->user->isGuest),
			),
			array(
					'label'=>'Manage Patients\' Symptom History', 
					'url'=>array('/user/user/managePatients'),
					'visible'=>(Yii::app()->user->usertype==1),
			),
			array(
					'label'=>'Add Specialties', 
					'url'=>array('/doctorSymptomSpecialties/addSpecialties'),
					'visible'=>(Yii::app()->user->usertype==1)
			),
			array(
					'label'=>'Manage Specialties', 
					'url'=>array('/doctorSymptomSpecialties/manageSpecialties'),
					'visible'=>(Yii::app()->user->usertype==1)
			),
		);
	}
}
?>