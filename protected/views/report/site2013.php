<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'site2013',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <?php echo $form->textAreaRow($model,'remark',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div style="margin-left: 75px; margin-bottom: 10px;">Адрес сайта<span style="margin-left:25px;"><?php echo CHtml::link($model->site2, $model->site2, array('target'=>'_blank')); ?></span></div>

    <?php //echo $form->textFieldRow($model,'site2',array('maxlength'=>255, 'class'=>'span8')); ?>

    <?php echo $form->checkBoxRow($model,'pok1'); ?>

    <?php echo $form->checkBoxRow($model,'pok27'); ?>

    <div class="row"><div class="span10 offset2"><fieldset><legend>Информация:</legend></fieldset></div></div>

    <?php echo $form->checkBoxRow($model,'pok2'); ?>

    <?php echo $form->checkBoxRow($model,'pok3'); ?>

    <?php echo $form->checkBoxRow($model,'pok4'); ?>

    <?php echo $form->checkBoxRow($model,'pok5'); ?>
 
    <?php echo $form->checkBoxRow($model,'pok6'); ?>
 
    <?php echo $form->checkBoxRow($model,'pok7'); ?>

    <?php echo $form->checkBoxRow($model,'pok8'); ?>

    <?php echo $form->checkBoxRow($model,'pok9'); ?>

    <?php echo $form->checkBoxRow($model,'pok10'); ?>
    
    <?php echo $form->checkBoxRow($model,'pok11'); ?>    

    <?php echo $form->checkBoxRow($model,'pok12'); ?>
    
    <?php echo $form->checkBoxRow($model,'pok13'); ?>    

    <?php echo $form->checkBoxRow($model,'pok14'); ?>

    <?php echo $form->checkBoxRow($model,'pok15'); ?>

    <?php echo $form->checkBoxRow($model,'pok16'); ?>

    <?php echo $form->checkBoxRow($model,'pok17'); ?>

    <?php echo $form->checkBoxRow($model,'pok18'); ?>
    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Копии:</legend></fieldset></div></div>    

    <?php echo $form->checkBoxRow($model,'pok19'); ?>

    <?php echo $form->checkBoxRow($model,'pok20'); ?>

    <?php echo $form->checkBoxRow($model,'pok21'); ?>

    <?php echo $form->checkBoxRow($model,'pok22'); ?>

    <?php echo $form->checkBoxRow($model,'pok23'); ?>

    <?php echo $form->checkBoxRow($model,'pok24'); ?>

    <?php echo $form->checkBoxRow($model,'pok25'); ?>
    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Ссылки:</legend></fieldset></div></div>    

    <?php echo $form->checkBoxRow($model,'pok26'); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <button class="btn" onclick="javascript:history.back()">Отмена</button>
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>
