<?php
/*
	dropdown select search form for symptom category
*/  ?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get', 
)); ?>
	<!-- form is automatically submitted when dropdown selection changes -->
	<div class="row">
		<?php echo $form->label($model,'symptomCategory'); ?>
		<?php echo $form->dropDownList($model, 'symptomCategory',
												$this->getSymptomCategories(),
												array('submit'=>'',
													  'id'=>'categorySelectDropDown',
													  'prompt'=>"Select Symptom Category")); ?>
		
	</div>


<?php $this->endWidget(); ?>

</div> <!-- end search form -->