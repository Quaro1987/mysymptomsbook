<?php

class DiseaseController extends Controller
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
			array('allow', // allow authenticated user to perform 'create', 'update', 'results' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
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
			'model'=>$this->loadModel($id)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *//*
	public function actionCreate()
	{
		$model=new Disease;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Disease']))
		{
			$model->attributes=$_POST['Disease'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 *//*
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Disease']))
		{
			$model->attributes=$_POST['Disease'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */

	/*  Commented out so the admin can not compromise the database, but decided to leave code here in case of future edit to the webapp's requirements.
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	*/
	/**
	 * Lists all models. Edited so it lists disease models based on inputed symptomCodes
	 */
	public function actionIndex()
	{
		$model=new Disease('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Disease']))
			$model->attributes=$_GET['Disease'];

		//empty diseasearray

 				
		$diseaseArray=array();
		$symptomCodesArray=array();
		$symptomsOrQueryString="";
		
		if(isset($_GET['symptomCode']))
		{
			//pass symptomCodes into an Array
			$symptomCodesArray=$_GET['symptomCode'];
			//get the number of symptoms in the array
			$symptomsCount = count($symptomCodesArray);
			//if checks if there is only 1 symptom or more in the user's search
			if(!($symptomsCount==1))
			{
				//get the string of symtpoms for the query
				$symptomsOrQueryString = $model->getMultipleSymptomsOrQueryString($symptomCodesArray);
				//string containing sql query to get the maximum number of symptoms that the diseases have in common
				$maximumDiseaseCountSQLString = "SELECT MAX(disease_count) AS max_disease_count
    											 FROM (
        											SELECT tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count
        											FROM `tbl_disease`
        											JOIN tbl_symptom_disease
        											ON tbl_disease.ICD10=tbl_symptom_disease.diseaseCode
        											WHERE ".$symptomsOrQueryString."
        											GROUP BY ICD10
    											) subQuery";
				//execute database query	
				$command=Yii::app()->db->createCommand($maximumDiseaseCountSQLString);
				$maximumDiseaseCountSQL=$command->query();
				//extract rows from $maximumDiseaseCountSQL into an array
				$maximumDiseaseCount = $maximumDiseaseCountSQL->readAll();
				//if checks if there exists a disease that has the same number of symptoms in common as the number of user inputed 
				//symptoms. This is done to check if there exists at least 1 disease with all the symtpoms the user searched for.
				if($maximumDiseaseCount[0]['max_disease_count']==$symptomsCount)
				{
					$resultsExist=true;
					//string containing sql query to get the diseases with the inputed symptoms	
					$diseaseSQLString = "SELECT ICD10 FROM (
    										SELECT MAX(disease_count) AS max_disease_count
    										FROM (
        										SELECT tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count
        										FROM `tbl_disease`
        										JOIN tbl_symptom_disease
        										ON tbl_disease.ICD10=tbl_symptom_disease.diseaseCode
        										WHERE ".$symptomsOrQueryString."
        										GROUP BY ICD10
    										) subQuery
										) subQuery2
										INNER JOIN
										(
										    SELECT tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count
										    FROM `tbl_disease`
										    JOIN tbl_symptom_disease
										    ON tbl_disease.ICD10=tbl_symptom_disease.diseaseCode
										    WHERE ".$symptomsOrQueryString."
										    GROUP BY ICD10
										) subQuery3
										ON subQuery2.max_disease_count = disease_count";
					//execute database query
					$command=Yii::app()->db->createCommand($diseaseSQLString);
					$diseaseCodes=$command->query();	
				}
				else // ! if($maximumDiseaseCount[0]['max_disease_count']==$symptomsCount)
				{
					$resultsExist=false;
					$dataProvider='';
				} //end of if($maximumDiseaseCount[0]['max_disease_count']==$symptomsCount)					
			}
			else // if($symptomsCount==1)
			{
				$resultsExist=true;
				//single symptom query
				$diseaseCodes = Yii::app()->db->createCommand()
								->select ('ICD10')
								->from ('tbl_disease')
								->join ('tbl_symptom_disease symptomCode', 'ICD10=diseaseCode')
								->where ('symptomCode=:symptomCode', array(':symptomCode'=>$symptomCodesArray[0]))
								->queryAll();			
			} //end of if(!($symptomsCount==1))			
		} //end of if(isset($_GET['symptomCode']))


		//fill diseaseArray with ICD10 code from diseaseCodes query
		if($resultsExist==true)
		{
			
			foreach($diseaseCodes as $dc)
			{
				$diseaseArray[]=$dc['ICD10'];
			}
	
				//populate data provider
			$dataProvider = $model->queryResultSearch($diseaseArray);
		}
		//rebder results view with provided data provider
		$this->render('index',array(
			'dataProvider'=>$dataProvider,'resultsExist'=>$resultsExist
		));
	}

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{ 
		$model=new Disease('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Disease']))
			$model->attributes=$_GET['Disease'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Disease the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Disease::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Disease $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='disease-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
