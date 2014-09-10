<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DoctorSymptomSpecialties', 'url'=>array('index')),
	array('label'=>'Create DoctorSymptomSpecialties', 'url'=>array('create')),
	array('label'=>'View DoctorSymptomSpecialties', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DoctorSymptomSpecialties', 'url'=>array('admin')),
);
?>

<h1>Update DoctorSymptomSpecialties <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>