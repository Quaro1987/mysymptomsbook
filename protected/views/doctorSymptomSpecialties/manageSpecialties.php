<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Manage Symptom Specialties',
);
//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();
?>

<h1>Manage Symptom Specialties</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-symptom-specialties-grid',
	'dataProvider'=>$dataProvider,
	'selectableRows'=>0,
	'columns'=>array(
		array(
       		'header'=>'Symptom Code',
       		'value'=>'$data->symptomCode',
       		'name'=>'symptomCode'
        ),
		array(
			'name'=>'Symptom Title',
            'value'=>array($this, 'getSymptomTitle')
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{delete}',
			'buttons'=>array('delete' => array('imageUrl'=>Yii::app()->request->baseUrl.'/images/denyUser.png'))
		),
	),
)); ?>
