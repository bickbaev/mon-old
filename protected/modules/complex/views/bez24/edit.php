<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Информация о прибывших учащихся по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция</h4>
<p>Внесите информацию об учащихся, прибывших в Вашу образовательную организацию из Курской, Белгородской областей или иных приграничных территорий с 1 августа 2024 года.<br>Отчет имеет <u>статус ДСП</u> (запрещено распространение информации о содержании отчета).</p>
<?php 
echo '<h4 style="margin-top: 40px;">Прибывшие учащиеся</h4>';
if($zps->itemCount) {  
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'zp-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$zps,
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
                    'htmlOptions' => array('style' => 'width:25px;'),        
                ),                
                array(
                    'header' => 'Личные данные',
                    'value'=>'$data->get_pers()',
                    //'value'=>'"<b>".$data->pok1." ".$data->pok2." ".$data->pok3."</b><br>".$data->pok4."<br>".$data->pok5." параллель<br>"',
                    'type'=>'html',
                ),
                array(
                    'header' => 'Откуда прибыл',
                    'value'=>'$data->pok6.", ".$data->pok7.", ".$data->pok8.", ".$data->pok9',
                    'type'=>'html',
                ),
                array(
                    'header' => 'Место пребывания',
                    'value'=>'Mun::model()->findByPk($data->pok10)->naim_mun." ".$data->pok11',
                    'type'=>'html',
                ),
                array(
                    'header' => 'Проблематика',
                    'value'=>'$data->get_prob()',
                    'type'=>'html',
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    //'updateButtonUrl'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/update", array("id_zpmp"=>$data->id_zpmp))',
                    //'deleteButtonUrl'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/delete", array("id_zpmp"=>$data->id_zpmp))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить учащегося?',
                    'buttons'=>array(
                        'update' => array(
                                'url'=>'Yii::app()->createUrl("complex/bez24/update", array("id"=>$data->id))',
                                'label'=>'Редактировать',
                                'visible' => '$data->pok15 == ""',
                        ),
                        'delete' => array(
                                'url'=>'Yii::app()->createUrl("complex/bez24/delete", array("id"=>$data->id))',
                                'label'=>'Удалить',
                                'visible' => '$data->pok15 == ""',
                        ),                         
                    ),                     
                ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить учащегося', 'url'=>Yii::app()->createUrl("complex/bez24/create", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

