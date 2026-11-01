<h3><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></h3>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'post196',
    //'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>   

<fieldset><legend>Отчет о проведенных мероприятиях по профилактике правонарушений среди лиц, проповедующих идеи экстремизма, способствующих деятельности правоохранительных органов по пресечению терроризма</legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok2',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok4',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok5',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok6',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok7',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok8',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok10',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok11',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok12',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textAreaRow($model,'pok13',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textAreaRow($model,'pok14',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok15',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok16',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok17',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok18',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->checkBoxRow($model,'pok19'); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 