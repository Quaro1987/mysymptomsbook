<?php
/* @var $this SymptomhistoryController */
/* @var $model Symptomhistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptomhistory-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symptomCode'); ?>
		<?php echo $form->textField($model,'symptomCode',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'symptomCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateSearched'); ?>
		<?php echo $form->textField($model,'dateSearched'); ?>
		<?php echo $form->error($model,'dateSearched'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateSymptomFirstSeen'); ?>
		<?php echo $form->textField($model,'dateSymptomFirstSeen'); ?>
		<?php echo $form->error($model,'dateSymptomFirstSeen'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->