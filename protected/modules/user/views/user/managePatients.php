<?php 

$this->pageTitle=Yii::app()->name . ' - Manage Patients';
$this->breadcrumbs=array(
	'Manage Patients',
); 

//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();


//patients who are connected with the doctor are presented in this grid view
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'manage-patients-grid',
	'dataProvider'=>$dataProvider,
	'selectableRows'=>0,
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
            				      'imageUrl'=>Yii::app()->request->baseUrl.'/images/Magnifying_glass.png',
            				       'url'=>'Yii::app()->createUrl("symptomhistory/patientSymptomHistory",array("id"=>$data->primaryKey))',
            			      ),
		),
	),
))); ?>

