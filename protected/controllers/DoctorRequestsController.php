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
			array('allow', // allow authenticated user to perform 'manageUserRelations'  actions
				'actions'=>array('manageUserRelations', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow normal user to perform findDoctor actions
				'actions'=>array('findDoctor'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->usertype==0',
			),
			array('allow', // allow doctor user to perform 'manageRequests', 'acceptUser', 'rejectUser' actions
				'actions'=>array('manageRequests', 'acceptUser', 'rejectUser', 'getNotifications'),
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
	/*
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

	/**
	 * Lists all models.
	 *//*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DoctorRequests');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	*/
	/**
	 * Manages all models.
	 *//*
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
	*/
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
	public function actionFindDoctor($symptomCode)
	{
		$model = new DoctorRequests;

		//create add doctor request
		if(isset($_POST['DoctorRequests']))
		{
			$symptomHistoryModel = Symptomhistory::model()->findByAttributes(
				array('user_id'=>Yii::app()->user->id, 'symptomCode'=>$symptomCode)
			);

			$model->setAttributes(array(
								'doctorID'=>$_POST['DoctorRequests']['doctorID'],
								'userID'=>Yii::app()->user->id,
								'doctorAccepted'=>0,
								'symptomHistoryID'=>$symptomHistoryModel->id
			));
			//save model, and if successful, refresh page and notify user
			$model->save();
		}
		//reset model
		$model = new DoctorRequests;
		$userModel = new User;
		$symptomSpecialtyModel = new DoctorSymptomSpecialties;
		$symptomsModel = Symptoms::model()->findByPk($symptomCode);
		$doctorAdded = 0;
		//query builder to get doctors the user has already made requests for
		$alreadyAddedDoctorIDs = Yii::app()->db->createCommand()
					->select('doctorID')
    				->from('tbl_doctor_requests')
    				->where('userID=:userID', array(':userID'=>Yii::app()->user->id))
    				->queryAll();

    	//query builder to get doctors who have the symptom specialty
    	$doctorsWithSpecialtyIDs = Yii::app()->db->createCommand()
    				->select('doctorUserID')
    				->from('tbl_doctor_symptom_specialties')
    				->where('symptomCode=:symptomCode', array(':symptomCode'=>$symptomCode))
    				->queryAll();

    	//copy query results into alreadyAddedDoctorIDArray
		foreach ($alreadyAddedDoctorIDs as $dI) 
		{
			$alreadyAddedDoctorIDArray[] = $dI['doctorID'];
		}

		//copy query results into doctorsWithSpecialtyArray
		foreach ($doctorsWithSpecialtyIDs as $dS) 
		{
			$doctorsWithSpecialtyArray[] = $dS['doctorUserID'];
		}
		//if there exist doctors with this specialty
		if(isset($doctorsWithSpecialtyArray))
		{
			//create search criteria for the doctor ids
			$criteria = new CDbCriteria();
			$criteria->addNotInCondition('id', $alreadyAddedDoctorIDArray)
					 ->addInCondition('id', $doctorsWithSpecialtyArray)
					 ->addCondition('userType=1');
		}
		else
		{
			//create search criteria which will always come false to get an empty dataprovider
			$criteria = new CDbCriteria();
			$criteria->addInCondition('id', array('-1'));
		}
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
		
		$this->render('findDoctor',array(
			'model'=>$model, 'userModel'=>$userModel, 'symptomsModel'=>$symptomsModel, 'dataProvider'=>$dataProvider
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
		if(Yii::app()->user->userType==1)
		{
			$user = $data->userID;
		}
		else if(Yii::app()->user->userType==0)
		{
			$user = $data->doctorID;
		}
		$userData = User::model()->findByPk($user);
		//get user lastname
		$lastName = $userData->profile->lastname;
		return $lastName;
	}

	//function to get the user's who made the request first name
	public function getUserFirstName($data,$row)
	{	
		if(Yii::app()->user->userType==1)
		{
			$user = $data->userID;
		}
		else if(Yii::app()->user->userType==0)
		{
			$user = $data->doctorID;
		}
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

	//action to notify doctor of new requests

	public function actionGetNotifications()
	{

		if(isset($_POST))
		{
			$model = DoctorRequests::model()->findByAttributes(array('doctorID'=>Yii::app()->user->id,
																	 'doctorAccepted'=>0));
			$count = count($model);

			$model2 = DoctorRequests::model()->findByAttributes(array('doctorID'=>Yii::app()->user->id,
																	'doctorAccepted'=>1 ,'newSymptomAdded'=>1));
			$count2 = count($model2);
			//if there are both new symptoms by patients and new requests show notifications for both
			if(!($count==0)&&!($count2==0))
			{
				echo 3;
			}
			else if(!($count2==0)) //else if there are only new symptoms then only notify about new symptoms
			{
				echo 2;
			}
			else if(!($count==0)) //else if there are only new doctor requests then only notify about new requests
			{
				echo 1;
			}
			else //do nothing
			{
				echo 0;
			}
		}
	}

	//manage user relations for doctor and normal users
	public function actionManageUserRelations()
	{
		$model=new DoctorRequests;
		//if the user is a doctor get all doctorRequests with his user id as the doctor's id
		if(Yii::app()->user->usertype==1)
		{
			$dataProvider = new CActiveDataProvider('DoctorRequests', array(
				'Pagination' => array (
        	          'PageSize' => 20
        	     ),
				'criteria'=>array(
			        'condition'=>'doctorID=:doctorID AND doctorAccepted=:doctorAccepted', 
			        'params'=>array(':doctorID'=>Yii::app()->user->id, 'doctorAccepted'=>1),
			    )
			));
		}
		else //if the user is a normal user get all doctorRequests with his user id as the user's id
		{
			$dataProvider = new CActiveDataProvider('DoctorRequests', array(
				'Pagination' => array (
        	          'PageSize' => 20
        	     ),
				'criteria'=>array(
			        'condition'=>'userID=:userID AND doctorAccepted=:doctorAccepted', 
			        'params'=>array(':userID'=>Yii::app()->user->id, 'doctorAccepted'=>1),
			    )
			));
		}
		$this->render('manageUserRelations',array(
			'dataProvider'=>$dataProvider
		));
	}
}
