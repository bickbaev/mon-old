<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'ovz24-form',
    'type'=>'vertical',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>


    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения. Если нет данных, ставьте 0 (ноль).</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'id_report') ?>    
    
    <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok2',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok4',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok5',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok6',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok7',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok8',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model, 'pok10',array('class'=>'span1'));?>

    <?php echo $form->textFieldRow($model,'pok11',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok12',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok13',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok14',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok15',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok16',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok17',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok18',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok19',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok20',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok21',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok22',array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok23',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok24',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok25',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok26',array('class'=>'span1')); ?>
  

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=> Report::model()->findByPk($model->id_report)->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>    
