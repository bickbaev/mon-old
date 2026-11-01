<?php $this->pageTitle=Yii::app()->name;
//4407
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
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'grup'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'grup'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'fiz'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'fiz'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'zem'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'zem'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'ozel'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'ozel'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'ten'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'ten'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'med'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'med'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pandus'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pandus'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'zal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'zal'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pol'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pol'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'obor'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'obor'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'didact'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'didact', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'muz'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'muz', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'igr'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'igr'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'po'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'po'); ?></div>
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
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'krov'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'krov'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'osv'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'osv'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'lumen'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'lumen'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'temp'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'temp'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'gor'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'gor'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'dezinf'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'dezinf'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'post'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'post'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pit'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pit'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'mineral'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'mineral'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'iod'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'iod'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'posuda'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'posuda'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pomesh'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pomesh'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pit1'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pit1'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pozar'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pozar'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'electro'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'electro'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'signal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'signal'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'ochrana'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'ochrana'); ?></div>
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
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'vospit'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'vospit'); ?></div>
        </td>
      </tr>
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->
