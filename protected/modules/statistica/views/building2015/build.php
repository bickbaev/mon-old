<legend>Здание по адресу <?php echo Contact_gor::model()->findByPk($model->nas_punkt_type)->naim_gor.' '.$model->nas_punkt.', '.Contact_ul::model()->findByPk($model->street_type)->naim_ul.' '.$model->street.', дом №'.$model->dom.$korpus; ?></legend>
<?php
if($model->ur1 == 1) $ur = 'дошкольного образования';
elseif($model->ur1 == 2) $ur = 'общего образования';
else $ur = 'дополнительного образования'; 

$this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'est-table',
    'type'=>'condenced striped bordered',  
    'nullDisplay'=>'',
    'attributes'=>array(
        array(
            'name'=>'ur1',
            'value'=> $ur,
            'template'=>"<tr class=\"{class}\"><td style='width:70%'><b>{label}</b></td><td>{value}</td></tr>\n",
        ),        
        array(
            'name'=>'pok1',
            'value'=>($model->pok1 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok2',
            'value'=>($model->pok2 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok3',
            'value'=>($model->pok3 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok4',
            'value'=>($model->pok4 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok5',
            'value'=>($model->pok5 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok6',
            'value'=>($model->pok6 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok7',
            'value'=>($model->pok7 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok8',
            'value'=>($model->pok8 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok9',
            'value'=>($model->pok9 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok10',
            'value'=>($model->pok10 == 1) ?'Да':'Нет',
        ), 
        array(
            'name'=>'pok11',
            'value'=>($model->pok11 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok12',
            'value'=>($model->pok12 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok13',
            'value'=>($model->pok13 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok14',
            'value'=>($model->pok14 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok15',
            'value'=>($model->pok15 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok16',
            'value'=>($model->pok16 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok17',
            'value'=>($model->pok17 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok18',
            'value'=>($model->pok18 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok19',
            'value'=>($model->pok19 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'pok20',
            'value'=>($model->pok20 == 1) ?'Да':'Нет',
        ), 
        array(
            'name'=>'pok21',
            'value'=>($model->pok21 == 1) ?'Да':'Нет',
        ),
        array(
            'name'=>'doc1',
            'type'=>'html',
            'value'=>($model->doc1) ?CHtml::link('скачать', '/images/'.$id_rep_type.'/'.$model->doc1):'',
        ),
        array(
            'name'=>'doc2',
            'type'=>'html',
            'value'=>($model->doc2) ?CHtml::link('скачать', '/images/'.$id_rep_type.'/'.$model->doc2):'',
        ),
        array(
            'name'=>'doc3',
            'type'=>'html',
            'value'=>($model->doc3) ?CHtml::link('скачать', '/images/'.$id_rep_type.'/'.$model->doc3):'',
        ),
        array(
            'name'=>'doc4',
            'type'=>'html',
            'value'=>($model->doc4) ?CHtml::link('скачать', '/images/'.$id_rep_type.'/'.$model->doc4):'',
        ),
        array(
            'name'=>'doc5',
            'type'=>'html',
            'value'=>($model->doc5) ?CHtml::link('скачать', '/images/'.$id_rep_type.'/'.$model->doc5):'',
        ),        
    ),
)); ?>    

