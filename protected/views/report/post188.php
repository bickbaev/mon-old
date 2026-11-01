<h3><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></h3>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'post188',
    //'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

<!--<fieldset><legend>Форма 1. Аналитическая справка о проведенных в образовательной организации мероприятиях по профилактике правонарушений среди молодежи</legend></fieldset>-->

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>    

    <?php //echo $form->textAreaRow($model,'pok1',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok2',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok3',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok4',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok5',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok6',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok7',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php //echo $form->textAreaRow($model,'pok8',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<fieldset><legend>Форма 2. Отчет о проведенных мероприятиях</legend></fieldset>

    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok48',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok49',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok50',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok10',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok11',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok12',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok13',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok14',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok15',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok16',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok17',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok63',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'pok64',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'pok18',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok19',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok20',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok21',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok22',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textFieldRow($model,'pok23',array('class'=>'span1','maxlength'=>4)); ?>

<!--<fieldset><legend>Форма 3. Отчет о совершенных преступлениях и правонарушениях</legend></fieldset>-->

<!--<table  class="table table-bordered">
  <tr>
    <td rowspan="2">№ п/п</td>
    <td rowspan="2">Отчетные показатели</td>
    <td rowspan="2">Всего</td>
    <td colspan="2">из них участие:</td>
    <td rowspan="2">Динамика правонарушений и преступлений (в %)</td>
  </tr>
  <tr>
    <td>несовершеннолетних</td>
    <td>состоящих на учете в ИДН</td>
  </tr>
  <tr>
    <td rowspan="3">1</td>
    <td><strong>Количество преступлений, совершенных обучаемыми</strong></td>
    <td><?php /*echo $form->textFieldRow($model,'pok24',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok25',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok26',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok27',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>Количество участников</td>
    <td><?php echo $form->textFieldRow($model,'pok28',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok29',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok30',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok31',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>Из них привлечены к уголовной  ответственности</td>
    <td><?php echo $form->textFieldRow($model,'pok32',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok33',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok34',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok35',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td rowspan="3">2</td>
    <td><strong>Количество правонарушений, совершенных обучаемыми</strong></td>
    <td><?php echo $form->textFieldRow($model,'pok36',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok37',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok38',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok39',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>Количество участников</td>
    <td><?php echo $form->textFieldRow($model,'pok40',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok41',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok42',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok43',array('class'=>'span1')); ?></td>
  </tr>
  <tr>
    <td>Из них привлечены к  административной ответственности</td>
    <td><?php echo $form->textFieldRow($model,'pok44',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok45',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok46',array('class'=>'span1','maxlength'=>4)); ?></td>
    <td><?php echo $form->textFieldRow($model,'pok47',array('class'=>'span1'));*/ ?></td>
  </tr>     
</table>-->

    <?php echo $form->textFieldRow($model,'pok51',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textFieldRow($model,'pok52',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textAreaRow($model,'pok53',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php  echo $form->textFieldRow($model,'pok54',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textAreaRow($model,'pok55',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php  echo $form->textFieldRow($model,'pok56',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textAreaRow($model,'pok57',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php  echo $form->textFieldRow($model,'pok58',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textAreaRow($model,'pok59',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php  echo $form->textFieldRow($model,'pok60',array('class'=>'span1','maxlength'=>4)); ?>

    <?php  echo $form->textAreaRow($model,'pok61',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php  echo $form->textFieldRow($model,'pok60',array('class'=>'span1','maxlength'=>4)); ?>

   

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 