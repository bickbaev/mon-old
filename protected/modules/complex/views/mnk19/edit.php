<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p><b>Инструкция по заполнению отчета "Информация о проведении мероприятий в новогодние каникулы"</b></p>
<p>Введите информацию о мероприятиях. Для добавления мероприятия нажмите кнопку "добавить мероприятие". Для редактирования информации об уже введенном мероприятии нажмите кнопку в виде карандаша. Для удаления введенного мероприятия нажмите кнопку в виде корзины.<br>
Отчет переходит в статус "Заполнен" после ввода первого мероприятия.<br>
    <strong>Данные по мероприятиям и плановые значения заполняются до 27 декабря 2019 года (не позднее 09.00), фактические до 9 января 2020 года (не позднее 14.00).</strong></p>
<?php echo '<h4>Мероприятия</h4>';
if($mer->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'mer-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$mer,
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
                'nazv',
                'plan',
                'fact',
                'praz',            
                'mesto',
                'addr',            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/mnk19/update_mnk", array("id_mnk"=>$data->id_mnk))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/mnk19/delete_mnk", array("id_mnk"=>$data->id_mnk))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить мероприятие?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить мероприятие', 'url'=>Yii::app()->createUrl("complex/mnk19/create_mnk", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

