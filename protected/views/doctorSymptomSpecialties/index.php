<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties',
);

$this->menu=array(
	array('label'=>'Create DoctorSymptomSpecialties', 'url'=>array('create')),
	array('label'=>'Manage DoctorSymptomSpecialties', 'url'=>array('admin')),
);
?>

<h1>Doctor Symptom Specialties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
