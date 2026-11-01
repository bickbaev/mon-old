<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по профессии/специальности - <?php echo '"'.Po_new::model()->findByPk($model->id_po)->naim_po.'" ('.$model->id_po.')' ?></legend></fieldset>
<h4>Инструкция</h4>
<p>Введите информацию обо всех местах трудоустройства выпускников по профессии/специальности <?php echo '"'.Po_new::model()->findByPk($model->id_po)->naim_po.'" ('.$model->id_po.')' ?> за период с 1 января 2015 года по 1 апреля 2015 года (1 квартал 2015 года).<br />
По каждому месту трудоустройства необходимо указать реквизиты документа подтверждающего факт трудоустройства. Данные документы будут выборочно проверены МОиН Самарской области путем запроса данных о трудоустройстве у работодателей.
</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'est-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Код профессии/специальности',
            'value'=>$model->id_po,
        ),      
        array(
            'label'=>'Профессия/специальность',
            'type'=>'raw',
            'value'=>Po_new::model()->findByPk($model->id_po)->naim_po,
        ),
        'p_in',  
        'p_out',
    ),
));
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные по профессии/специальности', 'url'=>Yii::app()->createUrl("complex/placement_spec/update_po", array('id_spec'=>$model->id_spec)))); ?></p></div>
<fieldset><legend>Информация о местах трудоустройства по профессии/специальности <?php echo '"'.Po_new::model()->findByPk($model->id_po)->naim_po.'" ('.$model->id_po.')' ?></legend></fieldset>
<?php
if($org->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$org,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Работодатель',
                    'value' => array($this, 'est'),
                    'type'=>'html',
                ),
                'p_out',
                array(
                    'header' => 'Реквизиты документа(ов)',
                    'name' => 'prik',
                ),    
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/placement_spec/update_org", array("id_org"=>$data->id_org))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/placement_spec/delete_org", array("id_org"=>$data->id_org))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить место трудоустройства?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить место трудоустройства', 'url'=>Yii::app()->createUrl("complex/placement_spec/create_org", array('id_spec'=>$model->id_spec)))); ?></p></div>
<div class="row"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'type'=>'primary',  'htmlOptions'=>array('class'=>'pull-right'), 'label'=>'Назад', 'url'=>$this->createUrl('placement_spec/edit',array('id_rep'=>$model->id_report)))); ?></div>
