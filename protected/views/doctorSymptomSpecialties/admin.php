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

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#doctor-symptom-specialties-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Symptom Specialties</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-symptom-specialties-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'doctorUserID',
		'symptomCode',
		array(
			'name'=>'Symptom Title',
            'value'=>Symptoms::model()->findByPk($data->symptomCode)->symptomTitle,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
