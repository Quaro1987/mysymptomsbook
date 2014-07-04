<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php 
if(Yii::app()->user->isGuest): ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>To use My Symptoms Book, please click on the Register button in the menu to create
your User account.</p>

<p>If you already have an account, click the Login button to start using My Symptoms Book services.</p>
<?php
else: ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?>, </i><?php echo CHtml::encode(Yii::app()->user->username); ?>!</h1>
<p>Click on the "Search Symptoms" button to search for diseases based on your symptoms.</p>
<p>Click on the "Profile" button to see your user page and past symptom search history.</p>

<?php endif ?>