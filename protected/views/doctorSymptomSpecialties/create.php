<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoctorSymptomSpecialties', 'url'=>array('index')),
	array('label'=>'Manage DoctorSymptomSpecialties', 'url'=>array('admin')),
);
?>

<h1>Create DoctorSymptomSpecialties</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>