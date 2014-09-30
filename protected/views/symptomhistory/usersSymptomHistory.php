<?php 

$this->pageTitle=Yii::app()->name . ' - Your Symptom History';
$this->breadcrumbs=array(
    'Your Symptom History',
);  ?>

<!--get user history view -->
<div> <h3>Click on a Symptom to find a Doctor for that Symptom.</h3> </div>
<div class="row">

		
<?php 


//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();

		
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
        'eventClick'=> ("js:function(calEvent, jsEvent, view) 
        					{
        						window.location = ('$symptomUrl' + '&symptomCode=' + calEvent.symptomCode);
    						}"
    					)
        )
	)
); ?>
		
</div>