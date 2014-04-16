<?php
/* @var $this SymptomsController */
/* @var $model Symptoms */

$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Symptoms', 'url'=>array('index')),
	array('label'=>'Create Symptoms', 'url'=>array('create')),
	array('label'=>'Update Symptoms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Symptoms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Symptoms', 'url'=>array('admin')),
);
?>

<h1>View Symptoms #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'symptomCode',
		'title',
		'shortTitle',
		'inclusions',
		'exclusions',
		'symptomCategory',
	),
)); ?>
