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

//side menu
$this->menu=array(
	array(
			'label'=>'Add Symptom', 
			'url'=>array('/symptomhistory/addSymptom'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Manage User Requests', 
			'url'=>array('doctorRequests/manageRequests'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
	array(
			'label'=>'Check Patient Symptom History', 
			'url'=>array('/user/user/managePatients'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
); ?>

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
		/*  code linking to a doctor's profile, for use if we need to add a link to
		each doctor's profile from the search function in the future 
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		*/
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