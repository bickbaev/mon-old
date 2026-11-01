<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p><b>Инструкция по заполнению отчета "Архитектурная доступность для маломобильных групп населения"</b></p>
<p>Введите информацию о зданиях, в которых осуществляется образовательный процесс. Для добавления здания нажмите кнопку "добавить здание". Для редактирования информации об уже введенном здании нажмите кнопку в виде карандаша. Для удаления введенного здания нажмите кнопку в виде корзины.<br>
Отчет переходит в статус "Заполнен" после ввода информации хотя бы по одному зданию.</p>
<?php echo '<h4>Здания, в которых ведется образовательный процесс</h4>';
if($builds->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'zd-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$builds,
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
                array(
                    'header' => 'Адрес',
                    'value' => array($this, 'address'),
                    'type'=>'html',
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/arch20/update_zd", array("id_zd"=>$data->id_zd))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/arch20/delete_zd", array("id_zd"=>$data->id_zd))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить мероприятие?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить здание', 'url'=>Yii::app()->createUrl("complex/arch20/create_zd", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

