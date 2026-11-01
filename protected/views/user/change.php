<?php $this->pageTitle=Yii::app()->name.' - Смена пароля'; ?>
<?php echo '<legend>Смена пароля для пользователя '.Yii::app()->session['fio'].'</legend>'; ?>

<p class="help-block">Поля отмеченные<span class="required">*</span> обязательны для заполнения.</p>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'est_add',
    'type'=>'horizontal',
)); ?>

<div class="control-group ">
        <label class="control-label" for="cat">Введите Ваш текущий пароль</label>
        <div class="controls">
        <?php echo $form->passwordField($model,'old_pass') ?>
        </div>
</div>
<div class="control-group ">
        <label class="control-label" for="cat">Введите новый пароль</label>
        <div class="controls">
        <?php echo $form->passwordField($model,'pass1') ?>
        </div>
</div>
<div class="control-group ">
        <label class="control-label" for="cat">Введите новый пароль еще раз</label>
        <div class="controls">
        <?php echo $form->passwordField($model,'pass2') ?>
        </div>
</div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сменить пароль')); ?>
    <button class="btn" type="button" onclick="javascript:history.back()">Отменить</button>
</div>
<?php $this->endWidget(); ?>