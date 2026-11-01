<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'arch-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php echo $form->DropDownListRow($model, 'pok1', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'pok2', array('class'=>'span5')); ?>

    <?php echo $form->DropDownListRow($model, 'pok3', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'pok4', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'pok5'); ?>

    <?php echo $form->textFieldRow($model,'pok6'); ?>


<div class="row"><div class="span10 offset2"><fieldset><legend>I. Общие мероприятия для инвалидов в здании:</legend></fieldset></div></div>  

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
    <?php echo $form->checkBoxRow($model,'pok19'); ?>
    <?php echo $form->checkBoxRow($model,'pok20'); ?>
    <?php echo $form->checkBoxRow($model,'pok21'); ?>
    <?php echo $form->checkBoxRow($model,'pok22'); ?>
    <?php echo $form->checkBoxRow($model,'pok23'); ?>
    <?php echo $form->checkBoxRow($model,'pok24'); ?>
    <?php echo $form->checkBoxRow($model,'pok25'); ?>
    <?php echo $form->checkBoxRow($model,'pok26'); ?>

<div class="row"><div class="span10 offset2"><fieldset><legend>II. Специальные мероприятия для инвалидов в здании:</legend></fieldset></div></div>
<div class="row"><div class="span10 offset2"><h5>Парковка</h5></div></div>
    <?php echo $form->checkBoxRow($model,'pok27'); ?>
    <?php echo $form->checkBoxRow($model,'pok28'); ?>
    <?php echo $form->checkBoxRow($model,'pok29'); ?>
    <?php echo $form->checkBoxRow($model,'pok30'); ?>
<div class="row"><div class="span10 offset2"><h5>Вход в здание и учреждение</h5></div></div>
    <?php echo $form->checkBoxRow($model,'pok31'); ?>
    <?php echo $form->checkBoxRow($model,'pok32'); ?>
    <?php echo $form->checkBoxRow($model,'pok33'); ?>
    <?php echo $form->checkBoxRow($model,'pok34'); ?>
    <?php echo $form->textFieldRow($model,'pok35'); ?>
    <?php echo $form->textFieldRow($model,'pok36'); ?>
<div class="row"><div class="span10 offset2"><h5>Вспомогательные компенсирующие средства для инвалидов на креслах-колясках</h5></div></div>
    <?php echo $form->checkBoxRow($model,'pok37'); ?>
    <?php echo $form->checkBoxRow($model,'pok38'); ?>
    <?php echo $form->checkBoxRow($model,'pok39'); ?>
<div class="row"><div class="span10 offset2"><h5>Входная лестница</h5></div></div>
    <?php echo $form->radioButtonListInlineRow($model, 'pok40', array('1'=>'Одномаршевая', '2'=>'С промежуточными площадками', '3'=>'Винтовая'));?>
    <?php echo $form->checkBoxRow($model,'pok41'); ?>
<div class="row"><div class="span10 offset2"><h5>Характеристики материала наружной лестницы</h5></div></div>.
    <?php echo $form->radioButtonListInlineRow($model, 'pok42', array('1'=>'Бетонная', '2'=>'Металлическая', '3'=>'Керамогранит'));?>
    <?php echo $form->textFieldRow($model,'pok43'); ?>
<div class="row"><div class="span10 offset2"><h5>Характеристики внутренней лестницы</h5></div></div>.
    <?php echo $form->radioButtonListInlineRow($model, 'pok44', array('1'=>'Бетонная', '2'=>'Металлическая', '3'=>'Керамогранит'));?>
    <?php echo $form->textFieldRow($model,'pok45'); ?>
<div class="row"><div class="span10 offset2"><h5>Входная дверь в здание</h5></div></div>.
    <?php echo $form->textFieldRow($model,'pok46'); ?> 
    <?php echo $form->checkBoxRow($model,'pok47'); ?>
    <?php echo $form->radioButtonListInlineRow($model, 'pok48', array('1'=>'Одна створка распашная', '2'=>'Две створки распашных', '3'=>'Автоматическая раздвижная', '4'=>'Открывается в обе стороны (качающаяся)', '5'=>'Автоматическая распашная', '6'=>'Вращающаяся (вертушка)'));?>
<div class="row"><div class="span10 offset2"><h5>Материал дверного полотна</h5></div></div>.
    <?php echo $form->checkBoxRow($model,'pok49'); ?>
    <?php echo $form->radioButtonListInlineRow($model, 'pok50', array('1'=>'без доводчика', '2'=>'c доводчиком'));?>
    <?php echo $form->checkBoxRow($model,'pok51'); ?>
<div class="row"><div class="span10 offset2"><h5>Санитарно-бытовые помещения для инвалидов, в том числе для инвалидов на колясках</h5></div></div>.
    <?php echo $form->checkBoxRow($model,'pok52'); ?>
    <?php echo $form->checkBoxRow($model,'pok53'); ?>
    <?php echo $form->checkBoxRow($model,'pok54'); ?>    
    <?php echo $form->checkBoxRow($model,'pok55'); ?>
    <?php echo $form->checkBoxRow($model,'pok56'); ?>
    <?php echo $form->checkBoxRow($model,'pok57'); ?>
    <?php echo $form->checkBoxRow($model,'pok58'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>III. Общие мероприятия, проведенные в период подготовки здания к 2020-2021 учебному году</legend></fieldset></div></div>    
    <?php echo $form->checkBoxRow($model,'pok59'); ?>
    <?php echo $form->checkBoxRow($model,'pok60'); ?>
    <?php echo $form->checkBoxRow($model,'pok61'); ?>
    <?php echo $form->checkBoxRow($model,'pok62'); ?>
    <?php echo $form->checkBoxRow($model,'pok63'); ?>
    <?php echo $form->textFieldRow($model,'pok64'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('arch20/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>        

