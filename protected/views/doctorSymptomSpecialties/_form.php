<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-symptom-specialties-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doctorUserID'); ?>
		<?php echo $form->textField($model,'doctorUserID'); ?>
		<?php echo $form->error($model,'doctorUserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symptomCode'); ?>
		<?php echo $form->textField($model,'symptomCode',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'symptomCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->