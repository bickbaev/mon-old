<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'site2024',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
));
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->report->est->id_est)))); ?>
</div>

<?php 
$dobavka = array();
if(!$model->p_date) $dobavka = array('checked'=>'checked');        
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model,'id_report') ?>

<p class="note"><b>Замечания по отчету:</b><br />
<?php
    if(Yii::app()->session['est'] == $id_est) echo CHtml::value($model,'remark');
    else echo $form->textArea($model,'remark', array('rows'=>6, 'cols'=>25, 'class'=>'span8'));
?>
</p>

<div class="row"><div class="span10 offset2"><p><a href="https://cposo.ru/images/2026/09-04/check_list_v5_7.docx"><strong>Чек-лист</strong></a><br><a href="https://cposo.ru/?view=article&id=2565&catid=19"><strong>Остальные материалы</strong></a></p></div></div>

<div style="margin-left: 75px; margin-bottom: 10px;margin-top: 30px;">Адрес сайта<span style="margin-left:25px;"><?php echo CHtml::link($model->site2, $model->site2, array('target'=>'_blank')); ?></span></div>

<div class="row"><div class="span10 offset2"><fieldset><legend>Общие показатели</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok1',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok2',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok3',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok4',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok5',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok6',$dobavka); ?>
<?php echo $form->checkBoxRow($model,'pok7'); ?>
<?php echo $form->checkBoxRow($model,'pok8'); ?> 
<div class="row"><div class="span10 offset2"><fieldset><legend>Основные сведения</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok9'); ?>
<?php echo $form->checkBoxRow($model,'pok10'); ?>
<?php echo $form->checkBoxRow($model,'pok11'); ?>
<?php echo $form->checkBoxRow($model,'pok12'); ?>
<?php echo $form->checkBoxRow($model,'pok13'); ?>
<?php echo $form->checkBoxRow($model,'pok14'); ?>    
<?php echo $form->checkBoxRow($model,'pok15'); ?>
<?php echo $form->checkBoxRow($model,'pok16'); ?>
<?php echo $form->checkBoxRow($model,'pok17'); ?>
<?php //echo $form->checkBoxRow($model,'pok18'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Структура и органы управления образовательной организацией</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok19'); ?>
<?php echo $form->checkBoxRow($model,'pok20'); ?> 
<?php echo $form->checkBoxRow($model,'pok21'); ?>
<?php echo $form->checkBoxRow($model,'pok22'); ?>
<?php echo $form->checkBoxRow($model,'pok23'); ?>
<?php echo $form->checkBoxRow($model,'pok24'); ?>
<?php echo $form->checkBoxRow($model,'pok25'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Документы</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok26'); ?>
<?php echo $form->checkBoxRow($model,'pok27'); ?>
<?php echo $form->checkBoxRow($model,'pok28'); ?>
<?php echo $form->checkBoxRow($model,'pok29'); ?>
<?php echo $form->checkBoxRow($model,'pok30'); ?>
<?php echo $form->checkBoxRow($model,'pok31'); ?>
<?php echo $form->checkBoxRow($model,'pok32'); ?>
<?php echo $form->checkBoxRow($model,'pok33'); ?>    
<?php echo $form->checkBoxRow($model,'pok34'); ?>    
<?php echo $form->checkBoxRow($model,'pok35'); ?>
<?php echo $form->checkBoxRow($model,'pok36'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Образование</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok18'); ?>
<?php echo $form->checkBoxRow($model,'pok37'); ?>
<?php echo $form->checkBoxRow($model,'pok38'); ?>
<?php echo $form->checkBoxRow($model,'pok39'); ?>    
<?php echo $form->checkBoxRow($model,'pok40'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Руководство</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok41'); ?>
<?php echo $form->checkBoxRow($model,'pok42'); ?>
<?php echo $form->checkBoxRow($model,'pok43'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Педагогический состав</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok44'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Материально-техническое обеспечение и оснащенность образовательного процесса. Доступная среда</legend></fieldset></div></div>
<div class="row"><div class="span10 offset2"><p><strong>о материально-техническом обеспечении образовательной деятельности, в том числе в отношении инвалидов и лиц с ограниченными возможностями здоровья:</strong></p></div></div>
<?php echo $form->checkBoxRow($model,'pok45'); ?>
<?php echo $form->checkBoxRow($model,'pok46'); ?>
<?php echo $form->checkBoxRow($model,'pok47'); ?>       
<?php echo $form->checkBoxRow($model,'pok48'); ?>
<?php echo $form->checkBoxRow($model,'pok49'); ?>
<?php echo $form->checkBoxRow($model,'pok50'); ?>
<?php echo $form->checkBoxRow($model,'pok51'); ?>
<?php echo $form->checkBoxRow($model,'pok52'); ?>
<?php echo $form->checkBoxRow($model,'pok53'); ?>    
<?php echo $form->checkBoxRow($model,'pok54'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Платные образовательные услуги (все электронные документы)</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok55'); ?>
<?php echo $form->checkBoxRow($model,'pok56'); ?>
<?php echo $form->checkBoxRow($model,'pok57'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Финансово-хозяйственная деятельность</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok58'); ?>
<?php echo $form->checkBoxRow($model,'pok59'); ?>
<?php echo $form->checkBoxRow($model,'pok60'); ?>
<?php echo $form->checkBoxRow($model,'pok61'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Вакантные места для приема (перевода) обучающихся</legend></fieldset></div></div>
<div class="row"><div class="span10 offset2"><p><strong>Должна содержать информацию о количестве вакантных мест для приема (перевода) обучающихся по каждой реализуемой образовательной программе, по каждой реализуемой специальности, по каждому реализуемому направлению подготовки, по каждой научной специальности, по каждой реализуемой профессии </strong></p></div></div>
<?php echo $form->checkBoxRow($model,'pok62'); ?>
<?php echo $form->checkBoxRow($model,'pok63'); ?>
<?php echo $form->checkBoxRow($model,'pok64'); ?>
<?php echo $form->checkBoxRow($model,'pok65'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Стипендии и меры поддержки обучающихся</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok66'); ?>
<?php echo $form->checkBoxRow($model,'pok67'); ?>
<?php echo $form->checkBoxRow($model,'pok68'); ?>    
<?php echo $form->checkBoxRow($model,'pok69'); ?>    
<?php echo $form->checkBoxRow($model,'pok70'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Международное сотрудничество</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok71'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Организация питания в образовательной организации</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok72'); ?>
<?php echo $form->checkBoxRow($model,'pok73'); ?>
<?php echo $form->checkBoxRow($model,'pok74'); ?>      
<?php echo $form->checkBoxRow($model,'pok75'); ?>
<?php echo $form->checkBoxRow($model,'pok76'); ?>
<?php echo $form->checkBoxRow($model,'pok77'); ?>
<div class="row"><div class="span10 offset2"><fieldset><legend>Образовательные стандарты и требования</legend></fieldset></div></div>
<?php echo $form->checkBoxRow($model,'pok78'); ?>
<?php echo $form->checkBoxRow($model,'pok79'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->report->est->id_est)))); ?>
</div>

<?php $this->endWidget(); ?> 
<script type="text/javascript">
$(document).ready(function(){
    if(!$('#Site2024_pok19').prop('checked')) {
        $('#Site2024_pok20').removeAttr('disabled'); 
        $('#Site2024_pok21').removeAttr('disabled');
        $('#Site2024_pok22').removeAttr('disabled');
        $('#Site2024_pok23').removeAttr('disabled');
        $('#Site2024_pok24').removeAttr('disabled');
        $('#Site2024_pok25').removeAttr('disabled');
        $('#Site2024_pok43').removeAttr('disabled');
    }
    else { 
        $('#Site2024_pok20').attr('disabled', ''); 
        $('#Site2024_pok21').attr('disabled', '');
        $('#Site2024_pok22').attr('disabled', '');
        $('#Site2024_pok23').attr('disabled', '');
        $('#Site2024_pok24').attr('disabled', '');
        $('#Site2024_pok25').attr('disabled', '');
        $('#Site2024_pok43').attr('disabled', '');        
    }   
});    
$('#Site2024_pok19').change(function () {
    if(!$(this).prop('checked')) {
        $('#Site2024_pok20').removeAttr('disabled'); 
        $('#Site2024_pok21').removeAttr('disabled');
        $('#Site2024_pok22').removeAttr('disabled');
        $('#Site2024_pok23').removeAttr('disabled');
        $('#Site2024_pok24').removeAttr('disabled');
        $('#Site2024_pok25').removeAttr('disabled');
        $('#Site2024_pok43').removeAttr('disabled');        
    }
    else {
        $('#Site2024_pok20').attr('disabled', ''); 
        $('#Site2024_pok21').attr('disabled', '');
        $('#Site2024_pok22').attr('disabled', '');
        $('#Site2024_pok23').attr('disabled', '');
        $('#Site2024_pok24').attr('disabled', '');
        $('#Site2024_pok25').attr('disabled', '');
        $('#Site2024_pok43').attr('disabled', '');          
    }
});
</script>
