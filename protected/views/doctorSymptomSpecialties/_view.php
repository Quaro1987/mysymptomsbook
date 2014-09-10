<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $data DoctorSymptomSpecialties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctorUserID')); ?>:</b>
	<?php echo CHtml::encode($data->doctorUserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symptomCode')); ?>:</b>
	<?php echo CHtml::encode($data->symptomCode); ?>
	<br />


</div>