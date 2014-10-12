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
	public $showSideInstrctions = 0;
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
			array('booster.filters.BoosterFilter - delete') //load yii booster
		);
	}
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			)
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
			array('allow', // allow authenticated user to perform various actions
				'actions'=>array('ajaxView', 'update', 
						'index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow normal user to perform addSymptom, and usersSymptomHistory actions
				'actions'=>array('addSymptom', 'usersSymptomHistory', 'ajaxContactPatient'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->usertype==0',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('allow', // allow doctor user to perform diagnoseSymptom, ajaxContactPatient and patientSymptomHistory actions
				'actions'=>array('patientSymptomHistory', 'diagnoseSymptom', 'ajaxContactPatient'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->usertype==1',
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


	public function actionAjaxView($id)
	{
		echo $this->renderPartial('_symptomHistoryDialogView',array(
			'model'=>$this->loadModel($id)), false, true 
		);
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAddSymptom()
	{
		//load custom layout for this view
		$model = new Symptomhistory;
		$symptomsModel = new Symptoms;
		$doctorRequestModel = new DoctorRequests;
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
				//notify doctors of new symptom
				$usersDoctorsArray = $doctorRequestModel->findAllByAttributes(array('userID'=>Yii::app()->user->id, 'doctorAccepted'=>1));
				foreach ($usersDoctorsArray as $usersDoctorRequest) 
				{
					$usersDoctorRequest->newSymptomAdded = 1;
					$usersDoctorRequest->save();
				}

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

	//return current user's symptom history
	public function actionUsersSymptomHistory()
	{
		$model = new Symptomhistory;
		//load specific layout with side instructions
		$this->layout='//layouts/column2SideInstructions';
		$symptomUrl = Yii::app()->createUrl('doctorRequests/findDoctor');
		//empty array to store all the user's symptoms
		$symptomItems = array();
		//find all symptomHistory records belonging to the user
		$symptomHistoryModels = $model->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		//loop through all the symptomHistory records that belong to the user
		foreach($symptomHistoryModels as $symptom)
		{
			//switch case for event color. set color for each flag type
			switch($symptom->symptomFlag)
			{
				case '1':
					$symptomColor = '#A1EB86';
					break;
				case '2':
					$symptomColor = '#CCCA52';
					break;
				case '3':
					$symptomColor = '#F25138';
					break;
				default:
					$symptomColor = '#36c';
			}
			//create symptom event
			$symptomItem=array('title'=>$symptom->symptomTitle,
								'start'=>$symptom->dateSymptomFirstSeen,
								'end'=>$symptom->dateSearched,
								'symptomCode'=>$symptom->symptomCode,
								'color'=>$symptomColor
			);
			//copy symptomHistory record into array
			array_push($symptomItems, $symptomItem);
		}
		
		//pass array with user's symptoms to the view
		$this->render('usersSymptomHistory',array('symptomHistoryEvents'=>$symptomItems, 'symptomUrl'=>$symptomUrl));
	}

	//action to render the patient's symptom history
	public function actionPatientSymptomHistory($id)
	{
		//load side menu instructions laytout
		$this->layout='//layouts/column2SideInstructions';
		//create model doctor request and search the database for a doctor request between the doctor user and 
		//the patient user
		$doctorRequestModel = new DoctorRequests;
		$doctorPatientRequest = $doctorRequestModel->findByAttributes(array('doctorID'=>Yii::app()->user->id, 'userID'=>$id, 'doctorAccepted'=>1));
		//if there is an accepted doctor request between doctor and patient, show the patients's symptom history
		if(isset($doctorPatientRequest))
		{	
			//remove notification for new symptoms
			$doctorPatientRequest->newSymptomAdded = 0;
			$doctorPatientRequest->save();
			
			$model = new Symptomhistory;
	
	
			//model for the patients data
			$patientModel = User::model()->findByPk($id);
			//empty array to store all the user's symptoms
			$symptomItems = array();
			//find all symptomHistory records belonging to the user
			$symptomHistoryModels = $model->findAllByAttributes(array('user_id'=>$id));
			//loop through all the symptomHistory records that belong to the user
			foreach($symptomHistoryModels as $symptom)
			{
				//switch case for event color. set color for each flag type
				switch($symptom->symptomFlag)
				{
					case '1':
						$symptomColor = '#A1EB86';
						break;
					case '2':
						$symptomColor = '#CCCA52';
						break;
					case '3':
						$symptomColor = '#F25138';
						break;
					default:
						$symptomColor = '#36c';
				}
				//create event
				$symptomItem=array('title'=>$symptom->symptomTitle,
									'start'=>$symptom->dateSymptomFirstSeen,
									'end'=>$symptom->dateSearched,
									'symptomCode'=>$symptom->symptomCode,
									'symptomHistoryID'=>$symptom->id,
									'flag'=>$symptom->symptomFlag,
									'color'=>$symptomColor
				);
				//copy symptomHistory event into array
				array_push($symptomItems, $symptomItem);
			}
			//render patient history
			$this->render('patientSymptomHistory',array(
				'model'=> $model, 'patientModel'=> $patientModel, 'symptomHistoryEvents'=>$symptomItems
			));
		}
		else //else throw exception
		{
			throw new CHttpException(403, 'You are not permitted to check this patient\'s Symptom History');
		}
	}

	//action so a doctor user can diagnose the symptom and contact the patient
	public function actionDiagnoseSymptom()
	{
		$contactFormModel = new ContactPatientForm;
		//set up models for initial load
		if(isset($_POST['id']))
		{
			$symptomHistoryModel = $this->loadModel($_POST['id']);
			$patientModel = User::model()->findByPk($symptomHistoryModel->user_id);
		}
			
		
		
		if(isset($_POST['Symptomhistory']))
		{ 
			$symptomHistoryModel = $this->loadModel($_POST['Symptomhistory']['id']);
			$patientModel = User::model()->findByPk($symptomHistoryModel->user_id);
			$symptomHistoryModel->attributes=$_POST['Symptomhistory'];
			if($symptomHistoryModel->save())
				$this->redirect(array('patientSymptomHistory','id'=>$symptomHistoryModel->user_id));
		}


		$this->renderPartial('_diagnoseSymptomModal', 
			array('symptomHistoryModel'=>$symptomHistoryModel,
				  'contactFormModel'=>$contactFormModel, 'patientModel'=>$patientModel));
	}

	//contact patient function
	public function actionAjaxContactPatient()
	{
		$model=new ContactPatientForm;
		//if data is posted
		if(isset($_POST['ContactPatientForm']))
		{
			$doctor = User::model()->findByPk(Yii::app()->user->id);
			
			$model->setAttributes(array(
								'subject'=>$_POST['ContactPatientForm']['subject'],
								'body'=>$_POST['ContactPatientForm']['body'],
								'doctorEmail'=>Yii::app()->user->email,
								'name'=>$doctor->profile->firstname.' '.$doctor->profile->lastname,
								'patientEmail'=>$_POST['ContactPatientForm']['patientEmail'],
								'sendSMS'=>$_POST['ContactPatientForm']['sendSMS']
			));
			if($model->validate())
			{

				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->doctorEmail}>\r\n".
					"Reply-To: {$model->doctorEmail}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
				//if checkbox is checked, also send as sms
				if($model->sendSMS)
				{
					Yii::import('application.vendor.twilio.*');
					spl_autoload_unregister(array('YiiBase','autoload')); 
					require dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/twilio/Services/Twilio.php';
					spl_autoload_register(array('YiiBase', 'autoload'));
					

					$sid = "AC19ba95d4d26bb91015ae1596d6041fe1"; // Your Account SID from www.twilio.com/user/account
					$token = "9009a259b57ef66b3748dd3eb46850d4"; // Your Auth Token from www.twilio.com/user/account
					 
					$client = new Services_Twilio($sid, $token);
					$message = $client->account->sms_messages->create(
					  '+19082064960', 
					  '+306993953048', 
					  $model->body
					);
				}
				mail($model->patientEmail,$subject,$model->body,$headers);
				return;
				
			}
		}
	}
}