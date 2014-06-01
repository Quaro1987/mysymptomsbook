<!--get user history view -->

<div class="row">
		
		<?php 
		$user_id=Yii::app()->user->id;
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'selectableRows'=>1, //ability to select one symptom at a time
				'dataProvider'=>$model->searchByUser($user_id),
				'htmlOptions'=>array('id'=>'symptomsSearchgrid'),
				'columns'=>array(
					'symptomTitle',
					'dateSearched',
					'dateSymptomFirstSeen',
				),
		)); ?>
		
	</div>