<legend>Редактирование эксперта</legend>
<?php 
if (!Yii::app()->request->isAjaxRequest) {
    echo $this->renderPartial('_form_exp', array('model'=>$model, 'comp' => $comp)); 
} else {
    // Для AJAX-запросов рендерим только форму без layout
    $this->renderPartial('_form_exp', array('model'=>$model, 'comp' => $comp), false, true);
}
