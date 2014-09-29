<?php 
//array with categories
$categoriesArray = $this->symptomCategoryArray;
//string to copy paths into
$imagePathString = '';

foreach($categoriesArray as $categoryImage)
{
	//copy image name into image path
	$imagePathString = Yii::app()->request->baseUrl.'/images/'.$categoryImage.'.jpg'; 
	//echo the html content
	echo '<div class="imageLinkIcon">';
	//echo the buttons that pick a category
	echo  CHtml::imageButton($imagePathString, array('title'=>$categoryImage, 'onclick'=>
													'updateGridView("symptoms-grid", "'.$categoryImage.'");'));
	echo '</div>';
}
?>