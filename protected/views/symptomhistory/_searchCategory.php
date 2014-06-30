

<div class="wide form">

<div class="row">
    
    
    <?php 
    	echo	CHtml::dropDownList('symptomCategory', 'symptomCategory',
                                             $this->getSymptomCategories(),
                                            array('id'=>'categorySelectDropDown',
                                                  'prompt'=>"Select Symptom Category",  
                                            		  //'ajaxUpdate' => 'childView' vlepoume gi ayto
                                                  'ajax'=> array(
                                            					'type'=>'POST',
                                            					'url'=>Yii::app()->createUrl('symptomhistory/search'),
                                            					'update'=>'#symptomSelectDiv',
                                            					'data'=>array('symptomCategory'=>'js:this.value', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken))                                                                            
                                                  ));

                                              
    ?>

</div>
 



</div> <!-- end search form --> 