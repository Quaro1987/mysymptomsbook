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
    
    
    <?php 
    	echo	CHtml::dropDownList('symptomCategory', 'symptomCategory',
                                             $this->getSymptomCategories(),
                                            array('id'=>'categorySelectDropDown',
                                                  'prompt'=>"Select Symptom Category",  
                                            		  'ajax'=> array(
                                            					'type'=>'POST',
                                            					'url'=>Yii::app()->createUrl('symptomhistory/updateSymptomsGridView'),
                                            					'update'=>'#symptoms-grid',
                                            					'data'=>array('symptomCategory'=>'js:this.value', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken))                                                                            
                                                  ));

                                                  ?>

</div>
 



</div> <!-- end search form --> 