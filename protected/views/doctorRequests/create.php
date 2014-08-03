<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoctorRequests', 'url'=>array('index')),
	array('label'=>'Manage DoctorRequests', 'url'=>array('admin')),
);
?>

<?php
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/mSBscripts.js',
        CClientScript::POS_END
	);
?>

<h1>Create DoctorRequests</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctors-grid',
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
			'value' => '$data->profile->lastname',
		),
		array(
			'name' => 'First Name',
			'value' => '$data->profile->firstname',
		),
		array(
			'name' => 'Specialty',
			'value' => '$data->doctorSpecialty',
		),
		array(
		    'class'=>'CButtonColumn',
		    'template'=>'{AddDoctor}',
		    'buttons'=>array(
    	    	'AddDoctor' => array(
    	    	    'label'=>'Add Doctor',
    	    	    'imageUrl'=>Yii::app()->request->baseUrl.'/images/add.png',
    	    	    'click'=>"function(){
    	    	    					var doctorID = $.fn.yiiGridView.getSelection('doctors-grid');
										alert(doctorID);
    	    	    }"
    	    	),
    	    ),
		),
	),
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>