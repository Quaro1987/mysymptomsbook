<?php
/* @var $this DiseaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Disease Results',
);

?>

<h1>Disease Search Results:</h1>

<?php 

	if($resultsExist==true)
	{
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		));
	}
	else
	{
		echo '</br>';
		echo '<b>We\'re sorry, but no diseases exist with those symptoms.</b>';	 
	} ?>
