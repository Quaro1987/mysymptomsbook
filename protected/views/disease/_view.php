<?php
/* @var $this DiseaseController */
/* @var $data Disease */
?>

<div class="view">


	<b><?php echo CHtml::encode($data->getAttributeLabel('diseaseTitle')); ?>:</b>
	<?php echo CHtml::encode($data->diseaseTitle); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('ICD10')); ?>:</b>
	<?php echo CHtml::encode($data->ICD10); ?>

	<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('ICD10')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ICD10), array('view', 'id'=>$data->id)); ?>
	<br /> -->

	


</div>