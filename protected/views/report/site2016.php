<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'site2016',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
));
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
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
    <div style="margin-left: 75px; margin-bottom: 10px;margin-top: 30px;">Адрес сайта<span style="margin-left:25px;"><?php echo CHtml::link($model->site2, $model->site2, array('target'=>'_blank')); ?></span></div>
    <?php echo $form->checkBoxRow($model,'pok0'); ?>
    <hr>
    <?php echo $form->checkBoxRow($model,'pok1'); ?>
    <?php echo $form->checkBoxRow($model,'pok2'); ?>
    <?php echo $form->checkBoxRow($model,'pok3'); ?>
    <?php echo $form->checkBoxRow($model,'pok4'); ?>
    <hr>
    <?php echo $form->checkBoxRow($model,'pok5',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok6',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok7',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok8',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok9',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok10',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok11',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok12',$dobavka); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Основные сведения»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok13'); ?>
    <?php echo $form->checkBoxRow($model,'pok14'); ?>
    <?php echo $form->checkBoxRow($model,'pok15'); ?>
    <?php echo $form->checkBoxRow($model,'pok16'); ?>
    <?php echo $form->checkBoxRow($model,'pok17'); ?>
    <?php echo $form->checkBoxRow($model,'pok18'); ?>
    <?php echo $form->checkBoxRow($model,'pok78'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Структура и органы управления образовательной организацией»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok19'); ?>
    <?php echo $form->checkBoxRow($model,'pok20'); ?>
    <?php echo $form->checkBoxRow($model,'pok21'); ?>
    <?php echo $form->checkBoxRow($model,'pok22'); ?>
    <?php echo $form->checkBoxRow($model,'pok23'); ?>
    <?php echo $form->checkBoxRow($model,'pok24'); ?>
    <?php echo $form->checkBoxRow($model,'pok25'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Документы»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok26'); ?>
    <?php echo $form->checkBoxRow($model,'pok27'); ?>
    <?php echo $form->checkBoxRow($model,'pok28'); ?>
    <?php echo $form->checkBoxRow($model,'pok29'); ?>
    <?php echo $form->checkBoxRow($model,'pok30'); ?>
    <?php echo $form->checkBoxRow($model,'pok31'); ?>
    <?php echo $form->checkBoxRow($model,'pok32'); ?>
    <?php echo $form->checkBoxRow($model,'pok76'); ?>
    <?php echo $form->checkBoxRow($model,'pok33'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Образование»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok34'); ?>
    <?php echo $form->checkBoxRow($model,'pok35'); ?>
    <?php echo $form->checkBoxRow($model,'pok36'); ?>
    <?php echo $form->checkBoxRow($model,'pok37'); ?>
    <?php echo $form->checkBoxRow($model,'pok38'); ?>
    <?php echo $form->checkBoxRow($model,'pok39'); ?>
    <?php echo $form->checkBoxRow($model,'pok40'); ?>
    <?php echo $form->checkBoxRow($model,'pok41'); ?>
    <?php echo $form->checkBoxRow($model,'pok42'); ?>
    <?php echo $form->checkBoxRow($model,'pok43'); ?>
    <?php echo $form->checkBoxRow($model,'pok44'); ?>
    <?php echo $form->checkBoxRow($model,'pok77'); ?>
    <?php echo $form->checkBoxRow($model,'pok45'); ?>
    <?php echo $form->checkBoxRow($model,'pok74'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Образовательные стандарты»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok46',$dobavka); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Руководство. Педагогический состав»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok47'); ?>
    <?php echo $form->checkBoxRow($model,'pok48'); ?>
    <?php echo $form->checkBoxRow($model,'pok49'); ?>
    <?php echo $form->checkBoxRow($model,'pok50'); ?>
    <?php echo $form->checkBoxRow($model,'pok51'); ?>
    <?php echo $form->checkBoxRow($model,'pok52'); ?>
    <?php echo $form->checkBoxRow($model,'pok53'); ?>
    <?php echo $form->checkBoxRow($model,'pok54'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Материально-техническое обеспечение и оснащенность образовательного процесса»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok55'); ?>
    <?php echo $form->checkBoxRow($model,'pok56'); ?>
    <?php echo $form->checkBoxRow($model,'pok57'); ?>
    <?php echo $form->checkBoxRow($model,'pok58'); ?>
    <?php echo $form->checkBoxRow($model,'pok59'); ?>
    <?php echo $form->checkBoxRow($model,'pok60'); ?>
    <?php echo $form->checkBoxRow($model,'pok61'); ?>
    <?php echo $form->checkBoxRow($model,'pok62'); ?>
    <?php echo $form->checkBoxRow($model,'pok63'); ?>
    <?php echo $form->checkBoxRow($model,'pok72'); ?>
    <?php echo $form->checkBoxRow($model,'pok73'); ?>    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Стипендии и иные виды материальной поддержки»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok64',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok65'); ?>
    <?php echo $form->checkBoxRow($model,'pok66'); ?>
    <?php echo $form->checkBoxRow($model,'pok67'); ?>
    <?php echo $form->checkBoxRow($model,'pok68'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Платные образовательные услуги»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok69'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Финансово-хозяйственная деятельность»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok70'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Вакантные места для приема (перевода)»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok71',$dobavka); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Дополнительные параметры:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok75'); ?> 
    <?php echo $form->checkBoxRow($model,'pok79'); ?>
    
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 
    
<script type="text/javascript">   
$(document).ready(function(){
    if($('#Site2016_pok1').attr("checked") != 'checked') {     
        $('#Site2016_pok20').attr('disabled', '');
        $('#Site2016_pok21').attr('disabled', '');
        $('#Site2016_pok22').attr('disabled', '');
        $('#Site2016_pok23').attr('disabled', '');
        $('#Site2016_pok24').attr('disabled', '');
        $('#Site2016_pok25').attr('disabled', '');
    }
    else {     
        $('#Site2016_pok20').removeAttr('disabled'); 
        $('#Site2016_pok21').removeAttr('disabled');
        $('#Site2016_pok22').removeAttr('disabled');
        $('#Site2016_pok23').removeAttr('disabled');
        $('#Site2016_pok24').removeAttr('disabled');
        $('#Site2016_pok25').removeAttr('disabled');
    }
    if($('#Site2016_pok2').attr("checked") != 'checked') {     
        $('#Site2016_pok49').attr('disabled', '');
        $('#Site2016_pok50').attr('disabled', '');
    }
    else {     
        $('#Site2016_pok49').removeAttr('disabled'); 
        $('#Site2016_pok50').removeAttr('disabled');
    }
    if($('#Site2016_pok3').attr("checked") != 'checked') {     
        $('#Site2016_pok65').attr('disabled', '');
        $('#Site2016_pok66').attr('disabled', '');
        $('#Site2016_pok67').attr('disabled', '');
    }
    else {     
        $('#Site2016_pok65').removeAttr('disabled'); 
        $('#Site2016_pok66').removeAttr('disabled');
        $('#Site2016_pok67').removeAttr('disabled');
    }    
    if($('#Site2016_pok4').attr("checked") != 'checked') {     
        $('#Site2016_pok68').attr('disabled', '');
    }
    else {     
        $('#Site2016_pok68').removeClass('disabled');
        $('#Site2016_pok68').removeAttr('disabled');  
    }    
});
$('#Site2016_pok1').change(function () {
    if($(this).attr("checked") != 'checked') {       
        $('#Site2016_pok20').val("");
        $('#Site2016_pok20').attr('disabled', '');
        $('#Site2016_pok21').val("");
        $('#Site2016_pok21').attr('disabled', '');
        $('#Site2016_pok22').val("");
        $('#Site2016_pok22').attr('disabled', '');
        $('#Site2016_pok23').val("");
        $('#Site2016_pok23').attr('disabled', '');        
        $('#Site2016_pok24').val("");
        $('#Site2016_pok24').attr('disabled', '');
        $('#Site2016_pok25').val("");
        $('#Site2016_pok25').attr('disabled', '');        
    }
    else {        
        $('#Site2016_pok20').removeAttr('disabled'); 
        $('#Site2016_pok21').removeAttr('disabled'); 
        $('#Site2016_pok22').removeAttr('disabled'); 
        $('#Site2016_pok23').removeAttr('disabled'); 
        $('#Site2016_pok24').removeAttr('disabled'); 
        $('#Site2016_pok25').removeAttr('disabled');         
    }
});
$('#Site2016_pok2').change(function () {
    if($(this).attr("checked") != 'checked') {       
        $('#Site2016_pok49').val("");
        $('#Site2016_pok49').attr('disabled', '');
        $('#Site2016_pok50').val("");
        $('#Site2016_pok50').attr('disabled', '');    
    }
    else {        
        $('#Site2016_pok49').removeAttr('disabled'); 
        $('#Site2016_pok50').removeAttr('disabled');       
    }
});
$('#Site2016_pok3').change(function () {
    if($(this).attr("checked") != 'checked') {       
        $('#Site2016_pok65').val("");
        $('#Site2016_pok65').attr('disabled', '');
        $('#Site2016_pok66').val("");
        $('#Site2016_pok66').attr('disabled', '');
        $('#Site2016_pok67').val("");
        $('#Site2016_pok67').attr('disabled', '');          
    }
    else {        
        $('#Site2016_pok65').removeAttr('disabled'); 
        $('#Site2016_pok66').removeAttr('disabled'); 
        $('#Site2016_pok67').removeAttr('disabled');
    }
});
$('#Site2016_pok4').change(function () {
    if($(this).attr("checked") != 'checked') {
        $('#Site2016_pok68').val("");
        $('#Site2016_pok68').attr('class', 'disabled');
        $('#Site2016_pok68').attr('disabled', '');
    }
    else {
        $('#Site2016_pok68').removeClass('disabled');
        $('#Site2016_pok68').removeAttr('disabled');       
    }
});
 
</script>    