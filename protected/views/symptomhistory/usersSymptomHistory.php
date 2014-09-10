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

		
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
    // raw html tags
    'htmlOptions'=>array(
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev',
            'center'=>'title',
            'right'=>'next'
        ),
        'lazyFetching'=>true,
        'events'=>$symptomHistoryEvents // pass array of events directly
        // event handling
        // mouseover for example
        //'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
    )
)); ?>
		
	</div>