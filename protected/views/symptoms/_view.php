<?php
/* @var $this SymptomsController */
/* @var $data Symptoms */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symptomCode')); ?>:</b>
	<?php echo CHtml::encode($data->symptomCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shortTitle')); ?>:</b>
	<?php echo CHtml::encode($data->shortTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inclusions')); ?>:</b>
	<?php echo CHtml::encode($data->inclusions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exclusions')); ?>:</b>
	<?php echo CHtml::encode($data->exclusions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symptomCategory')); ?>:</b>
	<?php echo CHtml::encode($data->symptomCategory); ?>
	<br />


</div>