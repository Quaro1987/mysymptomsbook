<?php

class m140321_172522_create_disease_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_disease', array(
			'col1'=>'int(1) DEFAULT NULL',
			'col2'=>'varchar(1) DEFAULT NULL',
			'col3'=>'varchar(1) DEFAULT NULL',
			'col4'=>'int(2) DEFAULT NULL',
			'col5'=>'varchar(3) DEFAULT NULL',
			'col6'=>'varchar(6) DEFAULT NULL',
			'col7'=>'varchar(5) DEFAULT NULL',
			'col8'=>'varchar(4) DEFAULT NULL',
			'col9'=>'varchar(185) DEFAULT NULL',
			'col10'=>'varchar(5) DEFAULT NULL',
			'col11'=>'varchar(5) DEFAULT NULL',
			'col12'=>'varchar(5) DEFAULT NULL',
			'col13'=>'varchar(5) DEFAULT NULL',
			'col14'=>'varchar(5) DEFAULT NULL',
			'id'=>'pk',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('tbl_disease');
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