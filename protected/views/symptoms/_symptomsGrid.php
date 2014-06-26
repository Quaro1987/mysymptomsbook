
<div class="wide form">


	<!-- form is automatically submitted when dropdown selection changes -->
	<div class="row">
		aaaaaaabbbbbbbbbbaaaaaaaaaaaaaaaaaa
		<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'selectableRows'=>1, //ability to select one symptom at a time
				'dataProvider'=>Symptoms::model()->searchCategory(),
				//'htmlOptions'=>array('id'=>'symptomsSelectGrid'),
				'columns'=>array(
					'symptomCode',
					'title',
					'inclusions',
					'exclusions',
					'symptomCategory',
		
				),
		)); ?>
		
	</div>


