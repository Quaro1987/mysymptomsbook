<!--get user history view -->
<div> <h2><?php echo CHtml::encode(Yii::app()->user->username); ?> user's Symptom History.</h2> </div>
<div class="row">
		
		<?php 
		
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'filter'=>$model,
				'dataProvider'=>$dataProvider,
				'columns'=>array(
					'symptomTitle',
					'dateSearched',
					'dateSymptomFirstSeen',
				),
		)); ?>
		
	</div>