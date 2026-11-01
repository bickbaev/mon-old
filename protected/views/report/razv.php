<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'razv',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?>
    <?php echo $form->errorSummary($model); ?>

    <p class="note"><b>Замечания по отчету:</b><br />
    <?php
        if(Yii::app()->session['est'] == $id_est) echo CHtml::value($model,'remark');
        else echo $form->textArea($model,'remark', array('cols' => 80));
    ?>
    </p>

    <div class="row">
        <?php echo $form->hiddenField($model,'id_report') ?>
    </div>
    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="3">
      <tr class ="head">
        <th scope="col">Наименование показателя </th>
        <th width="160" scope="col">Значение показателя </th>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'program'); ?></div>
        </td>
        <td>
        <?php echo $form->checkBox($model,'program'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'s_year'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'s_year', array('size'=>3)); ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <?php echo $form->labelEx($model,'f_year'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'f_year', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'sogl'); ?></div>
        </td>
        <td>
            <?php echo $form->checkBox($model,'sogl'); ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <?php echo $form->labelEx($model,'sogl_date'); ?>
        </td>
        <td>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    //'id' =>'Razv_sogl_date',
                    //'name'=>'Razv[sogl_date]',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                        //'altFormat'=>'yy-mm-dd',
                    ),
                    'language' => 'ru',
                    'attribute'=>'sogl_date',
                    'model' => $model,
                    'htmlOptions'=>array(
                        //'style'=>'margin-left:50px;'
                        'size'=>8
                    ),
                    ));
        ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'naim_sogl'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'naim_sogl'); ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'expert'); ?></div>
        </td>
        <td>
        <?php echo $form->checkBox($model,'expert'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'expert_fio'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'expert_fio'); ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <?php echo $form->labelEx($model,'expert_dol'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'expert_dol'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'expert_mesto'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'expert_mesto'); ?>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <?php echo $form->labelEx($model,'expert_date'); ?>
        </td>
        <td>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    //'id' =>'Razv_expert_date',
                    //'name'=>'Razv[expert_date]',
                    'attribute'=>'expert_date',
                    'model' => $model,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                        //'altFormat'=>'dd.mm.yy',
                    ),
                    'language' => 'ru',
                    'htmlOptions'=>array(
                        'size'=>8
                    ),
                    ));
        ?>
        </td>
      </tr>
    </table>
    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->