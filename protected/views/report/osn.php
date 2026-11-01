<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact_info',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?>

    <?php echo $form->errorSummary($model); ?>

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
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'tualet'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'tualet'); ?></div>
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
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'provoda'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'provoda'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'stolovaya'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'stolovaya'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'sportzal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'sportzal'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'signal'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'signal'); ?></div>
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
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'kompclass'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'kompclass', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'fizika'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'fizika'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'himia'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'himia'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'territoria'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'territoria'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'gorpitanie'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'gorpitanie'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'medkabinet'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'medkabinet'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'kompsert'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'kompsert', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'proektor'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'proektor', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'doska'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->textField($model,'doska', array('size'=>1)); ?> шт.</div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'lpo'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'lpo'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'atletica'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'atletica'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'fizika_lab'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'fizika_lab'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'himia_lab'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'himia_lab'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'bio_lab'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'bio_lab'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'geokarta'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'geokarta'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'hiskarta'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'hiskarta'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'internet'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'internet'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'teacher'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'teacher'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'profil'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'profil'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
        <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'klass'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'klass'); ?></div>
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