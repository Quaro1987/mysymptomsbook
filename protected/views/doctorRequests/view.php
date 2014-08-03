<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DoctorRequests', 'url'=>array('index')),
	array('label'=>'Create DoctorRequests', 'url'=>array('create')),
	array('label'=>'Update DoctorRequests', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DoctorRequests', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoctorRequests', 'url'=>array('admin')),
);
?>

<h1>View DoctorRequests #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'doctorID',
		'userID',
	),
)); ?>
