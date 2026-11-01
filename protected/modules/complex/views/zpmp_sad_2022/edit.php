<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Запросы на подтверждение мер поддержки (освобождение от родительской платы в детском саду) по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция по подаче запросов</h4>
<p>Введите информацию о родителе (законном представителе), проходящем военную службу. Необходимо ввести ФИО, дату рождения, а также адрес регистрации родителя (законного представителя), проходящего военную службу. Для добавления информации нажмите кнопку добавить.</p>
<p>Информацию о родителе (законном представителе) можно отредактировать/удалить нажав на соответствующие кнопки (в виде карандаша и корзины) в каждой строке</p>
<p><strong>В случае неподтверждения данных, рекомендуется запросить у заявителя подтверждающие документы и подать запрос еще раз.</strong></p>
<?php 
echo '<h4 style="margin-top: 40px;">Поданные запросы</h4>';
if(!$this->block()) {echo '<h5 style="color: red;">Данные обрабатываются. Добавлять и редактировать данные будет возможно после окончания обработки. Ориентировочно после '.$this->block_data().'</h5>';}
if($zps->itemCount) {  
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'zp-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$zps,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                /*array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),*/
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
                    'value'=>'"<b>".$data->pok1." ".$data->pok2." ".$data->pok3."</b><br>".$data->pok4."<br>".$data->get_addr()."<br>".Zpmp_type::model()->findByPk($data->pok14)->naim_type',
                    'type'=>'html',
                ),
                'pok13',
                array(
                    'name' => 'pok15',
                    'value'=>'$data->get_pok15()',
                    'type'=>'html',
                ),                
                'pok16',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}{print}',
                    //'updateButtonUrl'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/update", array("id_zpmp"=>$data->id_zpmp))',
                    //'deleteButtonUrl'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/delete", array("id_zpmp"=>$data->id_zpmp))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить запрос?',
                    'buttons'=>array(
                        'update' => array(
                                'url'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/update", array("id_zpmp"=>$data->id_zpmp))',
                                'label'=>'Редактировать',
                                'visible' => '$data->pok15 == ""',
                        ),
                        'delete' => array(
                                'url'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/delete", array("id_zpmp"=>$data->id_zpmp))',
                                'label'=>'Удалить',
                                'visible' => '$data->pok15 == ""',
                        ),
                        'print' => array(
                                'icon'=>'print',
                                'url'=>'Yii::app()->createUrl("complex/zpmp_sad_2022/pdf", array("id_zpmp"=>$data->id_zpmp))',
                                'label'=>'Печать запроса',
                                'visible' => '$data->pok15 > 0',
                        ),                         
                    ),                     
                ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php if($this->block()) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить', 'url'=>Yii::app()->createUrl("complex/zpmp_sad_2022/create", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

