<?php $this->pageTitle=Yii::app()->name;?>
<legend>Создание нового мероприятия</legend>
<p>
   <strong>Инструкция по заполнению:</strong> введите информацию о мероприятии предписания согласно форме.
</p>
<?php echo $this->renderPartial('_mer', array('model'=>$model, 'type' => $type)); ?>
