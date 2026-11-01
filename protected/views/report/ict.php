<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ict',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?>
    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

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

    <table class ="otchet_edit_table" width="450" border="1" cellspacing="0" cellpadding="3">
      <tr class ="head">
        <th scope="col">Наименование показателя </th>
        <th scope="col" width="80">Значение показателя </th>
      </tr>
      <tr>
        <td style="padding-left: 0;">
        <?php echo $form->labelEx($model,'col_teach'); ?>(по состоянию на 31.12.12)
        </td>
        <td>
        <?php echo $form->textField($model,'col_teach', array('size'=>3)); ?>
        </td>
      </tr>      
      <tr>
        <td style="padding-left: 0;">
        <?php echo $form->labelEx($model,'col_uch'); ?>(по состоянию на 31.12.12)
        </td>
        <td>
        <?php echo $form->textField($model,'col_uch', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Количество компьютеров по типам (без серверов):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'desktop', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'desktop', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'laptop', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'laptop', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'tablet', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'tablet', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'pda', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'pda', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Из общего количества компьютеров (без серверов):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_adm', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_adm', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_uch', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_uch', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_lvs', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_lvs', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_inet', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_inet', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Количество компьютеров по году изготовления (без серверов):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_05', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_05', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_06', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_06', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_07', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_07', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_08', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_08', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_09', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_09', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_10', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_10', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'comp_11', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_11', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td  style="padding-left: 0;">
        <?php echo $form->labelEx($model,'comp_class'); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'comp_class', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Количество иных аппаратно-программных средств:
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'server', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'server', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'doska', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'doska', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'proektor', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'proektor', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'golos', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'golos', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'printer', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'printer', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'scaner', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'scaner', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'doc_cam', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'doc_cam', array('size'=>3)); ?>
        </td>
      </tr>      
      <tr>
        <td style="padding-left: 0;">
        <?php echo $form->labelEx($model,'site'); ?>
        </td>
        <td>
        <?php echo $form->checkBox($model,'site'); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Количество каналов доступа к сети Интернет:
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'telefon', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'telefon', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'radio', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'radio', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'opto', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'opto', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'sat', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'sat', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Операционные системы(количество компьютеров с установленным ПО):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'win', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'win', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'mac', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'mac', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'linux', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'linux', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'oper_other', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'oper_other', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Офисные пакеты (количество компьютеров с установленным ПО):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'of_mic', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'of_mic', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'of_mac', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'of_mac', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'of_lin', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'of_lin', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Графика и дизайн (количество компьютеров с установленным ПО):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'graf_adobe', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'graf_adobe', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'graf_corel', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'graf_corel', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'graf_visio', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'graf_visio', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'graf_linux', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'graf_linux', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'graf_other', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'graf_other', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Антивирусное ПО и утилиты (количество компьютеров с установленным ПО):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'anti_kas', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'anti_kas', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'anti_web', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'anti_web', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'anti_nod', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'anti_nod', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'anti_rar', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'anti_rar', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'anti_other', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'anti_other', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Специализированное ПО (количество компьютеров с установленным ПО):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'spec_lingvo', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'spec_lingvo', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'spec_fr', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'spec_fr', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'spec_1C', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'spec_1C', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'spec_linux', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'spec_linux', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row">
        Система контентной фильтрации (количество компьютеров с установленным ПО или лицензий):
        </th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_kerio', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_kerio', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_ti', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_ti', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_ug', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_ug', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_np', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_np', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_skf', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_skf', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_ic', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_ic', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_squid', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_squid', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'kf_other', array('style' => 'font-weight: normal')); ?>
        </td>
        <td>
        <?php echo $form->textField($model,'kf_other', array('size'=>3)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'potr_linux'); ?>
        </td>
        <td>
        <?php echo $form->checkBox($model,'potr_linux'); ?>
        </td>
      </tr>
      <tr>
        <td style="padding-left: 0;">
        <?php echo $form->labelEx($model,'potr_pk_linux'); ?>
        </td>
        <td style="padding-left: 0;">
        <?php echo $form->textField($model,'potr_pk_linux', array('size'=>3)); ?>
        </td>
      </tr>
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->