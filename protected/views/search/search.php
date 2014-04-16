<?php


$this->pageTitle=Yii::app()->name . ' - Search Symptoms';
$this->breadcrumbs=array(
	'Search Symptoms',
);


?>
<h1>Welcome to the search for symptoms page </h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<h1>Hello</h1>

<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'symptomCategory'); ?>
		<?php echo $form->dropDownList($model,'symptomCategory', search::getSymptomCategories()); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('search'); ?>
	</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->