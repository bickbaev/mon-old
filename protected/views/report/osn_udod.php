<?php $this->pageTitle=Yii::app()->name;
//4408
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact_info',
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

    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="3" bordercolor="#999999">
      <tr bgcolor="#FFFFCC" class ="head">
        <th scope="col">Наименование показателя </th>
        <th width="80" scope="col">Значение </th>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'temp'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'temp'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'voda'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'voda'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'kanal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'kanal'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'vihod'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'vihod'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'electro'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'electro'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'stol'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'stol'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'zal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'zal'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pozar'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pozar'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'ohrana'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'ohrana'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'comp'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'comp', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'prog'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'prog'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'blago'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'blago'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'med'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'med'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'colcomp'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'colcomp', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'proector'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'proector', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'interact'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'interact', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'po'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'po'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'obor'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'obor'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'inet'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'inet'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pedagog'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pedagog'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'avtor'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'avtor'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'do'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'do'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'media'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'media'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'avtobus'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'avtobus'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'grup'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'grup'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'director'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'director'); ?></div>
        </td>
      </tr>
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->