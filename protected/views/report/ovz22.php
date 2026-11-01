<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'ovz22-form',
    'type'=>'vertical',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
<fieldset><legend>Локальные акты ОО, регламентирующие образование детей с ОВЗ и/или инвалидностью, в т.ч. и обучение на дому</legend></fieldset>    

    <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok2',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok4',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok5',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok6',array('class'=>'span7')); ?>

    <?php echo $form->textFieldRow($model,'pok7',array('class'=>'span7')); ?>

    <?php echo $form->checkBoxRow($model, 'pok8');?>

<fieldset><legend>Количество обучающихся с ОВЗ и/или инвалидностью на дому </legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span1')); ?>

    <h5>из них:</h5>
    
    <?php echo $form->textFieldRow($model,'pok10',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok11',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok12',array('class'=>'span1')); ?>
    
<fieldset><legend>Формы организация обучения на дому</legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok13',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok14',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok15',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok16',array('class'=>'span1')); ?>

<fieldset><legend>Документы, подтверждающие возможность получения образования   на дому</legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok17',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok18',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok19',array('class'=>'span1')); ?>

<fieldset><legend>Документы, регламентирующие содержание обучения на дому</legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok20',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok21',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok22',array('class'=>'span1')); ?>

    <?php echo $form->checkBoxRow($model, 'pok23');?>

    <?php echo $form->checkBoxRow($model, 'pok24');?>
    
    <?php echo $form->checkBoxRow($model, 'pok25');?>

<fieldset><legend>Недельная нагрузка (в часах)</fieldset>
<p><strong>С точностью до десятых. Разделитель разрядов - точка.</strong></p>

    <?php echo $form->textFieldRow($model,'pok26',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok27',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok28',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok29',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok30',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok31',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok32',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok33',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok34',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok35',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok36',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok37',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok38',array('class'=>'span1')); ?>

<fieldset><legend>Продолжительность индивидуального занятия /урока (в мин)</fieldset>
<p><strong>Целое число</strong></p>

    <?php echo $form->textFieldRow($model,'pok39',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok40',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok41',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok42',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok43',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok44',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok45',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok46',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok47',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok48',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok49',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok50',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok51',array('class'=>'span1')); ?>

<fieldset><legend>Недельный объем внеурочной деятельности (в часах)</fieldset>
<p><strong>С точностью до десятых. Разделитель разрядов - точка.</strong></p>

    <?php echo $form->textFieldRow($model,'pok52',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok53',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok54',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok55',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok56',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok57',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok58',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok59',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok60',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok61',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok62',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok63',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok64',array('class'=>'span1')); ?>

<fieldset><legend>из них: коррекционно-развивающая область (в часах)</fieldset>
<p><strong>С точностью до десятых. Разделитель разрядов - точка.</strong></p>

    <?php echo $form->textFieldRow($model,'pok65',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok66',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok67',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok68',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok69',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok70',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok71',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok72',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok73',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok74',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok75',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok76',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok77',array('class'=>'span1')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=> Report::model()->findByPk($model->id_report)->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>    

