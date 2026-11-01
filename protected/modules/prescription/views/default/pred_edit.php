<?php $this->pageTitle=Yii::app()->name;?>
<legend>Редактирование данных предписания</legend>
<p>
   <strong>Инструкция по заполнению:</strong> введите информацию о предписании согласно форме. 
</p>
<?php echo $this->renderPartial('_pred', array('model'=>$model, 'type' => 2)); ?>
