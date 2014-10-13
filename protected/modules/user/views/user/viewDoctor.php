<!-- small javascript to open this view as a dialog window -->
<script>
$(document).ready(function() {
    $("#dialog").dialog({ width: 500});
}); 
</script>
 

<?php 
echo '<div id="dialog" title="View Doctor User: '.$model->profile->firstname.' '.$model->profile->lastname.'">';



// For all users
	$attributes = array(
			'username',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),

				));
		}
	}
	//pas the rest of the desired column attributes
	array_push($attributes, 'doctorSpecialty');

	echo '<div class="cDetailDoctorView">';
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
	echo '</div>';

	echo '<br/>';
	echo '<h4>Short CV of '.$model->profile->firstname.' '.$model->profile->lastname.'</h4>';
	echo '<div class="cvViewDoctor">';
	echo $model->aboutDoctor;
	echo '</div>';
?>
</div>

