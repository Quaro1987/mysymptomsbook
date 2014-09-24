<?php 

$this->pageTitle=Yii::app()->name . ' - Patient Symptom History';
$this->breadcrumbs=array(
	'Patient Symptom History',
); 
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/diagnoseSymptom.js',
        CClientScript::POS_HEAD
    );

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
?>

<h2> <?php echo $patientModel->profile->firstname." ".$patientModel->profile->lastname."'s Symptom History"; ?> </h2>


<?php
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    'themeCssFile'=>'cupertino/theme.css',
    // raw html tags
    'htmlOptions'=>array(
        'style'=>'width:100%',
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
        'events'=>$symptomHistoryEvents, // pass array of events directly
        // event handling
        // click on symptom to get redirected to symptom page and find a doctor for the symptom
        'eventClick'=>'js:function(calEvent, jsEvent, view)
        				{
        					$("#myModalHeader").html(calEvent.title);
        					
        					$.post("'.Yii::app()->createUrl("symptomhistory/diagnoseSymptom").'", 
								 	{ id: calEvent.symptomHistoryID },
								 	function(data)
								 	{
								 		$("#myModalBody").html(data);
								 	}
							);
            				$("#myModal").modal();				
        				}'
        )
	)
);

 ?> 


<?php $this->beginWidget('booster.widgets.TbModal',array('id' => 'myModal')); ?>
     
    <div class="modal-header">
       


    	<a class="close" data-dismiss="modal">&times;</a>
    	<h3 id="myModalHeader">Modal header</h3>
    </div>
     
    <div class="modal-body" id="myModalBody">
    	<p>One fine body...yeah this is a placeholder</p>
    </div>
    

    <div class="modal-footer">
    <?php
    //open contact patient form button
    echo '<div class="buttonLeft">';
    $this->widget(
    'booster.widgets.TbButton',
        array(
            'label'=>'Contact Patient',
            'url'=>'#',
            'htmlOptions'=>array('onclick'=>'revealPatientContactForm()')
        )
    );
    echo '</div>';
    //save changes and close modal button
    $this->widget(
    'booster.widgets.TbButton',
        array(
            'context' => 'primary',
            'label' => 'Save changes',
            'url' => '#',
            'htmlOptions' => array('onclick' => '$("#diagnoseSymptomForm").submit()'),
        )
    );
    // close modal button
    $this->widget(
    'booster.widgets.TbButton',
        array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )
    ); ?>
    </div>

<?php $this->endWidget(); ?>

