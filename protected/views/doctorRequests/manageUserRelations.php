<?php
/* @var $this DoctorRequestSpecialtiesController */
/* @var $model DoctorRequestSpecialties */

$this->breadcrumbs=array(
	'Manage User Relations'
);
//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();
?>
<?php 
	if(Yii::app()->user->usertype==1) 
	{
		echo '<h1>Manage Your Patient Relations</h1>';
	}
	else
	{
		echo '<h1>Manage Your Doctor Relations</h1>';
	}
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-relations-grid',
	'dataProvider'=>$dataProvider,
	'selectableRows'=>0,
	'columns'=>array(
		array(
			'name'=>'Last Name',
       		'value'=>array($this, 'getUserLastName'),
        ),
		array(
			'name'=>'First Name',
            'value'=>array($this, 'getUserFirstName')
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{delete}',
			'buttons'=>array('delete' => array('imageUrl'=>Yii::app()->request->baseUrl.'/images/denyUser.png'))
		),
	),
)); ?>
