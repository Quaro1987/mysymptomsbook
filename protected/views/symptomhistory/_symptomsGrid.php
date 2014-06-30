<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'symptoms-grid',
		'selectableRows'=>1, //ability to select one symptom at a time
		'dataProvider'=>$model->searchCategory(),
		'columns'=>array(
			'symptomCode',
			'title',
			'inclusions',
			'exclusions',
			'symptomCategory',		
		)
)); ?>