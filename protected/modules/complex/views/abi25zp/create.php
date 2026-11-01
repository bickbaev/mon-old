<legend>Добавление конкурсанта</legend>
<?php 
if (!Yii::app()->request->isAjaxRequest) {
    echo $this->renderPartial('_form', array('model'=>$model, 'school'=>$school, 'id_comp'=>$id_comp)); 
} else {
    // Для AJAX-запросов рендерим только форму без layout
    $this->renderPartial('_form', array('model'=>$model, 'school'=>$school, 'id_comp'=>$id_comp), false, true);
}


