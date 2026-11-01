<?php echo $form->errorSummary($address); ?>
<div class="address-block well" data-id="<?php echo $address->id; ?>"> 
    <a href="#" class="btn btn-mini btn-danger pull-right removeAddress" data-existing="<?php echo $address->id ? '1' : '0'; ?>">
        <i class="icon-remove"></i>
    </a>    
    <?php echo $form->hiddenField($address,'['.$index.']id') ?>

    <?php echo $form->textFieldRow($address,'['.$index.']obj_name',array('class'=>'span3','maxlength'=>255, 'placeholder' => 'основное здание школы')); ?> 
    <?php echo $form->textFieldRow($address,'['.$index.']obj_index',array('class'=>'span3','maxlength'=>255)); ?>
    <?php echo $form->dropDownListRow($address, '['.$index.']id_mun', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty' => 'Выберите вариант', 'class'=>'span4  mun-select')); ?>     
    <?php echo $form->dropDownListRow($address, '['.$index.']nas_punkt_type', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty' => 'Выберите вариант', 'class'=>'span4 nas-punkt-type')); ?>         
    <?php echo $form->textFieldRow($address,'['.$index.']nas_punkt',array('class'=>'span3 nas-punkt','maxlength'=>255)); ?> 
    <?php echo $form->dropDownListRow($address, '['.$index.']street_type', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty' => 'Выберите вариант', 'class'=>'span4')); ?>             
    <?php echo $form->textFieldRow($address,'['.$index.']street',array('class'=>'span3','maxlength'=>255)); ?> 
    <?php echo $form->textFieldRow($address,'['.$index.']dom',array('class'=>'span3','maxlength'=>255)); ?> 
    <?php echo $form->textFieldRow($address,'['.$index.']kad_num',array('class'=>'span3','maxlength'=>255, 'placeholder' => '00:00:0000000:0000')); ?>
</div>      