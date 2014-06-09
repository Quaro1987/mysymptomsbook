<?php
/* @var $this DiseaseController */
/* @var $model Disease */

$this->breadcrumbs=array(
	'Diseases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Disease', 'url'=>array('index')),
	array('label'=>'Manage Disease', 'url'=>array('admin')),
);
?>

<h1>Create Disease</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>