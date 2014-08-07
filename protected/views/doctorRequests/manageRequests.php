<?php
/* @var $this DoctorRequestsController */
/* @var $model DoctorRequests */

$this->breadcrumbs=array(
	'Doctor Requests'=>array('index'),
	'Manage',
);

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
			'class'=>'CButtonColumn',
			'template'=>'{Accept},{Reject}',
			'buttons'=>array(
						'Accept' => array(
            				      'label'=>'Accept User',
            				      //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
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
            				      //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
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
