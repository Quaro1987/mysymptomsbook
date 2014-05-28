<?php
/* @var $this SymptomsController */
/* @var $model Symptoms */

$this->breadcrumbs=array(
	'Symptoms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Symptoms', 'url'=>array('index')),
	array('label'=>'Manage Symptoms', 'url'=>array('admin')),
);
?>

<h1>Create Symptoms</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>