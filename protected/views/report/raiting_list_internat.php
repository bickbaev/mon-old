<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'raiting_list_internat',
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
    <div style="width: 750px; margin-left: 20px; font-weight: bold; font-size: 15px; text-indent: 10px; margin-bottom: 20px;">Лист оценивания  эффективности (качества) работы руководителей подведомственных министерству образования и науки Самарской области общеобразовательных школ-интернатов и школ-интернатов для детей-сирот и детей, оставшихся без попечения родителей</div>
    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="5">
      <tr class ="head">
        <th width="40" scope="col">№</th>
        <th scope="col">Критерий оценивания</th>
        <th width="60" scope="col">Кол-во набранных баллов </th>
      </tr>
        <tr class ="head"><td>1.</td><td colspan="2">Эффективность процесса обучения</td></tr>
        <tr><td>1.1</td><td><?php echo $form->labelEx($model,'pok1_1'); ?></td><td><?php echo $form->textField($model,'pok1_1', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>1.2</td><td><?php echo $form->labelEx($model,'pok1_2'); ?></td><td><?php echo $form->textField($model,'pok1_2', array('size'=>3)); ?></td></tr>
        <tr><td>1.3</td><td><?php echo $form->labelEx($model,'pok1_3'); ?></td><td><?php echo $form->textField($model,'pok1_3', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>1.4</td><td><?php echo $form->labelEx($model,'pok1_4'); ?></td><td><?php echo $form->textField($model,'pok1_4', array('size'=>3)); ?></td></tr>
        <tr><td>1.5</td><td><?php echo $form->labelEx($model,'pok1_5'); ?></td><td><?php echo $form->textField($model,'pok1_5', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>1.6</td><td><?php echo $form->labelEx($model,'pok1_6'); ?></td><td><?php echo $form->textField($model,'pok1_6', array('size'=>3)); ?></td></tr>
        <tr><td>1.7</td><td><?php echo $form->labelEx($model,'pok1_7'); ?></td><td><?php echo $form->textField($model,'pok1_7', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>1.8</td><td><?php echo $form->labelEx($model,'pok1_8'); ?></td><td><?php echo $form->textField($model,'pok1_8', array('size'=>3)); ?></td></tr>
        <tr><td>1.9</td><td><?php echo $form->labelEx($model,'pok1_9'); ?></td><td><?php echo $form->textField($model,'pok1_9', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>1.10</td><td><?php echo $form->labelEx($model,'pok1_10'); ?></td><td><?php echo $form->textField($model,'pok1_10', array('size'=>3)); ?></td></tr>
        <tr><td>1.11</td><td><?php echo $form->labelEx($model,'pok1_11'); ?></td><td><?php echo $form->textField($model,'pok1_11', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>2.</td><td colspan="2">Эффективность воспитательной работы</td></tr>
        <tr bgcolor="#FFFFCC"><td>2.1</td><td><?php echo $form->labelEx($model,'pok2_1'); ?></td><td><?php echo $form->textField($model,'pok2_1', array('size'=>3)); ?></td></tr>
        <tr><td>2.2</td><td><?php echo $form->labelEx($model,'pok2_2'); ?></td><td><?php echo $form->textField($model,'pok2_2', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>2.3</td><td><?php echo $form->labelEx($model,'pok2_3'); ?></td><td><?php echo $form->textField($model,'pok2_3', array('size'=>3)); ?></td></tr>
        <tr><td>2.4</td><td><?php echo $form->labelEx($model,'pok2_4'); ?></td><td><?php echo $form->textField($model,'pok2_4', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>2.5</td><td><?php echo $form->labelEx($model,'pok2_5'); ?></td><td><?php echo $form->textField($model,'pok2_5', array('size'=>3)); ?></td></tr>
        <tr><td>2.6</td><td><?php echo $form->labelEx($model,'pok2_6'); ?></td><td><?php echo $form->textField($model,'pok2_6', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>2.7</td><td><?php echo $form->labelEx($model,'pok2_7'); ?></td><td><?php echo $form->textField($model,'pok2_7', array('size'=>3)); ?></td></tr>
        <tr><td>2.8</td><td><?php echo $form->labelEx($model,'pok2_8'); ?></td><td><?php echo $form->textField($model,'pok2_8', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>2.9</td><td><?php echo $form->labelEx($model,'pok2_9'); ?></td><td><?php echo $form->textField($model,'pok2_9', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>3.</td><td colspan="2">Эффективность использования современных технологий в образовательном процессе и деятельности учреждения</td></tr>
        <tr><td>3.1</td><td><?php echo $form->labelEx($model,'pok3_1'); ?></td><td><?php echo $form->textField($model,'pok3_1', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>3.2</td><td><?php echo $form->labelEx($model,'pok3_2'); ?></td><td><?php echo $form->textField($model,'pok3_2', array('size'=>3)); ?></td></tr>
        <tr><td>3.3</td><td><?php echo $form->labelEx($model,'pok3_3'); ?></td><td><?php echo $form->textField($model,'pok3_3', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>3.4</td><td><?php echo $form->labelEx($model,'pok3_4'); ?></td><td><?php echo $form->textField($model,'pok3_4', array('size'=>3)); ?></td></tr>
        <tr><td>3.5</td><td><?php echo $form->labelEx($model,'pok3_5'); ?></td><td><?php echo $form->textField($model,'pok3_5', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>3.6</td><td><?php echo $form->labelEx($model,'pok3_6'); ?></td><td><?php echo $form->textField($model,'pok3_6', array('size'=>3)); ?></td></tr>
        <tr><td>3.7</td><td><?php echo $form->labelEx($model,'pok3_7'); ?></td><td><?php echo $form->textField($model,'pok3_7', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>4.</td><td colspan="2">Эффективность организации предпрофильной подготовки и профильного обучения</td></tr>
        <tr bgcolor="#FFFFCC"><td>4.1</td><td><?php echo $form->labelEx($model,'pok4_1'); ?></td><td><?php echo $form->textField($model,'pok4_1', array('size'=>3)); ?></td></tr>
        <tr><td>4.2</td><td><?php echo $form->labelEx($model,'pok4_2'); ?></td><td><?php echo $form->textField($model,'pok4_2', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>4.3</td><td><?php echo $form->labelEx($model,'pok4_3'); ?></td><td><?php echo $form->textField($model,'pok4_3', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>5.</td><td colspan="2">Эффективность управленческой деятельности</td></tr>
        <tr><td>5.1</td><td><?php echo $form->labelEx($model,'pok5_1'); ?></td><td><?php echo $form->textField($model,'pok5_1', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>5.2</td><td><?php echo $form->labelEx($model,'pok5_2'); ?></td><td><?php echo $form->textField($model,'pok5_2', array('size'=>3)); ?></td></tr>
        <tr><td>5.3</td><td><?php echo $form->labelEx($model,'pok5_3'); ?></td><td><?php echo $form->textField($model,'pok5_3', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>5.4</td><td><?php echo $form->labelEx($model,'pok5_4'); ?></td><td><?php echo $form->textField($model,'pok5_4', array('size'=>3)); ?></td></tr>
        <tr><td>5.5</td><td><?php echo $form->labelEx($model,'pok5_5'); ?></td><td><?php echo $form->textField($model,'pok5_5', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>5.6</td><td><?php echo $form->labelEx($model,'pok5_6'); ?></td><td><?php echo $form->textField($model,'pok5_6', array('size'=>3)); ?></td></tr>
        <tr><td>5.7</td><td><?php echo $form->labelEx($model,'pok5_7'); ?></td><td><?php echo $form->textField($model,'pok5_7', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>5.8</td><td><?php echo $form->labelEx($model,'pok5_8'); ?></td><td><?php echo $form->textField($model,'pok5_8', array('size'=>3)); ?></td></tr>
        <tr><td>5.9</td><td><?php echo $form->labelEx($model,'pok5_9'); ?></td><td><?php echo $form->textField($model,'pok5_9', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>6.</td><td colspan="2">Эффективность обеспечения условий, направленных на здоровьесбережение и безопасность участников образовательного процесса</td></tr>
        <tr bgcolor="#FFFFCC"><td>6.1</td><td><?php echo $form->labelEx($model,'pok6_1'); ?></td><td><?php echo $form->textField($model,'pok6_1', array('size'=>3)); ?></td></tr>
        <tr><td>6.2</td><td><?php echo $form->labelEx($model,'pok6_2'); ?></td><td><?php echo $form->textField($model,'pok6_2', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>6.3</td><td><?php echo $form->labelEx($model,'pok6_3'); ?></td><td><?php echo $form->textField($model,'pok6_3', array('size'=>3)); ?></td></tr>
        <tr><td>6.4</td><td><?php echo $form->labelEx($model,'pok6_4'); ?></td><td><?php echo $form->textField($model,'pok6_4', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>6.5</td><td><?php echo $form->labelEx($model,'pok6_5'); ?></td><td><?php echo $form->textField($model,'pok6_5', array('size'=>3)); ?></td></tr>
        <tr><td>6.6</td><td><?php echo $form->labelEx($model,'pok6_6'); ?></td><td><?php echo $form->textField($model,'pok6_6', array('size'=>3)); ?></td></tr>
        <tr class ="head"><td>7.</td><td colspan="2">Эффективность использования и развития ресурсного обеспечения</td></tr>
        <tr bgcolor="#FFFFCC"><td>7.1</td><td><?php echo $form->labelEx($model,'pok7_1'); ?></td><td><?php echo $form->textField($model,'pok7_1', array('size'=>3)); ?></td></tr>
        <tr><td>7.2</td><td><?php echo $form->labelEx($model,'pok7_2'); ?></td><td><?php echo $form->textField($model,'pok7_2', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>7.3</td><td><?php echo $form->labelEx($model,'pok7_3'); ?></td><td><?php echo $form->textField($model,'pok7_3', array('size'=>3)); ?></td></tr>
        <tr><td>7.4</td><td><?php echo $form->labelEx($model,'pok7_4'); ?></td><td><?php echo $form->textField($model,'pok7_4', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>7.5</td><td><?php echo $form->labelEx($model,'pok7_5'); ?></td><td><?php echo $form->textField($model,'pok7_5', array('size'=>3)); ?></td></tr>
        <tr><td>7.6</td><td><?php echo $form->labelEx($model,'pok7_6'); ?></td><td><?php echo $form->textField($model,'pok7_6', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>7.7</td><td><?php echo $form->labelEx($model,'pok7_7'); ?></td><td><?php echo $form->textField($model,'pok7_7', array('size'=>3)); ?></td></tr>
        <tr><td>7.8</td><td><?php echo $form->labelEx($model,'pok7_8'); ?></td><td><?php echo $form->textField($model,'pok7_8', array('size'=>3)); ?></td></tr>
        <tr bgcolor="#FFFFCC"><td>7.9</td><td><?php echo $form->labelEx($model,'pok7_9'); ?></td><td><?php echo $form->textField($model,'pok7_9', array('size'=>3)); ?></td></tr>
        <tr><td>7.10</td><td><?php echo $form->labelEx($model,'pok7_10'); ?></td><td><?php echo $form->textField($model,'pok7_10', array('size'=>3)); ?></td></tr>
    </table>
    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->