<?php $this->pageTitle=Yii::app()->name.' - Администрирование';?>
<fieldset><legend>Администрирование</legend></fieldset>
<?php 
echo '<p style = "margin:20px 10px; padding-left: 32px; background: url('.Yii::app()->request->baseUrl.'/images/otchet_a.png) no-repeat scroll left center transparent; line-height: 32px;">'.CHtml::link('Администрирование отчетов', 'index.php?r=admin/otchet').'</p>';
echo '<p style = "margin:20px 10px; padding-left: 32px; background: url('.Yii::app()->request->baseUrl.'/images/user.png) no-repeat scroll left center transparent; line-height: 32px;">'.CHtml::link('Администрирование пользователей', 'index.php?r=admin/user').'</p>';
?>