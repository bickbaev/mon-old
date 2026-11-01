<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'kino2022-form',
    'type'=>'vertical',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <div class="row" style="margin-top: 30px;"><div class="span8"><legend>Информация о кураторе</legend></div></div>

    <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok2',array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok4',array('class'=>'span5')); ?>

    <?php 
        echo $form->labelEx($model,'pok5');
        echo '<span style="font-size: 20px; display: inline-block; height: 20px; padding-right:10px;">+7</span>'.$form->textField($model,'pok5',array('class'=>'span2')).'';
    ?>

    <?php echo $form->textFieldRow($model,'pok6',array('class'=>'span3')); ?>
    
    <?php $monthes = array(
        1 => 'январь', 2 => 'февраль', 3 => 'март', 4 => 'апрель',
        5 => 'май', 6 => 'июнь', 7 => 'июль', 8 => 'август',
        9 => 'сентябрь', 10 => 'октябрь', 11 => 'ноябрь', 12 => 'декабрь'
    ); ?>
    
    <div class="row" style="margin-top: 30px;"><div class="span8"><legend>Информация о реализации проекта "Киноуроки в школах России" за <?php echo $monthes[date('n', strtotime($model->report->rep_name->s_date))].' '.date('Y', strtotime($model->report->rep_name->s_date)); ?>  года (функции редактирования доступны до последней даты текущего месяца)
</legend></div></div>

    <?php echo $form->textFieldRow($model,'pok7',array('class'=>'span1')); ?> 
    
    <?php echo $form->textFieldRow($model,'pok8',array('class'=>'span1')); ?>
    
    <?php echo $form->textAreaRow($model,'pok9',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=> Report::model()->findByPk($model->id_report)->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>        

