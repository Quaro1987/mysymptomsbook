<?php
/* @var $this SymptomsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Symptoms',
);

$this->menu=array(
	array('label'=>'Create Symptoms', 'url'=>array('create')),
	array('label'=>'Manage Symptoms', 'url'=>array('admin')),
);
?>

<h1>Symptoms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
