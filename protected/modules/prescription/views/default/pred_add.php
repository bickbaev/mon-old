<?php $this->pageTitle=Yii::app()->name;?>
<legend>Создание нового предписания</legend>
<p>
   <strong>Инструкция по заполнению:</strong> введите информацию о предписании согласно форме. Скан-копию предписания можно прикрепить позже.
</p>
<?php echo $this->renderPartial('_pred', array('model'=>$model, 'type' => 1)); ?>

