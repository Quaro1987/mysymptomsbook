<?php

/**
* This is the model class for table "{{symptomhistory}}".
*
* The followings are the available columns in table '{{symptomhistory}}':
* @property integer $id
* @property integer $user_id
* @property string $symptomCode
* @property string $dateSearched
* @property string $dateSymptomFirstSeen
*
* The followings are the available model relations:
* @property Symptoms $symptomCode0
* @property Users $user
*/
class Symptomhistory extends CActiveRecord
{
/**
* @return string the associated database table name
*/
public function tableName()
{
return '{{symptomhistory}}';
}

/**
* @return array validation rules for model attributes.
*/
public function rules()
{
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
return array(
array('user_id, symptomCode, dateSearched, dateSymptomFirstSeen', 'required'),
array('user_id', 'numerical', 'integerOnly'=>true),
array('symptomCode', 'length', 'max'=>11),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, user_id, symptomCode, dateSearched, dateSymptomFirstSeen', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
public function relations()
{

//import module for relations between models
Yii::import('application.modules.user.models.*');
// class name for the relations automatically generated below.
return array(
'symptomCode' => array(self::BELONGS_TO, 'Symptoms', 'symptomCode'),
'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
);
}

/**
* @return array customized attribute labels (name=>label)
*/
public function attributeLabels()
{
return array(
'id' => 'ID',
'user_id' => 'User',
'symptomCode' => 'Symptom Code',
'dateSearched' => 'Date Searched',
'dateSymptomFirstSeen' => 'Date Symptom First Seen',
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
$criteria->compare('user_id',$this->user_id);
$criteria->compare('symptomCode',$this->symptomCode,true);
$criteria->compare('dateSearched',$this->dateSearched,true);
$criteria->compare('dateSymptomFirstSeen',$this->dateSymptomFirstSeen,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
));
}

/**
* Returns the static model of the specified AR class.
* Please note that you should have this exact method in all your CActiveRecord descendants!
* @param string $className active record class name.
* @return Symptomhistory the static model class
*/
public static function model($className=__CLASS__)
{
return parent::model($className);
}


//function to get search history of logged in user
public function searchByUser($usersID)
{
$criteria=new CDbCriteria;

$criteria->compare('user_id',$usersID);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
));
}
}