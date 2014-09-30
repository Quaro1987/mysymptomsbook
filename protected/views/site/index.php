<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

//include jquery
Yii::app()->clientScript->registerScriptFile(
	        Yii::app()->baseUrl . '/assets/961fed56/jquery.js',
	        CClientScript::POS_HEAD
	    );
?>


<?php 
if(Yii::app()->user->isGuest): ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>To use My Symptoms Book, please click on the Register button in the menu to create
your User account.</p>

<p>If you already have an account, click the Login button to start using My Symptoms Book services.</p>
<?php
else: 
	 
	//side menu
	$this->menu= Yii::app()->Globals->getSidePortletMenu();
?>	

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?>, </i><?php echo CHtml::encode(Yii::app()->user->username); ?>!</h1>
<p>Click on the "Add Symptom" operation to add a Symptom to your Symptom History.</p>
<p>Click on the "Symptom History" button to see your saved Symptoms.</p>
<p>Click on the "Find a Doctor" operation to see all available doctors and to send them a request..</p>
<?php endif ?>