<h3><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></h3>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'post195',
    //'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>   

<fieldset><legend>Форма 1. Отчет о проведенных мероприятиях по профилактике наркомании и связанных с ней правонарушений среди несовершеннолетних и молодежи в соответствии с показателями</legend></fieldset>

   <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok2',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok4',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok5',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok6',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok23',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok7',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok8',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok24',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok10',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok11',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok12',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok13',array('class'=>'span1','maxlength'=>4)); ?>

<!--<fieldset><legend>Форма 2.</legend></fieldset>

<table class="table table-bordered">
  <tr>
    <td>Отчетный показатель</td>
    <td>Всего </td>
    <td>Из них несовершеннолетних</td>
    <td>Динамика правонарушений (в %)</td>
  </tr>
  <tr>
    <td>Поставлено на учет</td>
    <td><?php /*echo $form->textFieldRow($model,'pok14',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok15',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok16',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>В том числе за употребление наркотиков</td>
    <td><?php echo $form->textFieldRow($model,'pok17',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok18',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok19',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>Выявлено употребляющих наркотики</td>
    <td><?php echo $form->textFieldRow($model,'pok20',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok21',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok22',array('class'=>'span1'));*/ ?></td>
  </tr>
</table>-->


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 