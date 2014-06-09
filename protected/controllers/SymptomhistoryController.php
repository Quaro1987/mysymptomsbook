<?php

class SymptomhistoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('search','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSearch()
	{
		$model=new Symptomhistory;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['Symptomhistory']))
		{
			//set attributes for symptom search with user id, current date, and form input
			$model->setAttributes(array(
									'user_id'=>Yii::app()->user->id,
									'dateSearched'=>date('Y-m-d'),
									'symptomCode'=>$_POST['Symptomhistory']['symptomCode'],
									'dateSymptomFirstSeen'=>$_POST['Symptomhistory']['dateSymptomFirstSeen'],
									'symptomTitle'=>$_POST['Symptomhistory']['symptomTitle'],
									 ));
			
			if($model->save())
			{
				
				$this->redirect(array('disease/index', 'symptomCode'=>$_POST['Symptomhistory']['symptomCode'])); 
			}
		}

		$this->render('search',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Symptomhistory']))
		{
			$model->attributes=$_POST['Symptomhistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Symptomhistory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Symptomhistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Symptomhistory']))
			$model->attributes=$_GET['Symptomhistory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Symptomhistory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Symptomhistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Symptomhistory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='symptomhistory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	//returns symptom categories that the user can choose to pick a symptom
	public static function getSymptomCategories()
	{
		 return array(
		 				'Blood, immune sytem' => 'Blood, immune sytem',
		 				'Circulatory' => 'Circulatory',
		 				'Digestive' => 'Digestive',
		 				'Ear, Hearing' => 'Ear, Hearing',
		 				'Eye' => 'Eye',
		 				'Female genital' => 'Female genital',
		 				'General' => 'General',
		 				'Male genital' => 'Male genital',
		 				'Metabolic, endocrine' => 'Metabolic, endocrine',
		 				'Musculoskeletal' => 'Musculoskeletal',
		 				'Neurological' => 'Neurological',
		 				'Psychological' => 'Psychological',
		 				'Respiratory' => 'Respiratory',
		 				'Skin' => 'Skin',
		 				'Social problems' => 'Social problems',
		 				'Urological' => 'Urological',
		 				'Women\'s health, pregnancy' => 'Women\'s health, pregnancy'
		 			  );
	}

	public function loadGrid()
	{

		$model=new Symptoms('search');

		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Symptoms']))
			$model->attributes=$_GET['Symptoms'];

			$this->render('search',array(
			'model'=>$model,
		));
	}
}
