<?php 
//array with categories
$categoriesArray = $symptomCategoryArray;
//string to copy paths into
$imagePathString = '';
$counter = 0; 
echo '<div class="row">';
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
	$counter++;
}
echo '</div>';

?>