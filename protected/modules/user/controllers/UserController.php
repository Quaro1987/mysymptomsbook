<?php

class UserController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('view', 'viewDoctor', 'managePatients'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	

	/**
	 * Displays a particular model.
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=> $this->loadModel($id),
		));
	}

	public function actionViewDoctor($id)
	{
		$this->render('view',array(
			'model'=> $this->loadModel($id),
		));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED,
		    ),
				
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=User::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	//function to get access to a doctor's connected users
	public function actionManagePatients()
	{
		$model=new User;
		
		//query builder to get doctor's patients IDs
		$userIDs = Yii::app()->db->createCommand()
					->select('tbl_users.id')
    				->from('tbl_users')
    				->join('tbl_doctor_requests', 'tbl_users.id = tbl_doctor_requests.userID')
    				->where('tbl_doctor_requests.doctorID=:doctorID and tbl_doctor_requests.doctorAccepted = 1', array(':doctorID'=>Yii::app()->user->id))
    				->queryAll();

    	//copy query results into patientIDArray
		foreach ($userIDs as $uI) 
		{
			$patientIDArray[] = $uI['id'];
		}

		//create search criteria for the user ids in the patientIDArray
		$criteria = new CDbCriteria();
		$criteria->addInCondition('id', $patientIDArray);

		//populate dataProvider
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>$criteria
		)); 

		//render managePatients page
		$this->render('managePatients',array(
			'model'=>$model,'dataProvider'=>$dataProvider
		));
	}

	//function to get the user last name
	public function getUserLastName($data)
	{
		//get user lastname
		$lastName = $data->profile->lastname;
		return $lastName;
	}

	//function to get the user first name
	public function getUserFirstName($data)
	{
		//get user first name
		$firstName = $data->profile->firstname;
		return $firstName;
	}
}
