<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	'Create',
);



//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/mSBscripts.js',
        CClientScript::POS_END
	);
?>

<h1>Create DoctorRequests</h1>
<div id="chooseDoctorDiv">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctors-grid',
	'selectableRows'=>1,
	'dataProvider'=>$dataProvider,
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
			'value' => 'CHtml::link(CHtml::encode($data->profile->lastname),array("user/user/viewDoctor","id"=>$data->id))',
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
)); ?>
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-requests-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doctorID'); ?>
		<?php echo $form->textField($model,'doctorID', array('id'=>'doctorIDTextfield')); ?>
		<?php echo $form->error($model,'doctorID'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Add Doctor'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->