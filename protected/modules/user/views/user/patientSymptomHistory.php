<?php 

$this->pageTitle=Yii::app()->name . ' - Patient Symptom History';
$this->breadcrumbs=array(
	'Patient Symptom History',
); 

//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();
?>
<h2> <?php echo $this->getUserFirstName($model)." ".$this->getUserLastName($model)."'s Symptom History"; ?> </h2>

<?php
$model2 = new Symptomhistory;
$this->renderPartial('..\..\..\..\views\symptomhistory\_usersHistory',array('model'=>$model2,'id'=>$model->id));
?>