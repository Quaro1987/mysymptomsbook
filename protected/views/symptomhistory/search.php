<?php
$this->pageTitle=Yii::app()->name . ' - Search Symptoms';
$this->breadcrumbs=array(
	'Search Symptoms',
); ?>
<?php
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/mSBscripts.js',
        CClientScript::POS_END
	);


?>
<h1>Welcome to the search for symptoms page</h1>



<p class="note"></p>
	<!-- Select symptom category dropdown menu -->
<div class="search-form">
			
	<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

 	<?php echo $form->label($symptomsModel,'symptomCategory'); ?>
    <?php echo $form->dropDownList($symptomsModel, 'symptomCategory',
                                            $this->getSymptomCategories(),
                                            array('submit'=>'',
                                                  'id'=>'categorySelectDropDown',
                                                  'prompt'=>"Select Symptom Category")); ?>
<?php $this->endWidget(); ?>
</div>

		
<div class="row" id="symptomSelectDiv" >
		
	<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'symptoms-grid',
		'selectableRows'=>1, //ability to select one symptom at a time
		'dataProvider'=>$symptomsModel->searchCategory(),
		'columns'=>array(
			'symptomCode',
			'title',
			'inclusions',
			'exclusions',
			'symptomCategory',		
		)
)); ?>
 
	 
</div>

	

	<div class="row buttons">
		<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptomhistory-form',
	'enableAjaxValidation'=>false,	
)); ?>

		<?php echo $form->errorSummary($model); ?>
		<br/>
		<?php echo $form->textField($model,'symptomCode', array('id'=>'symptomToBeSearchedCode')); ?>
		<?php echo $form->error($model,'symptomCode'); ?>
		<br/>
		<?php echo $form->textField($model,'symptomTitle', array('id'=>'symptomToBeSearchedTitle')); ?>
		<?php echo $form->error($model,'symptomTitle'); ?>
		<br/>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				'model'=>$model,
				'attribute'=>'dateSymptomFirstSeen',
				'id'=>'dateSymptomSeen',
    			'options'=>array(
       	 						'showAnim'=>'fold',
       	 						'dateFormat'=>'yy-mm-dd', //date format set to be compatible with database
    						),
  				'htmlOptions'=>array(	
       							'style'=>'height:20px;'
    						),
		)); ?>
		<?php echo $form->error($model,'dateSymptomFirstSeen'); ?>
		<?php echo CHtml::Button('Search Symptom(s)', array('id'=>'search'));  ?>
		<?php echo CHtml::Button('Add Another Symptom to Search', array('id'=>'addSymptom'));  ?>
	</div>


<div>
<table id="symptomTable"><tr><td></td></tr></table>
</div>
<?php $this->endWidget(); ?>
</div>  <!-- end of form -->