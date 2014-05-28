<?php
/* @var $this SymptomsController */
/* @var $model Symptoms */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptoms-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'symptomCode'); ?>
		<?php echo $form->textField($model,'symptomCode',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'symptomCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shortTitle'); ?>
		<?php echo $form->textField($model,'shortTitle',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'shortTitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inclusions'); ?>
		<?php echo $form->textField($model,'inclusions',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'inclusions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exclusions'); ?>
		<?php echo $form->textField($model,'exclusions',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'exclusions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symptomCategory'); ?>
		<?php echo $form->textField($model,'symptomCategory',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'symptomCategory'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->