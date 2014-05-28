<?php $dataProvider=new CActiveDataProvider($data);

echo $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,)); 

?>