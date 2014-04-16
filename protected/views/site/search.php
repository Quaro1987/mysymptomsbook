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
	<!-- Select symptom category dropdown menu -->
	<div class="row">
		<?php echo $form->labelEx($model,'symptomCategory'); ?>
		<?php echo $form->dropDownList($model,'symptomCategory', $this->getSymptomCategories(), 
		array('prompt'=>'Select Symptom Category', 
		'ajax'=> array('type'=>'POST',
		'url'=>CController::createUrl('loadSymptoms'),
		'update'=>'#symptoms',
		'data'=>array('symptomCategory'=>'js:this.value', 
		'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),))); ?>
	</div>
	<!-- select symptom -->
	<div class="row">
	<?php // echo CHtml::dropDownList('symptoms', 'selectedSymptom', array(), array('prompt'=>'Select Symptom'));?>
	</div>
	<div class="row">
	<?php 
	$dataProvider=new CActiveDataProvider('symptoms', array(
    'criteria'=>array(
    'condition'=>'symptomCategory=js:this.value',
        'order'=>'title DESC')));

	 $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,));

    ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->