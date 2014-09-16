<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Add Specialties',
);


?>

<h1>Create DoctorSymptomSpecialties</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
)); ?>

<?php 
echo $form->dropDownList($symptomsModel, 'symptomCategory',
                                        Yii::app()->Globals->getSymptomCategories(),
                                        array('submit'=>'',
                                              'id'=>'categorySelectDropDown',
                                              'prompt'=>"Select Symptom Category"));  ?>
<?php $this->endWidget(); ?>
</div>


<div class="form">
<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
));  ?>


<?php


	

echo $form->checkboxListGroup($model, 'symptomCode', 
	array(
		'widgetOptions' => array(
			'data' => $symptomsListData,
			'htmlOptions'=> array(
			'template' => '{beginLabel} {labelTitle} <div class="checkBoxRight">{input}</div>{endLabel}',
			)
		),
	'inline'=>true
	)
);
//echo '</div>';
echo "<div class='manageSymptomSpecialtiesButtons'>";
echo CHtml::submitButton('Add Symptom'); 
echo "</div>";
$this->endWidget();
?></div>

