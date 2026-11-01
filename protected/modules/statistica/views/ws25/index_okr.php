<fieldset><legend><?php echo 'Чемпионат "Профессионалы" '.date('Y', strtotime($comp->rv));?></legend></fieldset>
<h4 style="margin-top:30px;"><?php echo $est->est_name; ?></h4>
<?php
 foreach ($data as $item) {
    if($item['provider']->itemCount) { 
        echo '<h5 style="margin-top:30px;">'.$item['name'].'</h5>';
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'est-stats-grid',
            'dataProvider' => $item['provider'],
            'type'=>'striped bordered condensed',
            'summaryText'=>'', 
            'emptyText'=>'данных нет', 
            'columns'=>array(
                array(
                    'header'=>'№',
                    'value'=>'$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header'=>'Организация',
                    'type'=>'html',
                    'value'=>'$data["est_name"]',
                ),
                array(
                    'header'=>'Число участников',
                    'type'=>'html',
                    'value'=>'$data["cnt"]',
                    'htmlOptions' => array('style' => 'width:100px;'),
                ),                 
            )    
        ));
    }
} 
?>
