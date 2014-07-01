<?php
/* @var $this DiseaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Disease Results',
);

?>

<h1>Disease Search Results:</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
