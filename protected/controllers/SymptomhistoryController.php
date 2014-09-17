<?php

class SymptomhistoryController extends Controller
{
	//public variables of controller
	//array with all symptom categories
	public $symptomCategories = array(
		 				'Blood, immune sytem',
		 				'Circulatory',
		 				'Digestive',
		 				'Ear, Hearing',
		 				'Eye',
		 				'Female genital',
		 				'General',
		 				'Male genital',
		 				'Metabolic, endocrine',
		 				'Musculoskeletal',
		 				'Neurological',
		 				'Psychological',
		 				'Respiratory',
		 				'Skin',
		 				'Social problems',
		 				'Urological',
		 				'Women\'s health, pregnancy'
		 			  );
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
			array('allow', // allow authenticated user to perform 'create', view, and 'update' actions
				'actions'=>array('addSymptom', 'successPage', 'update', 'index','view', 'userHistory', 'usersSymptomHistory'),
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
	public function actionAddSymptom()
	{
		//load custom layout for this view
		$this->layout='//layouts/triplets';
		$model = new Symptomhistory;
		$symptomsModel = new Symptoms;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Symptomhistory']))
		{	
				//populate symptom search model attributes with user id, current date, and form input
				$model->setAttributes(array(
									'user_id'=>Yii::app()->user->id,
									'dateSearched'=>date('Y-m-d'),
									'symptomCode'=>$_POST['Symptomhistory']['symptomCode'],
									'dateSymptomFirstSeen'=>$_POST['Symptomhistory']['dateSymptomFirstSeen'],
									'symptomTitle'=>$_POST['Symptomhistory']['symptomTitle'],
									 ));
				//save search history
				$model->save();
				$this->redirect(array('usersSymptomHistory'));
				
		}
		//used to update symptoms grid with ajax call
		if(isset($_GET['Symptoms'])) 
		{
			$symptomsModel->attributes=$_GET['Symptoms'];
		}	
		//render search view
		$this->render('addSymptom',array('model'=>$model,'symptomsModel'=>$symptomsModel));
		

	}

	/* action that renders the symptom successfully added paged */
	public function actionSuccessPage()
	{
		$this->render('successPage');
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
	
	//return user symptom history (based on id)
	public function actionUserHistory($id)
	{
		$model = new Symptomhistory;
		$dataProvider = $model->searchByUser($id);
		$this->render('userHistory',array('dataProvider'=>$dataProvider,
		));
	}

	//return current user's symptom history
	public function actionUsersSymptomHistory()
	{
		$model = new Symptomhistory;
		$symptomUrl = Yii::app()->createUrl('doctorRequests/findDoctor');
		//empty array to store all the user's symptoms
		$symptomItems = array();
		//set the model's user_id to the one of the current user
		$model->user_id = Yii::app()->user->id;
		//loop through all the symptomHistory records that belong to the user
		foreach($model->findAll() as $symptom)
		{
			$symptomItem=array('title'=>$symptom->symptomTitle,
								'start'=>$symptom->dateSymptomFirstSeen,
								'end'=>$symptom->dateSearched,
								'symptomCode'=>$symptom->symptomCode
			);
			//copy symptomHistory record into array
			array_push($symptomItems, $symptomItem);
		}

		if(isset($_POST['symptomCategory']))
		{

		}
		//pass array with user's symptoms to the view
		$this->render('usersSymptomHistory',array('symptomHistoryEvents'=>$symptomItems, 'symptomUrl'=>$symptomUrl));
	}
}
