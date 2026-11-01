<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'master-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <h5>В целях исполнения запроса Самарской Губернской Думы в части анализа практики урегулирования споров между участниками образовательных отношений просим в срок до 8.04.2022 заполнить прилагаемую таблицу по работе комиссий по урегулированию споров между участниками образовательных отношений (далее - Комиссий).</h5>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php echo $form->checkBoxRow($model, 'pok1');?>
    
    <?php echo $form->checkBoxRow($model, 'pok2');?>
    
    <?php echo $form->checkBoxRow($model, 'pok3');?>
    
    <?php echo $form->textAreaRow($model,'pok4',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    <?php echo $form->textAreaRow($model,'pok5',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    <?php echo $form->textAreaRow($model,'pok6',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    <?php echo $form->textAreaRow($model,'pok7',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->checkBoxRow($model, 'pok8');?>
    
    <?php echo $form->textAreaRow($model,'pok9',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    <?php echo $form->textAreaRow($model,'pok10',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=> Report::model()->findByPk($model->id_report)->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>          

