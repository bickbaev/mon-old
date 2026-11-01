<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="/css/custom.css" type="text/css" media="all" />
      
        <?php Yii::app()->bootstrap->register(); ?>
        
        
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter24795284 = new Ya.Metrika({id:24795284,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24795284" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->   

    <style>
      #cookieConsent {
        background-color: #f5f8f6;
        color: #000;
        padding: 15px;
        position: fixed;
        bottom: 0;
        /*width: 100%;*/
        width: 1170px;
        z-index: 9999;
        display: none;
      }
      #cookieConsent .btn {
        margin-left: 10px;
      }
    </style>  
        
</head>

<body>

<div class="container">

        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'fixed'=>true,
            'collapse'=>true, // requires bootstrap-responsive.css
            //'brand'=>'Образование взрослых',
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                        array('label'=>'Заполнение отчетов', 'url'=>array('/site/tree'), 'visible'=>(!Yii::app()->user->isGuest && !Yii::app()->session['stat_only'])),
                        array('label'=>'Итоги', 'url'=>array('/stat/index'), 'visible'=>!Yii::app()->user->isGuest),
                        //array('label'=>'Оповещение', 'url'=>array('/opov/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Администрирование', 'url'=>array('/admin/index'), 'visible' => (Yii::app()->session['id'] == 'bickbaev')), 
                    ),
                ),
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=>array(
                        array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),  
                    ),                    
                ),
        ))); ?>                
                
                
	<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
                'homeLink' => '<a href="index.php">Самарская область</a>',
	)); ?><!-- breadcrumbs -->

        <?php echo $content; ?>

<hr>
<footer>
<p>
    <a href ="http://www.cposo.ru" target="_blank">&copy; 2010-<?php echo date('Y'); ?> ЦПО Самарской области.</a><br/>
    <a href="http://www.cposo.ru/images/2025/pol.pdf">Политика в отношении обработки персональных данных в ЦПО Самарской области</a>
</p>
</footer>

    <div id="cookieConsent" class="container">
      <div class="row">
        <div class="span10">
          Продолжая использовать сайт, Вы даете государственному бюджетному учреждению дополнительного профессионального образования Самарской области Центр профессионального образования (ИНН 6317032919), согласие на обработку файлов cookies и пользовательских данных. Если Вы не хотите, чтобы Ваши вышеперечисленные данные обрабатывались, просим отключить обработку файлов cookies и сбор пользовательских данных в настройках Вашего браузера или покинуть сайт. 
        </div>
        <div class="span2 text-right">
          <button id="acceptCookies" class="btn btn-success btn-small">Согласен</button>
        </div>
      </div>
    </div>
    
    <script>
      (function () {
        if (!localStorage.getItem('cookiesAccepted')) {
          document.getElementById('cookieConsent').style.display = 'block';
        }

        document.getElementById('acceptCookies').onclick = function () {
          localStorage.setItem('cookiesAccepted', 'true');
          document.getElementById('cookieConsent').style.display = 'none';
        };
      })();
    </script> 
</div><!-- page -->

</body>
</html>