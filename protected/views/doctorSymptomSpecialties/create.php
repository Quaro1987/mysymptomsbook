<?php
/* @var $this DoctorSymptomSpecialtiesController */
/* @var $model DoctorSymptomSpecialties */

$this->breadcrumbs=array(
	'Doctor Symptom Specialties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoctorSymptomSpecialties', 'url'=>array('index')),
	array('label'=>'Manage DoctorSymptomSpecialties', 'url'=>array('admin')),
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



<?php $this->renderPartial('_form', array('model'=>$model)); ?>