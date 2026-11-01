<fieldset><legend>Введите объем услуги</legend></fieldset>
<?php
echo '<b>Наименование услуги (работы)</b>: '.$usluga['pok1'].'<br>';
echo '<b>Условия оказания услуги (работы)</b>: '.$usluga['pok10'].'<br>';
echo '<b>Содержание услуги (работы)</b>: '.$usluga['pok9'].'<br>'
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'uslugi_res',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="control-group" style="margin-top: 20px;">
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.01.<?php echo $god; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col1',array('class'=>'span1','maxlength'=>12)); ?>
            </div>
</div>            
<div class="control-group" style="margin-top: 20px;">            
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.09.<?php echo $god; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col2',array('class'=>'span1','maxlength'=>12)); ?>
            </div>            
</div> 
<div class="control-group" style="margin-top: 20px;">
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.01.<?php echo $god+1; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col3',array('class'=>'span1','maxlength'=>12)); ?>
            </div>
</div>            
<div class="control-group" style="margin-top: 20px;">            
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.09.<?php echo $god+1; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col4',array('class'=>'span1','maxlength'=>12)); ?>
            </div>            
</div>
<div class="control-group" style="margin-top: 20px;">
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.01.<?php echo $god+2; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col5',array('class'=>'span1','maxlength'=>12)); ?>
            </div>
</div>            
<div class="control-group" style="margin-top: 20px;">            
            <label class="control-label"><?php echo $usluga['pok11']; ?> на 01.09.<?php echo $god+2; ?><span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col6',array('class'=>'span1','maxlength'=>12)); ?>
            </div>            
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('uslugi26/edit',array('id_rep'=>$id_rep)))); ?>
</div>

<?php $this->endWidget(); ?>
