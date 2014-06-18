<?php

/**
 * This is the model class for table "{{disease}}".
 *
 * The followings are the available columns in table '{{disease}}':
 * @property string $ICD10
 * @property string $diseaseTitle
 * @property integer $id
 *
 * The followings are the available model relations:
 * @property SymptomDisease[] $symptomDiseases
 */
class Disease extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{disease}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ICD10', 'length', 'max'=>5),
			array('diseaseTitle', 'length', 'max'=>185),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ICD10, diseaseTitle, id', 'safe', 'on'=>'search'),
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
			'symptomDiseases' => array(self::HAS_MANY, 'SymptomDisease', 'diseaseCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ICD10' => 'ICD10 Code',
			'diseaseTitle' => 'Disease Title',
			'id' => 'Database ID',
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

		$criteria->compare('ICD10',$this->ICD10,true);
		$criteria->compare('diseaseTitle',$this->diseaseTitle,true);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//function to search for multiple values based on ICD10 code
	public function queryResultSearch($diseaseArray)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('ICD10',$diseaseArray,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//function to run multiple symptom Codes query
	public function getMultipleSymptomsArray($sympomCodesArray)
	{
		//function scope array variable to store symptomCodes in OR comparison
		$orQueryArray=array();
		//or comparison
		$orQueryArray[0]='or';
		// empty string var
		$queryStringVar = '';

		//loop through symptomCodes
		foreach($sympomCodesArray as $symptomCode)
		{

			//format symptomCode into string to be searched
			$queryStringVar=("tbl_symptom_disease.symptomCode=\"".$symptomCode."\"");
			//add symptomCode in the OR comparison
			
			array_push($orQueryArray, $queryStringVar);
		}

		return $orQueryArray;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Disease the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
