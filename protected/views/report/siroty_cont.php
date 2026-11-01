<fieldset><legend>Информация о количестве детей-сирот и детей, оставшихся без попечения родителей, принятых и находящихся на обучении в учреждениях начального и среднего профессионального образования</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'siroty_cont',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>
    <?php
    $rep = Report::model()->findByPk($model->id_report);
    $rep_name = RepName::model()->findByPk($rep->id_rep_type);
    $s_month = date('n', strtotime($rep_name->s_date));
    $s_year = date('Y', strtotime($rep_name->s_date));
    ?>
    <blockquote>
        <strong>Отчетный месяц - <?php echo Siroty_mes::model()->findByPk($s_month)->naim_mes.' '.$s_year.' г.'; ?><br/>
        Отчетная дата - 25 <?php echo Siroty_mes::model()->findByPk($s_month)->rod_pad.' '.$s_year.' г.'; ?>
        </strong>
    </blockquote>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'id_report') ?>

    <?php echo $form->textFieldRow($model,'vsego',array('class'=>'span2','maxlength'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'vsego_gos',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'priem',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'izm',array('class'=>'span2')); ?>

    <?php echo $form->textFieldRow($model,'kurs1',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'kurs2',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'kurs3',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'kurs4',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'kurs5',array('class'=>'span2')); ?>

    <?php echo $form->textFieldRow($model,'exit_plan',array('class'=>'span2','maxlength'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'exit_plan_gos',array('class'=>'span2','maxlength'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'exit_plan_money',array('class'=>'span2','maxlength'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'exit_trud',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'exit_ptrud',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'exit_obuch',array('class'=>'span2','maxlength'=>5)); ?> 

    <?php echo $form->textFieldRow($model,'exit_arm',array('class'=>'span2','maxlength'=>5)); ?> 

    <?php echo $form->textFieldRow($model,'exit_bez',array('class'=>'span2','maxlength'=>5)); ?>     

    <?php echo $form->textFieldRow($model,'obsh',array('class'=>'span2','maxlength'=>5)); ?>

    <?php echo $form->textFieldRow($model,'isp',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'tel',array('class'=>'span3','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?>    
