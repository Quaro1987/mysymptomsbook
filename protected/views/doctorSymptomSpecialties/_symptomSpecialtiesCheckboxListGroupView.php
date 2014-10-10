<?php

$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id'=>'symptomSpecialtiesForm',
    'type'=>'horizontal',
    'enableClientValidation'=>false,
    'clientOptions' => array(
			'validateOnSubmit' => true
	),
)); 	
echo $form->errorSummary($model);
echo $form->checkboxListGroup($model, 'symptomCode', 
	array(
		'widgetOptions' => array(
			'data' => $symptomsListData,
			'htmlOptions' => array(
						'checkAll'=>'<span class="checkAllBoxLabel">Add all Symptoms in list as Specialties</span>',
						'template' => 
						'{beginLabel}{labelTitle} <div class="checkBoxRight">{input}</div>{endLabel}',
			)		
		),	
	'label'=>'Pick Symptom Specialties:'
	)
);

echo "<div class='manageSymptomSpecialtiesButtons'>";
echo CHtml::submitButton('Add Symptom Specialties'); 
echo "</div>";
$this->endWidget();
?>