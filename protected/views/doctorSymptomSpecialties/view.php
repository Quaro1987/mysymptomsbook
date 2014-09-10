<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DoctorSymptomSpecialties', 'url'=>array('index')),
	array('label'=>'Create DoctorSymptomSpecialties', 'url'=>array('create')),
	array('label'=>'Update DoctorSymptomSpecialties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DoctorSymptomSpecialties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoctorSymptomSpecialties', 'url'=>array('admin')),
);
?>

<h1>View DoctorSymptomSpecialties #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'doctorUserID',
		'symptomCode',
	),
)); ?>
