<?php
/* @var $this SymptomhistoryController */
/* @var $model Symptomhistory */

$this->breadcrumbs=array(
	'Symptomhistories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Symptomhistory', 'url'=>array('index')),
	array('label'=>'Manage Symptomhistory', 'url'=>array('admin')),
);
?>

<h1>Create Symptomhistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>