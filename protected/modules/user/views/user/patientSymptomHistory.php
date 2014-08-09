<?php 

$this->pageTitle=Yii::app()->name . ' - Patient Symptom History';
$this->breadcrumbs=array(
	'Patient Symptom History',
); 

//side menu
$this->menu=array(
	array(
			'label'=>'Add Symptom', 
			'url'=>array('/symptomhistory/addSymptom'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Find a Doctor', 
			'url'=>array('/doctorRequests/addDoctor'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Manage User Requests', 
			'url'=>array('doctorRequests/manageRequests'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
	array(
			'label'=>'Check Patient Symptom History', 
			'url'=>array('/user/user/managePatients'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
);
?>
<h2> <?php echo $this->getUserFirstName($model)." ".$this->getUserLastName($model)."'s Symptom History"; ?> </h2>

<?php
$model2 = new Symptomhistory;
$this->renderPartial('..\..\..\..\views\symptomhistory\_usersHistory',array('model'=>$model2,'id'=>$model->id));
?>