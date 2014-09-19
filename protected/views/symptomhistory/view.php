<script>
$(document).ready(function() {
    $("#dialog").dialog({ width: 500 });
}); 
</script>

<?php
echo '<div id="dialog" title="placeholder">';


 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'symptomCode',
		'dateSearched',
		'dateSymptomFirstSeen',
	),
)); ?>
</div>