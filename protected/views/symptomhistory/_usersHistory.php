<!--get user history view -->

<div class="row">
		
		<?php 
		
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'selectableRows'=>1, //ability to select one symptom at a time
				'dataProvider'=>$model->searchByUser($id),
				'htmlOptions'=>array('id'=>'symptomsSearchgrid'),
				'columns'=>array(
					'symptomTitle',
					'dateSearched',
					'dateSymptomFirstSeen',
				),
		)); ?>
		
	</div>