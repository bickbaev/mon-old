<?php                                   
  echo CHtml::dropDownList('region_id','', 
  array(2=>'New England',1=>'Middle Atlantic',3=>'East North Central'), 
  array(
    'prompt'=>'Select Region',
    'ajax' => array(
    'type'=>'POST', 
    'url'=>Yii::app()->createUrl('proba/loadcities'), //or $this->createUrl('loadcities') if '$this' extends CController
    //'update'=>'#city_name', //or 'success' => 'function(data){...handle the data in the way you want...}',
    //'success'=> 'function(data) {$("#city_name").empty(); $("#city_name").append(data);}',        
    'success'=> 'function(data) {$("#dep2").empty(); $("#dep2").append(data);}',            
    'data'=>array('region_id'=>'js:this.value'),
  ))); ?>
<div id="dep2">
<?php                                   
  echo CHtml::dropDownList('city_name','', 
  array(), 
  array(
    'prompt'=>'Select City',
    'disabled'=>true,
    'ajax' => array(
    'type'=>'POST', 
    'url'=>Yii::app()->createUrl('proba/loadraion'), //or $this->createUrl('loadcities') if '$this' extends CController
    'update'=>'#dep', //or 'success' => 'function(data){...handle the data in the way you want...}',
    'data'=>array('city_name'=>'js:this.value'),
  ))); ?>
</div> 
<div id="dep"> 
<?php 
echo CHtml::dropDownList('city_name','', array(), array('prompt'=>'Select Raion', 'disabled'=>true));
?>
</div>