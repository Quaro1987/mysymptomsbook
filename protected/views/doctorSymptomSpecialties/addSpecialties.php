<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Add Specialties',
);
	//side menu
	$this->menu= Yii::app()->Globals->getSidePortletMenu();
?> 

<h3>Add Symptom Specilaties</h3>
<div id='symptomSpecialtiesCategoryDiv'>
<?php $form=$this->beginWidget('CActiveForm', array(
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));
	echo $form->dropDownList($symptomsModel, 'symptomCategory',
                                        Yii::app()->Globals->getSymptomCategories(),
                                        array('submit'=>'',
                                              'id'=>'categorySelectDropDown',
                                              'prompt'=>"Select Symptom Category")
	); 
$this->endWidget(); ?>
</div>
<br/>

<div id='symptomSpecialtiesForm' class="form">
	<?php 
		if($renderPartialTrigger==1)
		{
			$this->renderPartial('_symptomSpecialtiesCheckboxListGroupView', 
									array('model'=>$model, 'symptomsListData' => $symptomsListData)
			);
		}

	?>
</div>

