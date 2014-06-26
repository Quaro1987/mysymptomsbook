<?php
/*
	dropdown select search form for symptom category
*/  ?>

<div class="wide form">

<?php 
		 ?>
	<!-- form is automatically submitted when dropdown selection changes -->

<!-- form is automatically submitted when dropdown selection changes -->
<div class="row">
    
    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptomCategory-form',
	'enableAjaxValidation'=>false,	
)); 
 
    	echo	$form->dropDownList($model,
                    					'symptomCategory',
                                             $this->getSymptomCategories(),
                                            array('submit'=>'',
                                                  'id'=>'categorySelectDropDown',
                                                  'prompt'=>"Select Symptom Category"                                                  
                                                  ));

                                                  ?>
<?php $this->endWidget(); ?>
</div>
<div class="row" id="symptomSelectDiv" >

		<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'symptoms-grid',
				'ajaxUrl'=>array('symptoms/admin'),
				'selectableRows'=>1, //ability to select one symptom at a time
				'dataProvider'=>$model->searchCategory(),
				'columns'=>array(
					'symptomCode',
					'title',
					'inclusions',
					'exclusions',
					'symptomCategory',
		
				),
				'htmlOptions'=>array('id'=>'symptomsSelectGrid'),
		)); ?>
		


	
		</div>
 



</div> <!-- end search form --> 