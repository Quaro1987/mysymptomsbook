<?php

class DoctorSymptomSpecialtiesController extends Controller
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
			array('booster.filters.BoosterFilter - delete') 
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
				'actions'=>array('addSpecialties', 'update', 'manageSpecialties','delete'),
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

	/*
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
	public function actionAddSpecialties()
	{
		//models used in the action
		$symptomsModel = new Symptoms;
		$model=new DoctorSymptomSpecialties;
		$renderPartialTrigger = 0;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//if a psot request is made by the form execute this code
		if(isset($_POST['DoctorSymptomSpecialties']))
		{
			//loop through all of the selected symptoms
			foreach($_POST['DoctorSymptomSpecialties']['symptomCode'] as $symptomCode)
			{
			//create temporary model
			$DSSTempModel = new DoctorSymptomSpecialties;
			//set attributes to temp model
			$DSSTempModel->setAttributes(array(
										'doctorUserID' => Yii::app()->user->id,
										'symptomCode' => $symptomCode
										)
			);
			//save model
			$DSSTempModel->save();
			}
			//after 
			$this->redirect(array('manageSpecialties'));
		}

		//used to update symptoms checkboxlist with ajax call
		if(isset($_GET['Symptoms'])) 
		{
			$symptomsModel->attributes=$_GET['Symptoms'];
			$renderPartialTrigger = 1;
		}
		//get symptoms with selected category
		$symptomsWithSelectedCategory = Yii::app()->db->createCommand()
					->select('symptomCode')
    				->from('tbl_symptoms')
    				->where('symptomCategory=:symptomCategory', 
    					array(':symptomCategory'=>$symptomsModel->symptomCategory))
    				->queryAll();
    	//pass the returned symptoms to an array
    	foreach ($symptomsWithSelectedCategory as $symCat) 
		{
			$symptomsWithSelectedCategoryArray[] = $symCat['symptomCode'];
		}
		//query builder to get symptom specialties the user has already added
		$alreadyAddedSymptomSpecialties = Yii::app()->db->createCommand()
					->select('symptomCode')
    				->from('tbl_doctor_symptom_specialties')
    				->where('doctorUserID=:doctorUserID', array(':doctorUserID'=>Yii::app()->user->id))
    				->queryAll();

    	//copy query results into alreadyAddedDoctorIDArray
		foreach ($alreadyAddedSymptomSpecialties as $symSpe) 
		{
			$alreadyAddedSymptomSpecialtiesArray[] = $symSpe['symptomCode'];
		}

		//create search criteria for the symptom codes
		$criteria = new CDbCriteria();
		if(isset($alreadyAddedSymptomSpecialtiesArray))
		{
			//only get symptom codes for symptoms not already added to specialties of the user, and of sellected cateogry
			$criteria->addNotInCondition('symptomCode', $alreadyAddedSymptomSpecialtiesArray);
			//if a symptom category has been selected
			if(isset($symptomsWithSelectedCategoryArray))
			{
				$criteria->addInCondition('symptomCode', $symptomsWithSelectedCategoryArray);
			}
		}
		//get all symptoms the user hasn't added to his specialties
		$symptomsModelArray = Symptoms::model()->findAll($criteria);
		
		//create data list
		$symptomsListData = CHtml::listData($symptomsModelArray, 'symptomCode', 'title'); 
		
		//render page
		$this->render('addSpecialties',array(
			'model'=>$model, 'symptomsModel'=>$symptomsModel, 
			'symptomsListData'=>$symptomsListData, 'renderPartialTrigger' => $renderPartialTrigger 
		));
	}

	/*
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorSymptomSpecialties']))
		{
			$model->attributes=$_POST['DoctorSymptomSpecialties'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	*/
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

	/*
	  Lists all models.
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DoctorSymptomSpecialties');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	 */
	/*
	Manages all models.
	 
	public function actionAdmin()
	{
		$model=new DoctorSymptomSpecialties('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DoctorSymptomSpecialties']))
			$model->attributes=$_GET['DoctorSymptomSpecialties'];

		$this->render('admin',array(
			'model'=>$model,
		));
	} */

	//manage user's symptom specialties
	public function actionManageSpecialties()
	{
		$model=new DoctorSymptomSpecialties;

		$dataProvider = new CActiveDataProvider('DoctorSymptomSpecialties', array(
			'Pagination' => array (
                  'PageSize' => 20
             ),
			'criteria'=>array(
		        'condition'=>'doctorUserID=:doctorUserID', 
		        'params'=>array(':doctorUserID'=>Yii::app()->user->id),
		    )
		));

		$this->render('manageSpecialties',array(
			'model'=>$model, 'dataProvider'=>$dataProvider
		));
	}

	/** 
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DoctorSymptomSpecialties the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DoctorSymptomSpecialties::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DoctorSymptomSpecialties $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-symptom-specialties-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	//function to get the symptom's title
	public function getSymptomTitle($data,$row)
	{
		$symptom = $data->symptomCode;
		$symptomData = Symptoms::model()->findByPk($symptom);
		//get the symptom title
		$symptomTitle = $symptomData->title;
		return $symptomTitle;
	}
}
