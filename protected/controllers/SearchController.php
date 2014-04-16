<?php

class SearchController extends Controller
{

	public $defaultAction = 'search';

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'search' action
				'actions'=>array('search'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	//Displays the Search Symptoms page
	public function actionSearch()
	{
		$model=new SearchForm;

		//collect user input data
		if(isset($_POST['SearchForm']))
		{
			$model->attributes=$_POST['SearchForm'];

			if($model->validate())
			{
            
            $this->redirect(Yii::app()->user->returnUrl);

        	}
		}

		//render search form
		$this->render('search',array('model'=>$model));
	} 

	//returns symptom categories that the user can choose to pick a symptom
	public static function getSymptomCategories()
	{
		return CHtml::listData(Yii::app()->db->createCommand()->select('category')->from('tbl_symptomcategory')->queryAll());
	}


}

?>