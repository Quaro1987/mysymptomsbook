<?php
/* @var $this SymptomhistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Symptomhistories',
);

$this->menu=array(
	array('label'=>'Create Symptomhistory', 'url'=>array('create')),
	array('label'=>'Manage Symptomhistory', 'url'=>array('admin')),
);
?>

<h1>Symptomhistories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
