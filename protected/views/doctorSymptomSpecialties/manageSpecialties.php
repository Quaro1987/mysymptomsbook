<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Manage Symptom Specialties',
);

$this->menu=array(
	array('label'=>'List DoctorSymptomSpecialties', 'url'=>array('index')),
	array('label'=>'Create DoctorSymptomSpecialties', 'url'=>array('create')),
);

?>

<h1>Manage Symptom Specialties</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-symptom-specialties-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'symptomCode',
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
