<?php $this->pageTitle=Yii::app()->name;?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    )); ?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend>Информация о предписаниях</legend></div></div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Помощь', 'url'=>'/res/help_pred.docx', 'htmlOptions' => array('class'=>'pull-right', 'style' => ' margin-bottom: 20px;'))); ?>
<p style="clear: both;">
   <strong>Инструкция по заполнению:</strong> Для ввода информация о предписаниях Вашему юридическому лицу вначале заполните информацию об объектах юридического лица.
</p>
<blockquote>
  <p>Под объектами (территориями) понимаются комплексы технологически и технически связанных между собой зданий (строений, сооружений) и систем, имеющих общую прилегающую территорию и (или) внешние границы, отдельные здания (строения, сооружения), обособленные помещения или группы помещений.</p>
  <p><i>Обычно объектами являются здания, принадлежащие юридическому лицу и имеющие почтовый адрес.</i></p>
</blockquote>
<p>
Для добавления информации об объектах нажмите кнопку "Добавить объект". Информацию необходимо внести по ВСЕМ объектам принадлежащим юридическому лицу. Количество объектов неограниченно.
Информацию по добавленным объектам можно редактировать и удалять с помощью пиктограмм "карандаш" и "корзина" соответственно. Для внесения информации о предписаниях создайте объект, а потом нажмите пиктограмму "карандаш" для внесения информации о предписаниях.<br>
<strong>Информация по предписаниям вводятся для каждого объекта юридического лица, даже если предписание было выдано на несколько объектов.</strong>
</p>
<p><strong>Для удаления объекта удалите все предписания и мероприятия по данному объекту.</strong></p>
<?php echo '<h4>Объекты</h4>';
if($objs->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'objs-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$objs,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                'nn'=> array(
                    'name' => '№',
                    'value' => function($data, $row, $column) {
                        /** @var $grid CGridView */
                        $grid = $column->grid;
                        /** @var $pages CPagination */
                        $pages = $grid->dataProvider->getPagination();

                        $start = ($grid->enablePagination === false)
                                ? 0
                                : $pages->getCurrentPage(false) * $pages->getPageSize();

                        return $start + $row + 1;
                    },
                ),
                'naim',
                array(
                    'header'=>'Адрес',
                    'type'=>'html',
                    'value'=>array($this, 'addr'),
                ),
                array(
                    'header'=>'Действ. предп.',
                    'type'=>'html',
                    'value'=>array($this, 'obj_pred'),
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("prescription/default/object_update", array("id_build"=>$data->id_build))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("prescription/default/object_delete", array("id_build"=>$data->id_build))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить объект?',
                    'buttons' => array(
                        'delete' => array(
                            'visible' => '!$data->pr_count()',
                        )
                    ),                    
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить объект', 'url'=>Yii::app()->createUrl("prescription/default/object_add", array('id_est'=>$id_est)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'В кабинет организации', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

