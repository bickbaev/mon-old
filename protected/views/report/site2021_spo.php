<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'site2021_spo',
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
    <div style="margin-left: 75px; margin-bottom: 10px;margin-top: 30px;">Адрес сайта<span style="margin-left:25px;"><?php echo CHtml::link($model->site2, $model->site2, array('target'=>'_blank')); ?></span></div>
    <?php echo $form->checkBoxRow($model,'pok1',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok2',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok3',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok4',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok5',$dobavka); ?>
    <?php echo $form->checkBoxRow($model,'pok6',$dobavka); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Основные сведения»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok7'); ?>
    <?php echo $form->checkBoxRow($model,'pok8'); ?>
    <?php echo $form->checkBoxRow($model,'pok9'); ?>
    <?php echo $form->checkBoxRow($model,'pok10'); ?>
    <?php echo $form->checkBoxRow($model,'pok18'); ?>
    <?php echo $form->checkBoxRow($model,'pok11'); ?>
    <?php echo $form->checkBoxRow($model,'pok12'); ?>    
    <?php echo $form->checkBoxRow($model,'pok13'); ?>
    <?php echo $form->checkBoxRow($model,'pok14'); ?>
    <?php echo $form->checkBoxRow($model,'pok15'); ?>
    <?php echo $form->checkBoxRow($model,'pok16'); ?>
    <?php echo $form->checkBoxRow($model,'pok17'); ?>    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Структура и органы управления образовательной организацией»:</legend></fieldset></div></div>        
    <?php echo $form->checkBoxRow($model,'pok19'); ?>
    <?php echo $form->checkBoxRow($model,'pok25'); ?>    
    <?php echo $form->checkBoxRow($model,'pok20'); ?>
    <?php echo $form->checkBoxRow($model,'pok21'); ?>
    <?php echo $form->checkBoxRow($model,'pok22'); ?>
    <?php echo $form->checkBoxRow($model,'pok23'); ?>
    <?php echo $form->checkBoxRow($model,'pok24'); ?>    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Документы»:</legend></fieldset></div></div>
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
    <?php echo $form->checkBoxRow($model,'pok37'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Образование»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok38'); ?>
    <?php echo $form->checkBoxRow($model,'pok39'); ?>
    <?php echo $form->checkBoxRow($model,'pok40'); ?>
    <?php echo $form->checkBoxRow($model,'pok41'); ?>
    <?php echo $form->checkBoxRow($model,'pok42'); ?>
    <?php echo $form->checkBoxRow($model,'pok43'); ?>
    <?php echo $form->checkBoxRow($model,'pok44'); ?>    
    <?php echo $form->checkBoxRow($model,'pok45'); ?>        
    <?php echo $form->checkBoxRow($model,'pok46'); ?>   
    <?php echo $form->checkBoxRow($model,'pok47'); ?>    
    <?php echo $form->checkBoxRow($model,'pok48'); ?>
    <?php echo $form->checkBoxRow($model,'pok49'); ?>
    <?php echo $form->checkBoxRow($model,'pok50'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Образовательные стандарты»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok51'); ?>    
    <?php echo $form->checkBoxRow($model,'pok52'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Руководство. Педагогический состав»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok53'); ?>
    <?php echo $form->checkBoxRow($model,'pok54'); ?>    
    <?php echo $form->checkBoxRow($model,'pok55'); ?>
    <?php echo $form->checkBoxRow($model,'pok56'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Материально-техническое обеспечение и оснащенность образовательного процесса»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok57'); ?>
    <?php echo $form->checkBoxRow($model,'pok58'); ?>
    <?php echo $form->checkBoxRow($model,'pok59'); ?>
    <?php echo $form->checkBoxRow($model,'pok60'); ?>
    <?php echo $form->checkBoxRow($model,'pok61'); ?>        
    <?php echo $form->checkBoxRow($model,'pok62'); ?>
    <?php echo $form->checkBoxRow($model,'pok63'); ?>        
    <?php echo $form->checkBoxRow($model,'pok64'); ?>
    <?php echo $form->checkBoxRow($model,'pok65'); ?>
    <?php echo $form->checkBoxRow($model,'pok66'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Стипендии и иные виды материальной поддержки»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok67'); ?>        
    <?php echo $form->checkBoxRow($model,'pok68'); ?>    
    <?php echo $form->checkBoxRow($model,'pok69'); ?>    
    <?php echo $form->checkBoxRow($model,'pok70'); ?>        
    <?php echo $form->checkBoxRow($model,'pok71'); ?>
    <?php echo $form->checkBoxRow($model,'pok72'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Платные образовательные услуги»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok73'); ?>
    <?php echo $form->checkBoxRow($model,'pok74'); ?>        
    <?php echo $form->checkBoxRow($model,'pok75'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Финансово-хозяйственная деятельность»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok76'); ?>
    <?php echo $form->checkBoxRow($model,'pok77'); ?>
    <?php echo $form->checkBoxRow($model,'pok78'); ?>    
    <?php echo $form->checkBoxRow($model,'pok79'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел «Вакантные места для приема (перевода)»:</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok80'); ?>
    <?php echo $form->checkBoxRow($model,'pok81'); ?>
    <?php echo $form->checkBoxRow($model,'pok82'); ?>
    <?php echo $form->checkBoxRow($model,'pok83'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел "Доступная среда":</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok84'); ?>
    <?php echo $form->checkBoxRow($model,'pok85'); ?>
    <?php echo $form->checkBoxRow($model,'pok86'); ?>
    <?php echo $form->checkBoxRow($model,'pok87'); ?>
    <?php echo $form->checkBoxRow($model,'pok88'); ?>
    <?php echo $form->checkBoxRow($model,'pok89'); ?>
    <?php echo $form->checkBoxRow($model,'pok90'); ?>
    <?php echo $form->checkBoxRow($model,'pok91'); ?>    
    <?php echo $form->checkBoxRow($model,'pok92'); ?>
    <?php echo $form->checkBoxRow($model,'pok93'); ?>
    <?php echo $form->checkBoxRow($model,'pok94'); ?>
    <?php echo $form->checkBoxRow($model,'pok95'); ?>
    <?php echo $form->checkBoxRow($model,'pok96'); ?>
    <div class="row"><div class="span10 offset2"><fieldset><legend>Подраздел "Международное сотрудничество":</legend></fieldset></div></div>
    <?php echo $form->checkBoxRow($model,'pok97'); ?>
    <?php echo $form->checkBoxRow($model,'pok98'); ?>    
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->report->est->id_est)))); ?>
</div>

<?php $this->endWidget(); ?> 
<script type="text/javascript">
$(document).ready(function(){
    if($('#Site2021_pok18').prop('checked')) {     
        $('#Site2021_pok16').attr('disabled', '');
        $('#Site2021_pok55').attr('disabled', '');
    }
    else {     
        $('#Site2021_pok16').removeAttr('disabled'); 
        $('#Site2021_pok55').removeAttr('disabled');
    }
    if($('#Site2021_pok25').prop('checked')) {     
        $('#Site2021_pok20').attr('disabled', '');
        $('#Site2021_pok21').attr('disabled', '');
        $('#Site2021_pok22').attr('disabled', '');
        $('#Site2021_pok23').attr('disabled', '');
        $('#Site2021_pok24').attr('disabled', '');          
    }
    else {     
        $('#Site2021_pok20').removeAttr('disabled'); 
        $('#Site2021_pok21').removeAttr('disabled');
        $('#Site2021_pok22').removeAttr('disabled'); 
        $('#Site2021_pok23').removeAttr('disabled');
        $('#Site2021_pok24').removeAttr('disabled');         
    }    
});    
$('#Site2021_spo_pok18').change(function () {
    if($(this).prop('checked')) {       
        $('#Site2021_spo_pok16').val("");
        $('#Site2021_spo_pok16').attr('disabled', '');
        $('#Site2021_spo_pok55').val("");
        $('#Site2021_spo_pok55').attr('disabled', '');       
    }
    else {        
        $('#Site2021_spo_pok16').removeAttr('disabled'); 
        $('#Site2021_spo_pok55').removeAttr('disabled');         
    }
});
$('#Site2021_spo_pok25').change(function () {
    if($(this).prop('checked')) {       
        $('#Site2021_spo_pok20').val("");
        $('#Site2021_spo_pok20').attr('disabled', '');
        $('#Site2021_spo_pok21').val("");
        $('#Site2021_spo_pok21').attr('disabled', '');
        $('#Site2021_spo_pok22').val("");
        $('#Site2021_spo_pok22').attr('disabled', '');
        $('#Site2021_spo_pok23').val("");
        $('#Site2021_spo_pok23').attr('disabled', ''); 
        $('#Site2021_spo_pok24').val("");
        $('#Site2021_spo_pok24').attr('disabled', '');        
    }
    else {        
        $('#Site2021_spo_pok20').removeAttr('disabled'); 
        $('#Site2021_spo_pok21').removeAttr('disabled');
        $('#Site2021_spo_pok22').removeAttr('disabled'); 
        $('#Site2021_spo_pok23').removeAttr('disabled');
        $('#Site2021_spo_pok24').removeAttr('disabled');        
    }
});
</script>
