<?php
/* @var $this DiseaseController */
/* @var $data Disease */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ICD10')); ?>:</b>
	<?php echo CHtml::encode($data->ICD10); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diseaseTitle')); ?>:</b>
	<?php echo CHtml::encode($data->diseaseTitle); ?>
	<br />


</div>