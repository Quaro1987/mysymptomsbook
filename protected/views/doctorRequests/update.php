<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DoctorRequests', 'url'=>array('index')),
	array('label'=>'Create DoctorRequests', 'url'=>array('create')),
	array('label'=>'View DoctorRequests', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DoctorRequests', 'url'=>array('admin')),
);
?>

<h1>Update DoctorRequests <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>