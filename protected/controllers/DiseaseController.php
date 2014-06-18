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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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

		if(isset($_POST['Disease']))
		{
			$model->attributes=$_POST['Disease'];
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
		$model=new Disease('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Disease']))
			$model->attributes=$_GET['Disease'];

		//empty diseasearray

 						
		$diseaseArray=array();
		$diseaseArrayForSearch=array();
		$symptomCodesArray=array();
		$symptomsOrQueryArray=array();
		
		if(isset($_GET['symptomCode']))
		{
			//pass symptomCodes into an Array
			$symptomCodesArray=$_GET['symptomCode'];
			if(!(sizeOf($symptomCodesArray)==1))
			{
				$symptomsOrQueryArray = $model->getMultipleSymptomsArray($symptomCodesArray);

				/*$sql = "SELECT ICD10 FROM (
    SELECT MAX(disease_count) AS max_disease_count
    FROM
    (
        SELECT tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count
        FROM `tbl_disease`
        JOIN tbl_symptom_disease
        ON tbl_disease.ICD10=tbl_symptom_disease.diseaseCode
        WHERE tbl_symptom_disease.symptomCode='P18' 
        OR tbl_symptom_disease.symptomCode='P19'
        GROUP BY ICD10
    ) sub0
) sub1
INNER JOIN
(
    SELECT tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count
    FROM `tbl_disease`
    JOIN tbl_symptom_disease
    ON tbl_disease.ICD10=tbl_symptom_disease.diseaseCode
    WHERE tbl_symptom_disease.symptomCode='P18' 
    OR tbl_symptom_disease.symptomCode='P19'
    GROUP BY ICD10
) sub2
ON sub1.max_disease_count = disease_count";

		$command=Yii::app()->db->createCommand($sql);
		$diseaseCodes=$command->query();
				*/
				//placeholder description
				$diseaseCountSqlQuery = Yii::app()->db->createCommand()
										->select ('tbl_disease.ICD10, COUNT(tbl_disease.ICD10) AS disease_count')
										->from ('tbl_disease')
										->join ('tbl_symptom_disease', 'ICD10=diseaseCode')
										->where ($symptomsOrQueryArray)
										->group ('ICD10')
										->queryAll();
				//placeholder
										
				$maxDiseaseCountQuery = Yii::app()->db->createCommand()
										->select ('MAX(disease_count) AS max_disease_count')
										->from ($diseaseCountSqlQuery)
										->queryAll();
				//multiple symptom query
				$diseaseCodes = Yii::app()->db->createCommand()
								->select ('ICD10')
								->from ($maxDiseaseCountQuery)
								->join ($diseaseCountSqlQuery, 'max_disease_count=disease_count')
								->queryAll();
								
			}
			else
			{
				//single symptom query
				$diseaseCodes = Yii::app()->db->createCommand()
								->select ('ICD10')
								->from ('tbl_disease')
								->join ('tbl_symptom_disease symptomCode', 'ICD10=diseaseCode')
								->where ('symptomCode=:symptomCode', array(':symptomCode'=>$symptomCodesArray[0]))
								->queryAll();			
			}
		}



		//fill diseaseArray with ICD10 code from diseaseCodes query

		foreach($diseaseCodes as $dc)
		{
			$diseaseArray[]=$dc['ICD10'];
		}


		/*
		//mysqul query to return disease results
		foreach ($symptomCodesArray as $symptom) {
				
				$diseaseCodes = Yii::app()->db->createCommand()
						->select('diseaseCode')
						->from('tbl_symptom_disease')
						->where(array('in', 'diseaseCode',$diseaseCodes[]))
						->andWhere('symptomCode=:symptomCode', array(':symptomCode'=>$symptom))
						->queryAll();						
						//fill diseaseArray with ICD10 code from diseaseCodes query
						unset($diseaseArray);
						$diseaseArray=array();
						
						foreach($diseaseCodes as $dc)
						{
							$diseaseArray[]=$dc;
						}
		}
		*/
		

		//populate data provider
		$dataProvider = $model->queryResultSearch($diseaseArray);

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{ 
		$model=new Disease('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Disease']))
			$model->attributes=$_GET['Disease'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

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
