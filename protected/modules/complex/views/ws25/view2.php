<?php $this->pageTitle=Yii::app()->name;?>

<h3>Заявка</h3>

<?php
$attributes = array();

if(!$school) {
    $attributes[] = array(
        'label'=>$model->getAttributeLabel('id_cat'),
        'value'=> $model->cat ? $model->cat->naim : null,
    );
}

$attributes = array_merge($attributes, array(
        array(
            'label'=>$model->getAttributeLabel('id_compet'),
            'value'=> $model->compet ? $model->compet->naim : null,
        ),
        array(
            'label'=>$model->getAttributeLabel('id_stat'),
            'value'=> $model->stat ? $model->stat->naim : null,
        ),
        array(
            'label'=>'ФИО',
            'value'=> $model->surname.' '.$model->name.' '.$model->patr,
        ),
        'burthdate',
        'pers_mail',
        'nas_punkt',
        array(
            'label'=>$model->getAttributeLabel('lic_tel'),
            'value'=>'+7('.$model->lic_code.')'.$model->lic_tel,
        ),
        array(
            'label'=>$model->getAttributeLabel('id_gr'),
            'value'=> $model->gr ? $model->gr->naim : null,
        ),
        array(
            'label'=>'Не работает в организации от которой подается заявка',
            'value'=> $model->ano_org ? 'Да' : 'Нет',
        ),
        'rabota',
        'org_mail',
        'dol',
        array(
            'label'=>$model->getAttributeLabel('id_size'),
            'value'=> $model->size ? $model->size->naim : null,
        ),
        array(
            'label'=>'Необходимо проживание во время чемпионата',
            'value'=> $model->housing ? 'Да' : 'Нет',
        ),
        array(
            'label'=>$model->getAttributeLabel('file1'),
            'value'=> $model->sogl_r
                ? CHtml::link($model->sogl_r, array('ws25/scandown2', 'id_rep'=>$model->id_report, 'id'=>1))
                : 'Не загружено',
            'type'=>'html',
        ),
    )
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'id'=>'form2-table',
    'type'=>'condenced striped bordered',
    'attributes'=>$attributes,
)); ?>

<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Назад', 'url'=>$this->createUrl('ws25/edit',array('id_rep'=>$model->id_report)))); ?>
    </div>
</div>
