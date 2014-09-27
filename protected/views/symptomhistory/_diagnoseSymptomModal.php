<?php
// 
?>

<div class="form">


<?php
	echo '<div class="row">';
	echo '<h4>Previous Doctor diagnosis: ';
	//switch check if there is a previous diagnosis and present it to the doctor
	switch ($symptomHistoryModel->symptomFlag)
	{
		case '1':
			echo '<span  class="lowDiagnosis">Low Danger</span></h4>';
			break;
		case '2':
			echo '<span  class="mildDiagnosis">Mild Danger</span></h4>';
			break;
		case '3':
			echo '<span  class="highDiagnosis">High Danger</span></h4>';
			break;
		default:
			echo '<span class="noDiagnosis">No diagnosis yet</span></h4>';
	}
	echo '<div class="row">';
	echo '<br/>';
	echo '<h5><b>Select diagnosis: </b></h5>';
	//widget for buttons to select symptom danger
	$this->widget('booster.widgets.TbButtonGroup',array(
	   	'buttons' => array(
	   		array('label' => 'Low Danger',  'htmlOptions'=>array('id' => 'lowDangerButton', 'onClick'=>'lowFlagSelected()')),
	   		array('label' => 'Mild Danger', 'htmlOptions'=>array('id' => 'mildDangerButton', 'onClick'=>'mildFlagSelected()')),
	   		array('label' => 'High Danger', 'htmlOptions'=>array('id' => 'highDangerButton', 'onClick'=>'highFlagSelected()'))
	   		),
	   	)
	); 
	echo '</div>'; 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'diagnoseSymptomForm',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); 
		//textfield input for symptom flag
		echo $form->hiddenfield($symptomHistoryModel, 'symptomFlag', array('id'=>'symptomFlagTextField'));
		echo $form->hiddenfield($symptomHistoryModel, 'id', array('value'=>$symptomHistoryModel->id));
		
		
	$this->endWidget(); 

	echo '<div id="contactPatientDiv" class="form hiddenDiv">';
	echo '<hr style="height=1px; color=#e5e5e5"/>';
	echo '<h4>Contact Patient Form</h4>';
	//contact patient form
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'contactPatientform',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>true,
		'clientOptions'=>array('validateOnSubmit'=>true,
								'validateOnChange'=>true,
      							'validateOnType'=>false,)
	)); 
		echo '<p class="note">Fields with <span class="required">*</span> are required.</p>';
			echo $form->errorSummary($contactFormModel); 
		//input subject
		echo '<div class="row">';
			echo $form->labelEx($contactFormModel,'subject');
			echo $form->textField($contactFormModel,'subject',array('id'=>'emailSubjectField', 'size'=>60,'maxlength'=>128));
			echo $form->error($contactFormModel,'subject');
		echo '</div>';
		//input message body
		echo '<div class="row">';
			echo $form->labelEx($contactFormModel,'body');
			echo $form->textArea($contactFormModel,'body',array('id'=>'emailBodyTextArea', 'rows'=>6, 'cols'=>57));
			echo $form->error($contactFormModel,'body');
		echo '</div>';

		//hidden input fields
		echo $form->hiddenfield($contactFormModel, 'patientEmail', array('value'=>$patientModel->email));
		//contact patient input buttons
		echo '<div class="row rememberMe">';
		echo $form->label($contactFormModel,'sendSMS');
		echo $form->checkBox($contactFormModel, 'sendSMS');
    	echo '</div>';
    	echo '<div class="row">';
		$this->widget(
    	'booster.widgets.TbButton',
    	    array(
    	        'context' => 'primary',
    	        'label' => 'Send Message',
    	        'url' => '#',
    	        'htmlOptions' => array('onclick' => 
    	        	'ajaxSubmitContactForm("'.Yii::app()->createUrl('symptomhistory/ajaxContactPatient').'")'),
    	    )
    	);
    	echo '</div>';

    	
		
		
	$this->endWidget(); 

	echo '</div>';
	
?>

</div><!-- form -->

