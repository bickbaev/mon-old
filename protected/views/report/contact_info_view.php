<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?>

    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="3">
      <tr class ="head">
        <th scope="col">Наименование показателя </th>
        <th width="160" scope="col">Значение показателя </th>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'nas_punkt'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'nas_punkt'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'street'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'street'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'dom'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'dom'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'dir_sur'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'dir_sur'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'dir_name'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'dir_name'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'dir_par'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'dir_par'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'phone'); ?>
        </td>
        <td>
        8(<?php echo CHtml::value($model,'cod_phone', array('size'=>3)); ?>)
        <?php echo CHtml::value($model,'phone', array('size'=>6)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'fax'); ?>
        </td>
        <td>
        8(<?php echo CHtml::value($model,'cod_fax', array('size'=>3)); ?>)
        <?php echo CHtml::value($model,'fax', array('size'=>6)); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'mail'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'mail'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'site'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'site'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'samo'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'samo'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'akkr'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'akkr'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'lic'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'lic'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php echo CHtml::activeLabelEx($model,'ustav'); ?>
        </td>
        <td>
        <?php echo CHtml::value($model,'ustav'); ?>
        </td>
      </tr>
<!--      <tr>
        <td>
        <?php //echo CHtml::activeLabelEx($model,'gos'); ?>
        </td>
        <td>
        <?php //echo CHtml::value($model,'gos'); ?>
        </td>
      </tr>
      <tr>
        <td>
        <?php //echo CHtml::activeLabelEx($model,'opl'); ?>
        </td>
        <td>
        <?php //echo CHtml::value($model,'opl'); ?>
        </td>
      </tr>-->
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
    </div>


    <?php echo CHtml::endForm(); ?>

</div><!-- form -->