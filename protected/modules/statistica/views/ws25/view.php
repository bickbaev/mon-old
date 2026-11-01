<?php $this->pageTitle=Yii::app()->name;?>

<h3>Заявка</h3>

<h4 style="margin: 40px 0 20px 0;">Конкурсант</h4>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$models['contest'],
    'id'=>'contest-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>$models['contest']->getAttributeLabel('id_cat'),
            'value'=> $models['contest']->cat ? $models['contest']->cat->naim : null,
        ),
        array(
            'label'=>$models['contest']->getAttributeLabel('id_compet'),
            'value'=> $models['contest']->compet ? $models['contest']->compet->naim : null,
        ),
        array(
            'label'=>'ФИО',
            'value'=> $models['contest']->surname.' '.$models['contest']->name.' '.$models['contest']->patr,
        ),        
        'burthdate',
        'pers_mail',
        'nas_punkt',
        array(
            'label'=>$models['contest']->getAttributeLabel('lic_tel'),
            'value'=>'+7('.$models['contest']->lic_code.')'.$models['contest']->lic_tel,
        ),
        array(
            'label'=>$models['contest']->getAttributeLabel('id_gr'),
            'value'=> $models['contest']->gr ? $models['contest']->gr->naim : null,
        ),
        array(
            'label'=>'Не обучается в организации от которой подается заявка',
            'value'=> $models['contest']->ano_org ? 'Да' : 'Нет',
        ),
        'rabota',
        'org_mail',
        array(
            'label'=>$models['contest']->getAttributeLabel('id_po'),
            'value'=> $models['contest']->id_po
                ? $models['contest']->id_po.($models['contest']->po ? ' / '.$models['contest']->po->naim_po : '')
                : null,
        ),
        'klass',
        'end_god',
        array(
            'label'=>'ФИО родителя (законного представителя)',
            'value'=> $models['contest']->per_surname.' '.$models['contest']->per_name.' '.$models['contest']->per_patr,
        ),        
        array(
            'label'=>$models['contest']->getAttributeLabel('per_tel'),
            'value'=> $models['contest']->per_tel ? '+7('.$models['contest']->per_code.')'.$models['contest']->per_tel : null,
        ),
        array(
            'label'=>$models['contest']->getAttributeLabel('id_size'),
            'value'=> $models['contest']->size ? $models['contest']->size->naim : null,
        ),
        array(
            'label'=>'Необходимо проживание во время чемпионата',
            'value'=> $models['contest']->housing ? 'Да' : 'Нет',
        ),
        array(
            'label'=>$models['contest']->getAttributeLabel('file1'),
            'value'=> $models['contest']->sogl_r
                ? CHtml::link($models['contest']->sogl_r, array('ws25/scandown', 'id'=>$models['contest']->id, 'type'=>1))
                : 'Не загружено',
            'type'=>'html',
        ),
    )
)); ?>

<h4 style="margin: 40px 0 20px 0;">Эксперт-наставник</h4>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$models['mentor'],
    'id'=>'mentor-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'ФИО',
            'value'=> $models['mentor']->surname.' '.$models['mentor']->name.' '.$models['mentor']->patr,
        ),         
        'burthdate',
        'pers_mail',
        'nas_punkt',
        array(
            'label'=>$models['mentor']->getAttributeLabel('lic_tel'),
            'value'=>'+7('.$models['mentor']->lic_code.')'.$models['mentor']->lic_tel,
        ),
        array(
            'label'=>$models['mentor']->getAttributeLabel('id_gr'),
            'value'=> $models['mentor']->gr ? $models['mentor']->gr->naim : null,
        ),
        array(
            'label'=>'Не работает в организации от которой подается заявка',
            'value'=> $models['mentor']->ano_org ? 'Да' : 'Нет',
        ),
        'rabota',
        'org_mail',
        'dol',
        array(
            'label'=>$models['mentor']->getAttributeLabel('id_size'),
            'value'=> $models['mentor']->size ? $models['mentor']->size->naim : null,
        ),
        array(
            'label'=>'Необходимо проживание во время чемпионата',
            'value'=> $models['mentor']->housing ? 'Да' : 'Нет',
        ),
        array(
            'label'=>$models['mentor']->getAttributeLabel('file1'),
            'value'=> $models['mentor']->sogl_r
                ? CHtml::link($models['mentor']->sogl_r, array('ws25/scandown', 'id'=>$models['mentor']->id, 'type'=>1))
                : 'Не загружено',
            'type'=>'html',
        ),
        array(
            'label'=>$models['mentor']->getAttributeLabel('file2'),
            'value'=> $models['mentor']->exp_r
                ? CHtml::link($models['mentor']->exp_r, array('ws25/scandown', 'id'=>$models['mentor']->id, 'type'=>2))
                : 'Не загружены',
            'type'=>'html',
        ),
    )
)); ?>

<?php if($models['accomp']): ?>
<h4 style="margin: 40px 0 20px 0;">Сопровождающий</h4>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$models['accomp'],
    'id'=>'accomp-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'ФИО',
            'value'=> $models['accomp']->surname.' '.$models['accomp']->name.' '.$models['accomp']->patr,
        ),        
        'burthdate',
        'pers_mail',
        'nas_punkt',
        array(
            'label'=>$models['accomp']->getAttributeLabel('lic_tel'),
            'value'=>'+7('.$models['accomp']->lic_code.')'.$models['accomp']->lic_tel,
        ),
        array(
            'label'=>$models['accomp']->getAttributeLabel('id_gr'),
            'value'=> $models['accomp']->gr ? $models['accomp']->gr->naim : null,
        ),
        array(
            'label'=>'Не работает в организации от которой подается заявка',
            'value'=> $models['accomp']->ano_org ? 'Да' : 'Нет',
        ),
        'rabota',
        'org_mail',
        'dol',
        array(
            'label'=>$models['accomp']->getAttributeLabel('id_size'),
            'value'=> $models['accomp']->size ? $models['accomp']->size->naim : null,
        ),
        array(
            'label'=>'Необходимо проживание во время чемпионата',
            'value'=> $models['accomp']->housing ? 'Да' : 'Нет',
        ),
        array(
            'label'=>$models['accomp']->getAttributeLabel('file1'),
            'value'=> $models['accomp']->sogl_r
                ? CHtml::link($models['accomp']->sogl_r, array('ws25/scandown', 'id'=>$models['accomp']->id, 'type'=>1))
                : 'Не загружено',
            'type'=>'html',
        ),
    )
)); ?>
<?php endif; ?>

<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Назад', 'url'=>$this->createUrl('ws25/index',array('id_rep_type'=>$models['contest']->report->id_rep_type)))); ?>
    </div>
</div>
