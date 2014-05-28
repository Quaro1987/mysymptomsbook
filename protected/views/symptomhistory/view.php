<?php
/* @var $this SymptomhistoryController */
/* @var $model Symptomhistory */

$this->breadcrumbs=array(
	'Symptomhistories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Symptomhistory', 'url'=>array('index')),
	array('label'=>'Create Symptomhistory', 'url'=>array('create')),
	array('label'=>'Update Symptomhistory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Symptomhistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Symptomhistory', 'url'=>array('admin')),
);
?>

<h1>View Symptomhistory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'symptomCode',
		'dateSearched',
		'dateSymptomFirstSeen',
	),
)); ?>
