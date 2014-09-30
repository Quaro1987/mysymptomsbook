<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	'Manage',
);

//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();
?>


<!-- pop up window code -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'symptomHistoryDetailsDialog',
        // Additional JavaScript options for the dialog plugin
        'options'=>array(
                'autoOpen' => false,
                'modal' => true,
                'width' => 350,

        ),
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<h1>Manage Doctor Requests</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-requests-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'header'=>'Last Name',
			'value'=> array($this,'getUserLastName')
		),
		array(
			'header'=>'First Name',
			'value'=> array($this,'getUserFirstName')
		),
            array(
                  'header'=>'Symptom',
                  'type'=>'raw',
                  // gets the symptom history models, with attribute id equel to the symptomHistoryID of the row,
                  // end then shows the title of that s ymptom
                  'value' => 'CHtml::Ajaxlink( 
                        CHtml::encode(Symptomhistory::model()->findByAttributes(array("id"=>$data->symptomHistoryID))->symptomTitle),
                        Yii::app()->createUrl("symptomhistory/ajaxView", array("id"=>$data->symptomHistoryID)),
                        array(
                                "update"=>"#symptomHistoryDetailsDialog"
                              )
                  )',
            ),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{Accept} {Reject}',
			'buttons'=>array(
						'Accept' => array(
            				      'label'=>'Accept User',
                                          'imageUrl'=>Yii::app()->request->baseUrl.'/images/acceptUser.png',
            				      'click'=>"function(){
            				        	$.fn.yiiGridView.update('doctor-requests-grid', {
                        	                        type:'POST',
                        	                        url:$(this).attr('href'),
                        	                        success:function(data) {
                        	                           $.fn.yiiGridView.update('doctor-requests-grid');
                        	                          }
                        	                       })
                        	                       return false;
            				        }",
            				        'url'=>'Yii::app()->controller->createUrl("acceptUser",array("id"=>$data->primaryKey))',
            			      ),
            			      'Reject' => array(
            				      'label'=>'Reject User',
                                          'imageUrl'=>Yii::app()->request->baseUrl.'/images/denyUser.png',
            				      'click'=>"function(){
            				      	$.fn.yiiGridView.update('doctor-requests-grid', {
                        	                      type:'POST',
                        	                      url:$(this).attr('href'),
                        	                      success:function(data) {
                        	                      	$.fn.yiiGridView.update('doctor-requests-grid');
                        	                      }
                        	                  })
                        	                  return false;
            				      }",
            				      'url'=>'Yii::app()->controller->createUrl("rejectUser",array("id"=>$data->primaryKey))',
            			),
		      ),
	     ),
))); ?>
