<fieldset><legend><?php echo 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend></fieldset>
<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'decl-grid',
    'dataProvider'=>$pokrs,
    'type'=>'striped bordered condensed',
    'summaryText'=>'Отчеты {start}-{end} из {count}', 
    'emptyText'=>'Отчетов нет',
    'enableSorting'=>false,
    'columns'=>array(
        array(
            'header'=>'Округ',
            'type'=>'html',
            'value'=>'Est::model()->findByPk($data["okr"])->est_name',
        ),
        array(
            'header'=>'Муниципалитет',
            'type'=>'html',
            'value'=>'Est::model()->findByPk($data["raion"])->est_name',
        ),        
        array(
            'header'=>'Организация',
            'type'=>'html',
            'value'=>'CHtml::link($data["name"],array("/report/edit", "id_rep"=>$data["id"]), array("target"=>"_blank"))',
        ),
        array(
            'header'=>'Дата проверки',
            'type'=>'html',
            'value'=>'$data["p_date"]." ".$data["red"]',
        ),
    ),
)); ?>         