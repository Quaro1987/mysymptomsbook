<?php

class m140321_142051_create_Symptoms_Table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_symptom', array(
			'id'=>'pk',
			'code'=>'string NOT NULL',
			'title'=>'string NOT NULL',
			'shortTitle'=>'string NOT NULL',
			'inclusions'=>'string DEFAULT NULL',
			'exclusions'=>'string  DEFAULT NULL',
			'symptomCategory'=>'string NOT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('tbl_symptom');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}