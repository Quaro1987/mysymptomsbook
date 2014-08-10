<?php 

$this->pageTitle=Yii::app()->name . ' - Manage Patients';
$this->breadcrumbs=array(
	'Manage Patients',
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
			'url'=>array('/doctorRequests/manageRequests'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
);


//patients who are connected with the doctor are presented in this grid view
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'manage-patients-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		array(
			'header'=>'Last Name',
			'value'=> array($this,'getUserLastName')
		),
		array(
			'header'=>'First Name',
			'value'=> array($this,'getUserFirstName')
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{Get Symptoms History}',
			'buttons'=>array(
						'Get Symptoms History' => array(
            				      'label'=>'Get Users Symptoms History',
            				      //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
            				        'url'=>'Yii::app()->controller->createUrl("patientSymptomHistory",array("id"=>$data->primaryKey))',
            			      ),
		),
	),
))); ?>

