<?php

/**
 * This is the model class for table "{{doctor_requests}}".
 *
 * The followings are the available columns in table '{{doctor_requests}}':
 * @property integer $id
 * @property integer $doctorID
 * @property integer $userID
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Users $doctor
 */
class DoctorRequests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{doctor_requests}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doctorID', 'required', 'message'=>'Please select a Doctor first.'),
			array('doctorID, userID, doctorAccepted, symptomHistoryID, newSymptomAdded', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, doctorID, userID, doctorAccepted, symptomHistoryID, newSymptomAdded', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'userID'),
			'doctor' => array(self::BELONGS_TO, 'Users', 'doctorID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'doctorID' => 'Doctor',
			'userID' => 'User',
			'symptomHistoryID' => 'Symptom',
			'newSymptomAdded' => 'New Symptom Added'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('doctorID',$this->doctorID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('symptomHistoryID',$this->symptomHistoryID);
		$criteria->compare('newSymptomAdded',$this->newSymptomAdded);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DoctorRequests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
