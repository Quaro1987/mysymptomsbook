<?php
/* @var $this SymptomsController */
/* @var $model Symptoms */

$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Symptoms', 'url'=>array('index')),
	array('label'=>'Create Symptoms', 'url'=>array('create')),
	array('label'=>'View Symptoms', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Symptoms', 'url'=>array('admin')),
);
?>

<h1>Update Symptoms <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>