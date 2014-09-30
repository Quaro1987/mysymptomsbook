<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */
$this->pageTitle=Yii::app()->name . ' - Find A Doctor';
$this->breadcrumbs=array(
	'Find A Doctor',
); 

//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/addDoctorJS.js',
        CClientScript::POS_END
	);
//alert user if a doctor has been added succesfully
if(isset($_GET['doctorAdded'])&&$_GET['doctorAdded']==1)
{
	Yii::app()->clientScript->registerScript('alert',
		"$(document).ready(function(){
			alert('Doctor Added');
		});");
}

//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu(); ?>

<h1>Symptom <?php echo $symptomsModel->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$symptomsModel,
	'attributes'=>array(
		'symptomCode',
		'title',
		'inclusions',
		'exclusions',
		'symptomCategory',
	),
)); ?>
<br/>
<br/>
<h3>Doctors who specialize in <?php echo $symptomsModel->title; ?>:</h3>


<div id="chooseDoctorDiv">
<?php 
	
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctors-grid',
	'selectableRows'=>1,
	'dataProvider'=>$dataProvider,
	'rowHtmlOptionsExpression'=>'array("data-id"=>$data->id)',
	'columns'=>array(
		array(
			'name' => 'Last Name',
			'type'=>'raw',
			'value' => 'CHtml::Ajaxlink(
				CHtml::encode($data->profile->lastname),
				Yii::app()->createUrl("user/user/ajaxViewDoctorDialog", array("id"=>$data->id)),
				array(
					  "update"=>"#doctorDetailsDialog"
					)
			)',
		),
		array(
			'name' => 'First Name',
			'value' => '$data->profile->firstname',
		),
		array(
			'name' => 'Specialty',
			'value' => '$data->doctorSpecialty',
		),
	),
));



 ?>
</div>

<!-- pop up window code -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'doctorDetailsDialog',
        // Additional JavaScript options for the dialog plugin
        'options'=>array(
                'autoOpen' => false,
                'modal' => true,
                'width' => 350,

        ),
));


$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-requests-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'doctorID', array('id'=>'doctorIDTextfield')); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Add Doctor'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

