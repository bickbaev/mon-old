<?php $this->pageTitle=Yii::app()->name;?>
<legend>Создание нового объекта</legend>
<p>
   <strong>Инструкция по заполнению:</strong> введите информацию об объекте согласно форме.
</p>
<?php echo $this->renderPartial('_obj', array('model'=>$model, 'blk'=>$blk)); ?>
