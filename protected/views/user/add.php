<?php $this->pageTitle=Yii::app()->name.' - Добавление пользователя'; ?>
<legend>Добавление нового пользователя. Введите данные нового пользователя</legend>  
<p class="help-block">Поля отмеченные<span class="required">*</span> обязательны для заполнения.</p>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'est_add',
    'type'=>'horizontal',
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'user_id') ?>
<?php echo $form->textFieldRow($model,'mail') ?>
<div class="control-group ">
        <label class="control-label" for="cat">Пароль</label>
        <div class="controls">
        <?php echo $form->passwordField($model,'pass1') ?>
        </div>
</div>
<div class="control-group ">
        <label class="control-label" for="cat">Введите пароль еще раз</label>
        <div class="controls">
        <?php echo $form->passwordField($model,'pass2') ?>
        </div>
</div>

<?php echo $form->textFieldRow($model,'surname') ?>
<?php echo $form->textFieldRow($model,'name') ?>
<?php echo $form->textFieldRow($model,'patronymic') ?>
<div class="control-group ">
        <?php echo $form->labelEx($model,'phone', array('class'=>'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model,'reg_cod_phone', array('class'=>'span1')); ?>
        <?php echo $form->textField($model,'phone', array('class'=>'span2')); ?>
        </div>
</div>
<div class="control-group ">
        <?php echo $form->labelEx($model,'mobile_phone', array('class'=>'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model,'reg_cod_mobile', array('class'=>'span1')); ?>
        <?php echo $form->textField($model,'mobile_phone', array('class'=>'span2')); ?>
        </div>
</div>
<?php echo $form->checkboxRow($model, 'stat_only'); ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Добавить пользователя')); ?>
    <button class="btn" type="button" onclick="javascript:history.back()">Отменить</button>
</div>
<?php $this->endWidget();
?>