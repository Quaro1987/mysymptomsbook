<!-- page to display the success message for the successfully added symptom to the symptom history of the user -->

<?php
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/mSBscripts.js',
        CClientScript::POS_END
);
//load jquery
Yii::app()->clientScript->registerCoreScript('jquery');
?>



<div>
	<h>Symptom Succesfully added to your personal Symptom History.</h1>
</div>
<div class="row buttons">
	<?php echo CHtml::button('Add Another Symptom', array('class'=>'addSymptomRedirectButton', 'id'=>"redirectToAddSymptomsPageButton")); ?>
</div>