<!--get user history view -->
<div> <h2><?php echo CHtml::encode(Yii::app()->user->username); ?>'s Symptom History.</h2> </div>
<div class="row">
		
<?php 

//side menu
$this->menu=array(
	array(
			'label'=>'Add Symptom', 
			'url'=>array('/symptomhistory/addSymptom'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Find a Doctor', 
			'url'=>array('/doctorRequests/addDoctor'),
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
);

		
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'symptoms-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'symptomTitle',
			'dateSearched',
			'dateSymptomFirstSeen',
		),
)); ?>
		
	</div>