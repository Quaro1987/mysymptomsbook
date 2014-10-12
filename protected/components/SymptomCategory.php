<?php
Yii::import('zii.widgets.CPortlet');
 
 //custom portlet for the rendition of the side menu to choose a symptom category
class SymptomCategory extends CPortlet
{
	//array to be used for showing symptom categories
	public $symptomCategoryArray;

    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('symptomCategory');
    }
}
?>