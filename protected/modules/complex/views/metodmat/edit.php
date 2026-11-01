<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong><br />
   Введите информацию о разработанных в Вашем учреждении учебно-методических материалах за период с 1 сентября 2011 по 1 сентября 2013 года. Для добавления информации о материале нажмите кнопку "Добавить материал".
</p>
<fieldset><legend>Информация о разработанных учебно-методических материалах</legend></fieldset>
<?php
if($metodmat->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'metodmat-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$metodmat,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'name'=>'id_type',
                    'value'=>'Metodmat_type::model()->findByPk($data->id_type)->naim_type',
                    ),                
                'naim',
                array(
                    'name'=>'author',
                    'header' =>'Автор(ы)',
                    ),                
                 
                array(
                    'header' =>'Издано',
                    'value' => array($this, 'izdat'),
                    'type'=>'html',
                ),
                array(
                    'name'=>'discipl',
                    'header' =>'Уч. дисц./МДК',
                    ),                                 
                array(
                    'header' =>'Проф./спец.',
                    'value' => array($this, 'prof'),
                    'type'=>'html',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/metodmat/update", array("id_metodmat"=>$data->id_metodmat))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/metodmat/delete", array("id_metodmat"=>$data->id_metodmat))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить?',
                    ),
            ),            
    )); 
}?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить материал', 'url'=>Yii::app()->createUrl("complex/metodmat/create", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 0px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Закончить ввод данных</button></div>