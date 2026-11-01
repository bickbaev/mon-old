<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'raiting_list_dd',
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
    <div style="width: 750px; margin-left: 20px; font-weight: bold; font-size: 15px; text-indent: 10px; margin-bottom: 20px;">Лист оценивания  эффективности (качества) работы руководителей подведомственных министерству образова-ния и науки Самарской области детских домов и специальных (коррекционных) детских домов для детей-сирот и детей, оставшихся без попечения родителей, с ограниченными возможностями здоровья</div>
    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="5">
      <tr class ="head">
        <th width="40" scope="col">№</th>
        <th scope="col">Критерий оценивания</th>
        <th width="60" scope="col">Кол-во набранных баллов </th>
      </tr>
        <tr class ="head"><td>1.</td><td colspan="2">Эффективность процесса обучения</td></tr>

        <tr class ="head"><td>2.</td><td colspan="2">Эффективность воспитательной работы</td></tr>

        <tr class ="head"><td>3.</td><td colspan="2">Эффективность использования современных технологий в образовательном процессе и деятельности учреждения</td></tr>

        <tr class ="head"><td>4.</td><td colspan="2">Эффективность организации предпрофильной подготовки и профильного обучения</td></tr>

        <tr class ="head"><td>5.</td><td colspan="2">Эффективность управленческой деятельности</td></tr>

        <tr class ="head"><td>6.</td><td colspan="2">Эффективность обеспечения условий, направленных на здоровьесбережение и безопасность участников образовательного процесса</td></tr>

        <tr class ="head"><td>7.</td><td colspan="2">Эффективность использования и развития ресурсного обеспечения</td></tr>

    </table>
    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->