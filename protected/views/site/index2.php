<?php
Yii::app()->clientScript->registerScriptFile('/js/raphael-min.js');
Yii::app()->clientScript->registerScriptFile('/js/muns.js');
Yii::app()->clientScript->registerScriptFile('/js/towns.js');
Yii::app()->clientScript->registerScriptFile('/js/init.js');
?>
<?php $this->pageTitle=Yii::app()->name.' - Информация об образовательных организациях'; ?>

    <div class="hero-unit">
    <h2>Информация об образовательных организациях Самарской области</h2>
    </div>

<div class="row">
    <div  class="span12">        
       
        <div class="row">
            <div class="span7 visible-desktop">
                <div id="map"></div>
            </div>
            <div class="row">
                <div class="span5">
                        <fieldset>
                            <legend>
                                Городские округа
                            </legend>
                        </fieldset>    
                            <?php foreach($gos as $k => $go ) {
                                if($k == 0 || $k == 5) echo '<div class="span2"><ul>';
                                echo '<li>'.CHtml::link(str_replace('городской округ ','',$go['est_name']), array('site/type', 'id_raion'=>$go['id_est'])).'</li>';
                                if($k == 4 || $k == 9) echo '</ul></div>';
                            }
                            ?>
                </div>
                <div class="span5">
                        <fieldset>
                            <legend>
                                Муниципальные районы
                            </legend>
                        </fieldset> 
                            <?php foreach($mos as $k=>$mo ) {
                                if($k == 0 || $k == 14) echo '<div class="span2"><ul>';
                                echo '<li>'.CHtml::link(str_replace(' район','',$mo['est_name']), array('site/type', 'id_raion'=>$mo['id_est'])).'</li>';
                                if($k == 13 || $k == 26) echo '</ul></div>';
                            }
                            ?>
                </div>    
            </div>
        </div>
    </div>
</div>