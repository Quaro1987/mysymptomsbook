<?php
/* @var $this SymptomhistoryController */
/* @var $data Symptomhistory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symptomCode')); ?>:</b>
	<?php echo CHtml::encode($data->symptomCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateSearched')); ?>:</b>
	<?php echo CHtml::encode($data->dateSearched); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateSymptomFirstSeen')); ?>:</b>
	<?php echo CHtml::encode($data->dateSymptomFirstSeen); ?>
	<br />


</div>