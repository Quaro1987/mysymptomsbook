<?php

class DoctorRequestsController extends Controller
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
				'actions'=>array('create','addDoctor','update', 'successPage'),
				'users'=>array('@'),
			),
			array('allow', // allow doctor user to perform 'manageRequests', 'acceptUser', 'rejectUser' actions
				'actions'=>array('manageRequests', 'acceptUser', 'rejectUser'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->usertype==1',
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
		$model=new DoctorRequests;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DoctorRequests']))
		{
			$model->attributes=$_POST['DoctorRequests'];
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

		if(isset($_POST['DoctorRequests']))
		{
			$model->attributes=$_POST['DoctorRequests'];
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
		$dataProvider=new CActiveDataProvider('DoctorRequests');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DoctorRequests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DoctorRequests']))
			$model->attributes=$_GET['DoctorRequests'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DoctorRequests the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DoctorRequests::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	//function to find and add a new doctor
	public function actionAddDoctor()
	{
		$model = new DoctorRequests;
		$userModel = new User;
		//query builder to get doctors the user has already made requests for
		$alreadyAddedDoctorIDs = Yii::app()->db->createCommand()
					->select('doctorID')
    				->from('tbl_doctor_requests')
    				->where('userID=:userID', array(':userID'=>Yii::app()->user->id))
    				->queryAll();

    	//copy query results into alreadyAddedDoctorIDArray
		foreach ($alreadyAddedDoctorIDs as $dI) 
		{
			$alreadyAddedDoctorIDArray[] = $dI['doctorID'];
		}

		//create search criteria for the doctor ids
		$criteria = new CDbCriteria();
		$criteria->addNotInCondition('id', $alreadyAddedDoctorIDArray)
				 ->addCondition('userType=1');


		//used to update symptoms grid with ajax call
		if(isset($_GET['User'])) 
		{
			$criteria->addCondition('doctorSpecialty="'.$_GET['User']['doctorSpecialty'].'"');
		}

		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>$criteria
		));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//create add doctor request
		if(isset($_POST['DoctorRequests']))
		{
			$model->setAttributes(array(
								'doctorID'=>$_POST['DoctorRequests']['doctorID'],
								'userID'=>Yii::app()->user->id,
								'doctorAccepted'=>0
			));
			if($model->save())
				$this->redirect(array('addDoctor'));
		}

		$this->render('addDoctor',array(
			'model'=>$model, 'userModel'=>$userModel, 'dataProvider'=>$dataProvider
		));
	}

	//function to manage doctor requests
	public function actionManageRequests()
	{
		$model=new DoctorRequests;

		$dataProvider=new CActiveDataProvider('DoctorRequests', array(
			'criteria'=>array(
		        'condition'=>'doctorID=:doctorID AND doctorAccepted=:doctorAccepted', 
		        'params'=>array(':doctorID'=>Yii::app()->user->id, ':doctorAccepted'=>0),
		    )
		));

		$this->render('manageRequests',array(
			'model'=>$model, 'dataProvider'=>$dataProvider
		));
	}

	//function to get the user's who made the request last name
	public function getUserLastName($data,$row)
	{
		$user = $data->userID;
		$userData = User::model()->findByPk($user);
		//get user lastname
		$lastName = $userData->profile->lastname;
		return $lastName;
	}

	//function to get the user's who made the request first name
	public function getUserFirstName($data,$row)
	{
		$user = $data->userID;
		$userData = User::model()->findByPk($user);
		//get user first name
		$firstName = $userData->profile->firstname;
		return $firstName;
	}

	//accept user request function
	public function actionAcceptUser($id)
	{
		$model=$this->loadModel($id);
		//change doctorAccepted value to 1 which means the doctor has accepted the user
		$model->setAttribute('doctorAccepted', 1);
		//save changes
		$model->save();
	}

	//reject user request function
	public function actionRejectUser($id)
	{
		//delete doctor request
		DoctorRequests::model()->deleteByPk($id);
	}

	/**
	 * Performs the AJAX validation.
	 * @param DoctorRequests $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-requests-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	//get doctor specialties
	public static function getDoctorSpecialties()
	{
		 return array(
		 				'Cardiologist'=>'Cardiologist',
		 				'Dentist'=>'Dentist',
		 				'Dermatologist'=>'Dermatologist',
		 				'Pathologist'=>'Pathologist',
		 			  );
	}

	/* action that renders the symptom successfully added paged */
	public function actionSuccessPage()
	{
		$this->render('successPage');
	}
}
