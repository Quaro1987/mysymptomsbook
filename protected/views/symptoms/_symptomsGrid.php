
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get', 
)); ?>
	<!-- form is automatically submitted when dropdown selection changes -->
	<div class="row">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'selectableRows'=>1, //ability to select one symptom at a time
				'dataProvider'=>$model->search(),
				'htmlOptions'=>array('id'=>'MyID'),
				'columns'=>array(
					'symptomCode',
					'title',
					'inclusions',
					'exclusions',
					'symptomCategory',
		
				),
		)); ?>
		
	</div>


<?php $this->endWidget(); ?>