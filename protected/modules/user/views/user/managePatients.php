<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'manage-patients-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
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
		),
	),
)); ?>

