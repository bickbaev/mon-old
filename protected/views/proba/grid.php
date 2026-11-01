<?php
$dataProvider=new CActiveDataProvider('Est');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'enableSorting'=>true,
));
?>
