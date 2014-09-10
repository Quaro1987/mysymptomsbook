<?php

/**
 * This is the model class for table "{{doctor_symptom_specialties}}".
 *
 * The followings are the available columns in table '{{doctor_symptom_specialties}}':
 * @property integer $id
 * @property integer $doctorUserID
 * @property string $symptomCode
 *
 * The followings are the available model relations:
 * @property Symptoms $symptomCode0
 * @property Users $doctorUser
 */
class DoctorSymptomSpecialties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{doctor_symptom_specialties}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doctorUserID, symptomCode', 'required'),
			array('doctorUserID', 'numerical', 'integerOnly'=>true),
			array('symptomCode', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, doctorUserID, symptomCode', 'safe', 'on'=>'search'),
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
			'symptomCode0' => array(self::BELONGS_TO, 'Symptoms', 'symptomCode'),
			'doctorUser' => array(self::BELONGS_TO, 'Users', 'doctorUserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'doctorUserID' => 'Doctor User',
			'symptomCode' => 'Symptom Code',
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
		$criteria->compare('doctorUserID',$this->doctorUserID);
		$criteria->compare('symptomCode',$this->symptomCode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DoctorSymptomSpecialties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
