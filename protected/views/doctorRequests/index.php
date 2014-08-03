<?php
/* @var $this DoctorRequestsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Requests',
);

$this->menu=array(
	array('label'=>'Create DoctorRequests', 'url'=>array('create')),
	array('label'=>'Manage DoctorRequests', 'url'=>array('admin')),
);
?>

<h1>Doctor Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
