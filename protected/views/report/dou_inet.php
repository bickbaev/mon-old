<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'dou-inet-dou_inet-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?>
    <p class="note">Данный отчет заполняется учреждениями ДОУ, как имеющими подключение к сети интернет, так и учреждения не имеющими подключения.<br>
    Учреждения, расположенные в гг. Самара и Тольятти в полях касающихся наименования учреждения, филиала, адресов пишут свои фактические данные.<br>
    То есть, например, графы "Полное наименование образовательного учреждения" и "Наименование филиала (детского сада)" заполняются одинаково и<br>
    указывается название ДОУ.<br>
    Учреждения, не имеющие подключение к сети интернет, должны выяснить у провайдера предоставляющего доступ в сеть интернет в их местности<br>
    параметры <strong>безлимитного тарифа</strong> на доступ к сети интернет со скоростью не менее 512 кбит/с.</p>
    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->hiddenField($model,'id_report') ?>
    </div>

    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="3">
      <thead>
          <tr class ="head">
            <th scope="col">Наименование показателя </th>
            <th scope="col">Значение показателя </th>
          </tr>
      </thead>
      <tbody>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'naim_ur', array('size'=>30)); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'naim_ur'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'adrress_ur', array('size'=>30)); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'adrress_ur'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'inet_ur'); ?>
        </td>
        <td>
        <?php echo $form->checkBox($model, 'inet_ur'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'naim_fil', array('size'=>30)); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'naim_fil'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'address_fil', array('size'=>30)); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'address_fil'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'inet_fil'); ?>
        </td>
        <td>
        <?php echo $form->checkBox($model, 'inet_fil'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'inet_fact', array('size'=>30)); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'inet_fact'); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><span style="font-weight: bold; margin-left: 5px;">Если у ДОУ подключение в Интернет имеется - заносятся фактические данные, если подключение в Интернет отсутствует - заносятся планируемые показатели с учетом возможностей провайдеров</span></th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'prov'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'prov'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'tech'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'tech'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'tariff'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'tariff'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'speed'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'speed'); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><span style="font-weight: bold; margin-left: 5px;">Следующие три строки заполняются при отсуствии подключения к сети интернет</span></th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'cost_obor'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'cost_obor'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'cost_rab'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'cost_rab'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'cost_all'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'cost_all'); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><span style="font-weight: bold; margin-left: 5px;">Если у ДОУ подключение в Интернет имеется - заносятся фактические данные, если подключение в Интернет отсутствует - заносятся планируемые показатели с учетом возможностей провайдеров</span></th>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'cost_month'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'cost_month'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($model,'itog_year'); ?>
        </td>
        <td>
        <?php echo $form->textField($model, 'itog_year'); ?>
        </td>
      </tr>
      </tbody>
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->