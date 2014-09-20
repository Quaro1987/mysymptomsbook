<!-- view symptom history -->

<script>
$(document).ready(function() {
    $("#dialog").dialog({ width: 500 });
}); 
</script>

<?php
$userModel = User::model()->findByAttributes(array("id"=>$model->user_id));
echo '<div id="dialog" title="'.$userModel->profile->firstname.' '.$userModel->profile->firstname.'\'s Symptom">';


 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'symptomCode',
		'symptomTitle',
		'dateSearched',
		'dateSymptomFirstSeen',
	),
)); ?>


</div>