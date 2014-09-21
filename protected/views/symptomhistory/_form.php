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

	<?php
	
	echo $symptomHistoryModel->id;
	$this->widget('booster.widgets.TbButtonGroup',array(
			'context' => 'primary',
			'toggle' => 'radio',
    		'buttons' => array(
    			array('label' => 'Low Danger', 'url' => '#'),
    			array('label' => 'Mild Danger', 'url' => '#'),
    			array('label' => 'High Danger', 'url' => '#')
    	),
    	)
    ); 

	$this->endWidget(); ?>

</div><!-- form -->

