<?php

class Ons2014Controller extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

        public function filters()
        {
            return array(
                'accessControl'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }
        
	public function actionIndex2()
	{
            $this->render('index');
        } 
        
	public function actionIndex()
	{
          if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                if(!$otchet['rep_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
                if (isset($_GET['id_mun']) && $_GET['id_mun'] != '' && isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['k']) && $_GET['k'] != '') {
                    $id_mun = (int)$_GET['id_mun'];
                    $id = (int)$_GET['id'];
                    $k = (int)$_GET['k'];
                    $part1_r = $this->part($id);
                    $col = array(
                        array(            // display 'create_time' using an expression
                            'name'=>'naim',
                            'header'=>Yii::app()->db->createCommand('select est_name from est where id_est='.$id_mun)->queryScalar(),
                            'footer'=>'<strong>'.Yii::app()->db->createCommand('select est_name from est where id_est='.$id_mun)->queryScalar().'</strong>',
                        ),
                        array(            // display 'create_time' using an expression
                            'name'=>'pok',
                            'header'=>$part1_r[$k][0].'('.$part1_r[$k][1].')',
                            //'htmlOptions'=>array('style'=>'font-weight: bold'),
                            'footer'=>'<strong>'.$part1_r[$k][0].'('.$part1_r[$k][1].')</strong>',
                        ));
                    $schools = Yii::app()->db->createCommand('select est.id_est, est.est_name from est, ons2014 where est.id_est = ons2014.id_est and est.id_raion = '.$id_mun.' and ons2014.id_rep_type = '.$id_rep_type)->queryAll();
                    foreach($schools as $m=>$school) {
                        $part1[$m]['naim'] = $school['est_name'];
                        $zapros = str_replace('id_okr', 'id_est', $part1_r[$k][3]);
                        $part1[$m]['pok'] = $this->raschet_okr($zapros, $school['id_est'], $id_rep_type);
                    }
                    $naz = 1; //кнопка назад
                    $gridDataProvider = new CArrayDataProvider($part1,array('pagination'=>array('pageSize'=>200)));
                    $this->render('onss', array('gridDataProvider'=>$gridDataProvider, 'col'=> $col, 'naz'=>$naz, 'id_rep_type'=>$id_rep_type, 'otchet'=>$otchet));
                    exit();
                }                
                if (isset($_GET['id_okr']) && $_GET['id_okr'] != '' && isset($_GET['id']) && $_GET['id'] != '') {
                    $id_okr = (int)$_GET['id_okr'];
                    $id = (int)$_GET['id'];
                    $okr_name = Yii::app()->db->createCommand('select est_name from est where id_est='.$id_okr)->queryScalar();
                    $col = array(
                        array(            // display 'create_time' using an expression
                            'name'=>'naim',
                            'header'=>'Показатель',
                            'footer'=>'<strong>Показатель</strong>',
                        ),
                        array(            // display 'create_time' using an expression
                            'name'=>'okr',
                            'header'=>$okr_name,
                            'htmlOptions'=>array('style'=>'font-weight: bold'),
                            'footer'=>'<strong>'.$okr_name.'</strong>',
                        ));
                    $mun_names=Yii::app()->db->createCommand('select est_name from est where pid_est='.$id_okr)->queryColumn();
                    foreach ($mun_names as $key => $value) {
                        $mun = 'mun'.$key;
                        $col[2+$key] = array(
                            'class'=>'CLinkColumn',
                            'labelExpression'=>'$data['.$mun.'][3]',
                            'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_mun"=>$data['.$mun.'.$key][0], "id"=>$data['.$mun.'.$key][1], "k"=>$data['.$mun.'.$key][2], "id_rep_type"=>$data['.$mun.'.$key][4]))',
                            'header'=>$value,
                            'footer'=>'<strong>'.$value.'</strong>',);
                    }
                    $muns = Yii::app()->db->createCommand('select id_est from est where pid_est='.$id_okr)->queryColumn();                
                    $part1_r = $this->part($id);
                    foreach($part1_r as $k=>$part) {
                        $part1[$k]['naim'] = $part[0].' ('.$part[1].')';
                        $part1[$k]['okr']= $this->raschet_okr($part[3], $id_okr, $id_rep_type);
                        foreach($muns as $i=>$mun) {
                            $zapros = str_replace('id_okr', 'id_raion', $part[3]);
                            $part1[$k]['mun'.$i] = array($mun, $id, $k, $this->raschet_okr($zapros, $mun, $id_rep_type), $id_rep_type);
                        }
                    }
                    $naz = 1; //кнопка назад
                    //print_r($col);
                    $gridDataProvider = new CArrayDataProvider($part1,array('pagination'=>array('pageSize'=>200)));
                    $this->render('onss', array('gridDataProvider'=>$gridDataProvider, 'col'=> $col, 'naz'=>$naz, 'id_rep_type'=>$id_rep_type, 'otchet'=>$otchet));
                    exit();

                }                 
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    $id = (int)$_GET['id'];
                }
                else $id = 1;               
                $col1=array(
                array(            // display 'create_time' using an expression
                    'name'=>'naim',
                    'header'=>'Показатель',
                    'footer'=>'<strong>Показатель</strong>',
                ),
                array(            // display 'create_time' using an expression
                    'name'=>'obl',
                    'header'=>'Обл.',
                    'footer'=>'<strong>Обл.</strong>',
                    'htmlOptions'=>array('style'=>'font-weight: bold'),
                ),
                array(   
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr2"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr2"][1], "id"=>$data["okr2"][0], "id_rep_type"=>$data["okr2"][3]))',
                    'header'=>'Сам.',
                    'footer'=>'<strong>Сам.</strong>',
                ), 
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr3"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr3"][1], "id"=>$data["okr3"][0], "id_rep_type"=>$data["okr3"][3]))',
                    'header'=>'Тол.',
                    'footer'=>'<strong>Тол.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr4"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr4"][1], "id"=>$data["okr4"][0], "id_rep_type"=>$data["okr4"][3]))',
                    'header'=>'Зап.',
                    'footer'=>'<strong>Зап.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr5"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr5"][1], "id"=>$data["okr5"][0], "id_rep_type"=>$data["okr5"][3]))',
                    'header'=>'Пов.',
                    'footer'=>'<strong>Пов.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr6"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr6"][1], "id"=>$data["okr6"][0], "id_rep_type"=>$data["okr6"][3]))',
                    'header'=>'ЮЗУ',
                    'footer'=>'<strong>ЮЗУ</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr7"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr7"][1], "id"=>$data["okr7"][0], "id_rep_type"=>$data["okr7"][3]))',
                    'header'=>'Отр.',
                    'footer'=>'<strong>Отр.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr8"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr8"][1], "id"=>$data["okr8"][0], "id_rep_type"=>$data["okr8"][3]))',
                    'header'=>'Кин.',
                    'footer'=>'<strong>Кин.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr9"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr9"][1], "id"=>$data["okr9"][0], "id_rep_type"=>$data["okr9"][3]))',
                    'header'=>'Цент.',
                    'footer'=>'<strong>Цент.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr10"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr10"][1], "id"=>$data["okr10"][0], "id_rep_type"=>$data["okr10"][3]))',
                    'header'=>'СВУ',
                    'footer'=>'<strong>СВУ</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr11"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr11"][1], "id"=>$data["okr11"][0], "id_rep_type"=>$data["okr11"][3]))',
                    'header'=>'Сев.',
                    'footer'=>'<strong>Сев.</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr12"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr12"][1], "id"=>$data["okr12"][0], "id_rep_type"=>$data["okr12"][3]))',
                    'header'=>'СЗУ',
                    'footer'=>'<strong>СЗУ</strong>',
                ),
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr13"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr13"][1], "id"=>$data["okr13"][0], "id_rep_type"=>$data["okr13"][3]))',
                    'header'=>'Южн.',
                    'footer'=>'<strong>Южн.</strong>',
                ), 
                array(            
                    'class'=>'CLinkColumn',
                    'labelExpression'=>'$data["okr14"][2]',
                    'urlExpression'=>'Yii::app()->controller->createUrl("/statistica/ons2014/index",array("id_okr"=>$data["okr14"][1], "id"=>$data["okr14"][0], "id_rep_type"=>$data["okr14"][3]))',
                    'header'=>'ЮВУ',
                    'footer'=>'<strong>ЮВУ</strong>',
                ),         
                );
                $col = $col1;
                $part1_r = $this->part($id);
                //$part1_r[0] = array('', '', $this->createUrl('site/onss',array('id_okr'=>'5','id'=>'1')));
                foreach($part1_r as $k=>$part) {
                    $part1[$k]['naim'] = $part[0].' ('.$part[1].')';
                    $part1[$k]['obl']= $this->raschet_obl($part[2], $id_rep_type);
                    $okr_col = Yii::app()->db->createCommand('select count(id_est) from est where type_adm = 3')->queryScalar();
                    for ($i = 2; $i < (2 + $okr_col); $i++) {
                        $part1[$k]['okr'.$i] = array($id, $i, $this->raschet_okr($part[3], $i, $id_rep_type), $id_rep_type);
                    }
                } 
                $gridDataProvider = new CArrayDataProvider($part1,array('pagination'=>array('pageSize'=>200)));
                $this->render('onss', array('gridDataProvider'=>$gridDataProvider, 'col'=> $col, 'id_rep_type' => $id_rep_type, 'otchet'=>$otchet));
            }
            else $this->redirect(Yii::app()->user->returnUrl);    
        }  
        
        protected function raschet_obl($part_r, $id_rep_type) {
                if($part_r[0]==2) {
                    $command=Yii::app()->db->createCommand($part_r[1].' where id_rep_type= '.$id_rep_type);
                    $pok1= $command->queryScalar();
                    $command=Yii::app()->db->createCommand($part_r[2].' and id_rep_type= '.$id_rep_type);
                    $pok2= $command->queryScalar(); 
                    if($pok2) $part = number_format($pok1/$pok2,2, '.', '');
                    else $part = '-';                    
                }
                elseif($part_r[0]==1) {
                    $command=Yii::app()->db->createCommand($part_r[1].' where id_rep_type= '.$id_rep_type);
                    $part = $command->queryScalar();
                }                
                elseif($part_r[0]==3) {
                    $command=Yii::app()->db->createCommand($part_r[1].' and id_rep_type = '.$id_rep_type);
                    $part = $command->queryScalar();
                }
                else {
                    $command=Yii::app()->db->createCommand($part_r[1].' and id_rep_type= '.$id_rep_type);
                    $pok1= $command->queryScalar();
                    $command=Yii::app()->db->createCommand($part_r[2].' and id_rep_type= '.$id_rep_type);
                    $pok2= $command->queryScalar(); 
                    if($pok2) $part = number_format(($pok1*100)/$pok2,2, '.', '');
                    else $part = '-';
                }
                return $part;
        }
        
        protected function raschet_okr($part_r, $id_okr, $id_rep_type) {
                if($part_r[0]==2) {
                    $command=Yii::app()->db->createCommand($part_r[1].$id_okr.' and id_rep_type= '.$id_rep_type);
                    $pok1= $command->queryScalar();
                    $command=Yii::app()->db->createCommand($part_r[2].$id_okr.' and id_rep_type= '.$id_rep_type);
                    $pok2= $command->queryScalar(); 
                    if($pok2) $part = number_format($pok1/$pok2,2, '.', '');
                    else $part = '-';                    
                }
                elseif($part_r[0]==1 || $part_r[0]==3) {
                    $command=Yii::app()->db->createCommand($part_r[1].$id_okr.' and id_rep_type= '.$id_rep_type);
                    $part = $command->queryScalar();
                }               
                else {
                    $command=Yii::app()->db->createCommand($part_r[1].$id_okr.' and id_rep_type= '.$id_rep_type);
                    $pok1= $command->queryScalar();
                    $command=Yii::app()->db->createCommand($part_r[2].$id_okr.' and id_rep_type= '.$id_rep_type);
                    $pok2= $command->queryScalar();                    
                    if($pok2) $part = number_format(($pok1*100)/$pok2, 2, '.', '');
                    else $part = '-';
                }
                return $part;
        }        
         
        protected function part($id) {

            $part1 = array(
                array('1.1 Численность обучающихся общеобразовательных организаций', 'чел.', array(1,'select sum(pok1_1) from ons2014'), array(1, 'select sum(pok1_1) from ons2014 where id_okr=')),
                array('1.1.1 Численность обучающихся общеобразовательных организаций сельской местности', 'чел.', array(3, 'select sum(pok1_1) from ons2014 where mesto = 0'), array(3, 'select sum(pok1_1) from ons2014 where mesto = 0 and id_okr=')),
                array('1.1.2 Численность обучающихся общеобразовательных организаций городской местности', 'чел.', array(3, 'select sum(pok1_1) from ons2014 where mesto = 1'), array(3, 'select sum(pok1_1) from ons2014 where mesto = 1 and id_okr=')),
                array('1.2 Численность учителей в общеобразовательных организациях', 
                    'чел.', 
                    array(1, 'select sum(pok1_2) from ons2014'), 
                    array(1, 'select sum(pok1_2) from ons2014 where id_okr = ')
                    ),
                array('1.2.1 Численность внешних совместителей', 
                    'чел.', 
                    array(1, 'select sum(pok1_2_1) from ons2014'), 
                    array(1, 'select sum(pok1_2_1) from ons2014 where id_okr = ')
                    ),
                array('1.2.2 Численность внутренних совместителей', 
                    'чел.', 
                    array(1, 'select sum(pok1_2_2) from ons2014'), 
                    array(1, 'select sum(pok1_2_2) from ons2014 where id_okr = ')
                    ),
                array('1.2.3 Численность учителей в городских общеобразовательных организациях', 
                    'чел.', 
                    array(3, 'select sum(pok1_2) from ons2014 where mesto = 1'), 
                    array(3, 'select sum(pok1_2) from ons2014 where mesto = 1 and id_okr = ')
                    ),
                array('1.2.4 Численность учителей в сельских общеобразовательных организациях', 
                    'чел.', 
                    array(3, 'select sum(pok1_2) from ons2014 where mesto = 0'), 
                    array(3, 'select sum(pok1_2) from ons2014 where mesto = 0 and id_okr = ')
                    ),
                array('1.3 Численность выпускников 9-x классов', 
                    'чел.', 
                    array(1, 'select sum(pok1_3) from ons2014'), 
                    array(1, 'select sum(pok1_3) from ons2014 where id_okr = ')
                    ),
                array('1.3.1 Численность выпускников 9-x классов, получивших аттестат с отличием', 
                    'чел.', 
                    array(1, 'select sum(pok1_3_1) from ons2014'), 
                    array(1, 'select sum(pok1_3_1) from ons2014 where id_okr = ')
                    ),
                array('1.3.2 Численность выпускников 9-x классов, не получивших аттестат об основном общем образовании', 
                    'чел.', 
                    array(1, 'select sum(pok1_3_2) from ons2014'), 
                    array(1, 'select sum(pok1_3_2) from ons2014 where id_okr = ')
                    ), 
                array('1.4.1 Численность  выпускников 9-x классов, сдававших  ГИА по русскому языку', 
                    'чел.', 
                    array(1, 'select sum(pok1_4_1) from ons2014'), 
                    array(1, 'select sum(pok1_4_1) from ons2014 where id_okr = ')
                    ),
                array('1.4.2 Численность  выпускников 9-x классов, сдававших  ГИА по математике', 
                    'чел.', 
                    array(1, 'select sum(pok1_4_2) from ons2014'), 
                    array(1, 'select sum(pok1_4_2) from ons2014 where id_okr = ')
                    ),
                array('1.5.1 Средний тестовый балл ГИА выпускников 9-x классов по русскому языку', 
                    'бал.', 
                    array(2, 'select sum(pok1_5_1) from ons2014', 'select count(pok1_5_1) from ons2014 where pok1_5_1 > 0'), 
                    array(2, 'select sum(pok1_5_1) from ons2014 where id_okr =', 'select count(pok1_5_1) from ons2014 where pok1_5_1 > 0 and id_okr =')
                    ),
                array('1.5.2 Средний тестовый балл ГИА выпускников 9-x классов по математике', 
                    'бал.', 
                    array(2, 'select sum(pok1_5_2) from ons2014', 'select count(pok1_5_2) from ons2014 where pok1_5_2 > 0'), 
                    array(2, 'select sum(pok1_5_2) from ons2014 where id_okr =', 'select count(pok1_5_2) from ons2014 where pok1_5_2 > 0 and id_okr =')
                    ),
                array('1.6.1 Численность выпускников 9-x классов, сдававших  ГИА и набравших по русскому языку- менее 18 баллов', 
                    'чел.', 
                    array(1, 'select sum(pok1_6_1) from ons2014'), 
                    array(1, 'select sum(pok1_6_1) from ons2014 where id_okr = ')
                    ),
                array('1.6.2 Численность выпускников 9-x классов, сдававших  ГИА и набравших по математике- менее 18 баллов', 
                    'чел.', 
                    array(1, 'select sum(pok1_6_2) from ons2014'), 
                    array(1, 'select sum(pok1_6_2) from ons2014 where id_okr = ')
                    ),                
                array('1.7.1 Численность выпускников 9-х классов, поступивших в профессиональные образовательные организации', 
                    'чел.', 
                    array(1, 'select sum(pok1_7_1) from ons2014'), 
                    array(1, 'select sum(pok1_7_1) from ons2014 where id_okr = ')
                    ),
                array('1.7.2 Численность выпускников 9-х классов, поступивших на профильное обучение по программам среднего общего образования', 
                    'чел.', 
                    array(1, 'select sum(pok1_7_2) from ons2014'), 
                    array(1, 'select sum(pok1_7_2) from ons2014 where id_okr = ')
                    ),
                array('1.8 Численность выпускников 11-х классов ', 
                    'чел.', 
                    array(1, 'select sum(pok1_8) from ons2014'), 
                    array(1, 'select sum(pok1_8) from ons2014 where id_okr = ')
                    ),
                array('1.8.1 Численность выпускников 11-х классов, получивших аттестат о среднем общем образовании', 
                    'чел.', 
                    array(1, 'select sum(pok1_8_1) from ons2014'), 
                    array(1, 'select sum(pok1_8_1) from ons2014 where id_okr = ')
                    ),
                array('1.8.2 Численность выпускников 11-х классов, получивших аттестат о среднем общем образовании и награжденных золотой или серебряной медалью', 
                    'чел.', 
                    array(1, 'select sum(pok1_8_2) from ons2014'), 
                    array(1, 'select sum(pok1_8_2) from ons2014 where id_okr = ')
                    ),
                array('1.9.1 Численность выпускников, сдававших  ЕГЭ по русскому языку', 
                    'чел.', 
                    array(1, 'select sum(pok1_9_1) from ons2014'), 
                    array(1, 'select sum(pok1_9_1) from ons2014 where id_okr = ')
                    ),
                array('1.9.2 Численность выпускников, сдававших  ЕГЭ по математике', 
                    'чел.', 
                    array(1, 'select sum(pok1_9_2) from ons2014'), 
                    array(1, 'select sum(pok1_9_2) from ons2014 where id_okr = ')
                    ),
                array('1.10.1 Средний тестовый балл ЕГЭ выпускников по русскому языку', 
                    'бал.', 
                    array(2, 'select sum(pok1_10_1) from ons2014', 'select count(pok1_10_1) from ons2014 where pok1_10_1 > 0'), 
                    array(2, 'select sum(pok1_10_1) from ons2014 where id_okr =', 'select count(pok1_10_1) from ons2014 where pok1_10_1 > 0 and id_okr =')
                    ),
                array('1.10.2 Средний тестовый балл ЕГЭ выпускников по математике', 
                    'бал.', 
                    array(2, 'select sum(pok1_10_2) from ons2014', 'select count(pok1_10_2) from ons2014 where pok1_10_2 > 0'), 
                    array(2, 'select sum(pok1_10_2) from ons2014 where id_okr =', 'select count(pok1_10_2) from ons2014 where pok1_10_2 > 0 and id_okr =')
                    ), 
                array('1.11.1 Численность выпускников, сдававших ЕГЭ и не преодолевших минимального порога по русскому языку', 
                    'чел.', 
                    array(1, 'select sum(pok1_11_1) from ons2014'), 
                    array(1, 'select sum(pok1_11_1) from ons2014 where id_okr = ')
                    ),
                array('1.11.2 Численность выпускников, сдававших ЕГЭ и не преодолевших минимального порога по математике', 
                    'чел.', 
                    array(1, 'select sum(pok1_11_2) from ons2014'), 
                    array(1, 'select sum(pok1_11_2) from ons2014 where id_okr = ')
                    ),
                array('1.12 Численность выпускников 11-х классов, обучавшихся в классах с углубленным изучением отдельных предметов ', 
                    'чел.', 
                    array(1, 'select sum(pok1_12) from ons2014'), 
                    array(1, 'select sum(pok1_12) from ons2014 where id_okr = ')
                    ),
                array('1.13 Численность выпускников 11-х классов, обучавшихся в профильных классах', 
                    'чел.', 
                    array(1, 'select sum(pok1_13) from ons2014'), 
                    array(1, 'select sum(pok1_13) from ons2014 where id_okr = ')
                    ),                              
            );
            $part2 = array(
                array('2.1 Общее число общеобразовательных организаций', 
                    'ед.', 
                    array(1, 'select count(id_report) from ons2014'), 
                    array(1, 'select count(id_report) from ons2014 where id_okr = ')
                    ),
                array('2.2 Число общеобразовательных организаций, реализующих ФГОС', 
                    'ед.', 
                    array(1, 'select sum(pok2_1) from ons2014'), 
                    array(1, 'select sum(pok2_1) from ons2014 where id_okr = ')
                    ),
                array('2.3 Общая численность учащихся начальных классов в общеобразовательных организациях', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_1) from ons2014'), 
                    array(1, 'select sum(pok2_1_1) from ons2014 where id_okr = ')
                    ),
                array('2.4 Общая численность учащихся начальных классов в общеобразовательных организациях, реализующих ФГОС', 
                    'чел.', 
                    array(3, 'select sum(pok2_1_1) from ons2014 where pok2_1 = 1'), 
                    array(1, 'select sum(pok2_1_1) from ons2014 where pok2_1 = 1 and id_okr = ')
                    ), 
                array('2.5 Численность  учащихся начальных классов, обучающихся по ФГОС', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_2) from ons2014'), 
                    array(1, 'select sum(pok2_1_2) from ons2014 where id_okr = ')
                    ), 
                array('2.6 Общая численность учащихся основной школы', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_3) from ons2014'), 
                    array(1, 'select sum(pok2_1_3) from ons2014 where id_okr = ')
                    ), 
                array('2.7 Общая численность учащихся основной школы в общеобразовательных организациях, реализующих ФГОС', 
                    'чел.', 
                    array(3, 'select sum(pok2_1_3) from ons2014 where pok2_1 = 1'), 
                    array(1, 'select sum(pok2_1_3) from ons2014 where pok2_1 = 1 and id_okr = ')
                    ), 
                array('2.8 Численность  учащихся основной школы, обучающихся по ФГОС', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_4) from ons2014'), 
                    array(1, 'select sum(pok2_1_4) from ons2014 where id_okr = ')
                    ), 
                array('2.9 Общая численность учащихся старшей школы', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_5) from ons2014'), 
                    array(1, 'select sum(pok2_1_5) from ons2014 where id_okr = ')
                    ), 
                array('2.10 Общая численность учащихся старшей школы в общеобразовательных организациях, реализующих ФГОС', 
                    'чел.', 
                    array(3, 'select sum(pok2_1_5) from ons2014 where pok2_1 = 1'), 
                    array(1, 'select sum(pok2_1_5) from ons2014 where pok2_1 = 1 and id_okr = ')
                    ), 
                array('2.11 Численность  учащихся старшей школы, обучающихся по ФГОС', 
                    'чел.', 
                    array(1, 'select sum(pok2_1_6) from ons2014'), 
                    array(1, 'select sum(pok2_1_6) from ons2014 where id_okr = ')
                    ),
                array('2.12.1 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  за счет бюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_2_1) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_2_1) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.12.2 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_2_2) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_2_2) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ), 
                array('2.12.3 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  сочетания бюджетного и внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_2_3) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_2_3) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.13.1 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  за счет бюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_3_1) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_3_1) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.13.2 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_3_2) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_3_2) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ), 
                array('2.13.3 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  сочетания бюджетного и внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_3_3) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_3_3) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.14.1 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  за счет бюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_4_1) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_4_1) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ),
                array('2.14.2 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_4_2) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_4_2) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ), 
                array('2.14.3 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  сочетания бюджетного и внебюджетного финансирования', 
                    'час.', 
                    array(2, 'select sum(pok2_4_3) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_4_3) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ), 
                array('2.15.1 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на спортивно-оздоровительное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_5_1) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_1) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.15.2 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на духовно-нравственное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_5_2) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_2) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ), 
                array('2.15.3 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на социальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_5_3) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_3) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.15.4 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на общеинтеллектуальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_5_4) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_4) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.15.5 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на общекультурное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_5_5) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_5) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ), 
                array('2.15.6 Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  в том числе, отведенных на другие направления', 
                    'час.', 
                    array(2, 'select sum(pok2_5_6) from ons2014', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null'), 
                    array(2, 'select sum(pok2_5_6) from ons2014 where id_okr =', 'select count(pok2_1_2) from ons2014 where pok2_1_2 is not null and id_okr =')
                    ),
                array('2.16.1 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на спортивно-оздоровительное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_6_1) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_1) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.16.2 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на духовно-нравственное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_6_2) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_2) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ), 
                array('2.16.3 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на социальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_6_3) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_3) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.16.4 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на общеинтеллектуальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_6_4) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_4) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.16.5 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на общекультурное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_6_5) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_5) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ), 
                array('2.16.6 Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС,  в том числе, отведенных на другие направления', 
                    'час.', 
                    array(2, 'select sum(pok2_6_6) from ons2014', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null'), 
                    array(2, 'select sum(pok2_6_6) from ons2014 where id_okr =', 'select count(pok2_1_4) from ons2014 where pok2_1_4 is not null and id_okr =')
                    ),
                array('2.17.1 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на спортивно-оздоровительное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_7_1) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_1) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ),
                array('2.17.2 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на духовно-нравственное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_7_2) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_2) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ), 
                array('2.17.3 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на социальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_7_3) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_3) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ),
                array('2.17.4 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на общеинтеллектуальное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_7_4) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_4) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ),
                array('2.17.5 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на общекультурное направление', 
                    'час.', 
                    array(2, 'select sum(pok2_7_5) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_5) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ), 
                array('2.17.6 Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС,  в том числе, отведенных на другие направления', 
                    'час.', 
                    array(2, 'select sum(pok2_7_6) from ons2014', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null'), 
                    array(2, 'select sum(pok2_7_6) from ons2014 where id_okr =', 'select count(pok2_1_6) from ons2014 where pok2_1_6 is not null and id_okr =')
                    ),
                array('2.18.1 Число  общеобразовательных организаций, в которых используются механизмы накопительной системы оценивания (портфолио и др.)  для оценки достижений обучающихся по ФГОС в начальных классах', 
                    'орг.', 
                    array(1, 'select sum(pok2_8_1) from ons2014'), 
                    array(1, 'select sum(pok2_8_1) from ons2014 where id_okr = ')
                    ),
                array('2.18.2 Число  общеобразовательных организаций, в которых используются проектные, творческие исследовательские работы и др. для оценки достижений обучающихся по ФГОС в начальных классах', 
                    'орг.', 
                    array(1, 'select sum(pok2_8_2) from ons2014'), 
                    array(1, 'select sum(pok2_8_2) from ons2014 where id_okr = ')
                    ), 
                array('2.18.3 Число  общеобразовательных организаций, в которых используются иные виды оценивания, отличные от пятибалльной системы для оценки достижений обучающихся по ФГОС в начальных классах', 
                    'орг.', 
                    array(1, 'select sum(pok2_8_3) from ons2014'), 
                    array(1, 'select sum(pok2_8_3) from ons2014 where id_okr = ')
                    ), 
                array('2.19.1 Численность обучающихся по ФГОС, которым обеспечена возможность пользоваться в соответствии с ФГОС учебным оборудованием для практических работ', 
                    'чел.', 
                    array(1, 'select sum(pok2_9_1) from ons2014'), 
                    array(1, 'select sum(pok2_9_1) from ons2014 where id_okr = ')
                    ),
                array('2.19.2 Численность обучающихся по ФГОС, которым обеспечена возможность пользоваться в соответствии с ФГОС интерактивными учебными пособиями (доска, мультимедийные установки и др.)', 
                    'чел.', 
                    array(1, 'select sum(pok2_9_2) from ons2014'), 
                    array(1, 'select sum(pok2_9_2) from ons2014 where id_okr = ')
                    ),
                array('2.20.1 Число общеобразовательных организаций, в которых для обучающихся по ФГОС в начальных классах, организованы оборудованные постоянно действующие площадки для наблюдений, исследований', 
                    'орг.', 
                    array(1, 'select sum(pok2_10_1) from ons2014'), 
                    array(1, 'select sum(pok2_10_1) from ons2014 where id_okr = ')
                    ),
                array('2.20.2 Число общеобразовательных организаций, в которых для обучающихся по ФГОС в начальных классах, организованы оборудованные постоянно действующие площадки для моделирования, конструирования', 
                    'орг.', 
                    array(1, 'select sum(pok2_10_2) from ons2014'), 
                    array(1, 'select sum(pok2_10_2) from ons2014 where id_okr = ')
                    ), 
                array('2.20.3 Число общеобразовательных организаций, в которых для обучающихся по ФГОС в начальных классах, организована оборудованная постоянно действующая театральная площадка', 
                    'орг.', 
                    array(1, 'select sum(pok2_10_3) from ons2014'), 
                    array(1, 'select sum(pok2_10_3) from ons2014 where id_okr = ')
                    ),
                array('2.22 Общая численность руководителей и педагогических работников', 
                    'чел.', 
                    array(1, 'select sum(pok2_11) from ons2014'), 
                    array(1, 'select sum(pok2_11) from ons2014 where id_okr = ')
                    ),
                array('2.22.1 Численность руководителей и педагогических работников общеобразовательных организаций, прошедших повышение квалификации и/или профессиональную переподготовку для работы в соответствии с ФГОС', 
                    'чел.', 
                    array(1, 'select sum(pok2_11_1) from ons2014'), 
                    array(1, 'select sum(pok2_11_1) from ons2014 where id_okr = ')
                    ),                
            );
            $part3 = array(
                array('3.1.1 Общая численность обучающихся 5-11 классов', 
                    'чел.', 
                    array(1, 'select sum(pok3_1_1) from ons2014'), 
                    array(1, 'select sum(pok3_1_1) from ons2014 where id_okr = ')
                    ),
                array('3.1.2 Численность обучающихся 5-11 классов, принявших участие  в школьном этапе Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_1_2) from ons2014'), 
                    array(1, 'select sum(pok3_1_2) from ons2014 where id_okr = ')
                    ),
                array('3.2.1 Общая численность обучающихся 7-11 классов', 
                    'чел.', 
                    array(1, 'select sum(pok3_2_1) from ons2014'), 
                    array(1, 'select sum(pok3_2_1) from ons2014 where id_okr = ')
                    ),
               array('3.2.2 Численность обучающихся 7-11 классов, принявших участие в муниципальном этапе Всероссийской олимпиады школьников ', 
                    'чел.', 
                    array(1, 'select sum(pok3_2_2) from ons2014'), 
                    array(1, 'select sum(pok3_2_2) from ons2014 where id_okr = ')
                    ), 
               array('3.2.3 Численность обучающихся 7-11 классов, ставших победителями и призерами муниципального этапа Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_2_3) from ons2014'), 
                    array(1, 'select sum(pok3_2_3) from ons2014 where id_okr = ')
                    ), 
               array('3.2.4 Общее количество призовых мест, занятых обучающимися 7-11 классов на муниципальном этапе Всероссийской олимпиады школьников', 
                    'мест.', 
                    array(1, 'select sum(pok3_2_4) from ons2014'), 
                    array(1, 'select sum(pok3_2_4) from ons2014 where id_okr = ')
                    ),
                array('3.3.1 Общая численность обучающихся 9-11 классов', 
                    'чел.', 
                    array(1, 'select sum(pok3_3_1) from ons2014'), 
                    array(1, 'select sum(pok3_3_1) from ons2014 where id_okr = ')
                    ),
               array('3.3.2 Численность обучающихся 9-11 классов, принявших участие в региональном этапе Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_3_2) from ons2014'), 
                    array(1, 'select sum(pok3_3_2) from ons2014 where id_okr = ')
                    ), 
               array('3.3.4 Численность  обучающихся 9-11 классов, ставших победителями и призерами регионального этапа Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_3_4) from ons2014'), 
                    array(1, 'select sum(pok3_3_4) from ons2014 where id_okr = ')
                    ), 
               array('3.3.5 Количество призовых мест в предметных олимпиадах, занятых обучающимися 9-11 классов на региональном этапе Всероссийской олимпиады школьников', 
                    'мест.', 
                    array(1, 'select sum(pok3_3_5) from ons2014'), 
                    array(1, 'select sum(pok3_3_5) from ons2014 where id_okr = ')
                    ),
                array('3.4.1 Численность обучающихся 9-11 классов, принявших участие в заключительном этапе Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_4_1) from ons2014'), 
                    array(1, 'select sum(pok3_4_1) from ons2014 where id_okr = ')
                    ),
               array('3.4.2 Численность  обучающихся 9-11 классов, ставших победителями и призерами заключительного этапа Всероссийской олимпиады школьников', 
                    'чел.', 
                    array(1, 'select sum(pok3_4_2) from ons2014'), 
                    array(1, 'select sum(pok3_4_2) from ons2014 where id_okr = ')
                    ), 
               array('3.4.3 Количество призовых мест, занятых обучающимися 9-11 классов на заключительном этапе Всероссийской олимпиады школьников', 
                    'мест.', 
                    array(1, 'select sum(pok3_4_3) from ons2014'), 
                    array(1, 'select sum(pok3_4_3) from ons2014 where id_okr = ')
                    ), 
                array('3.5.1 Численность обучающихся, приявших участие в очных олимпиадах для школьников (кроме Всероссийской олимпиады школьников), проводимых сторонними организациями и организациими', 
                    'чел.', 
                    array(1, 'select sum(pok3_5_1) from ons2014'), 
                    array(1, 'select sum(pok3_5_1) from ons2014 where id_okr = ')
                    ),
               array('3.5.2 Численность  обучающихся, ставших победителями и призерами в очных олимпиадах для школьников (кроме Всероссийской олимпиады школьников), проводимых сторонними организациями и организациими', 
                    'чел.', 
                    array(1, 'select sum(pok3_5_2) from ons2014'), 
                    array(1, 'select sum(pok3_5_2) from ons2014 where id_okr = ')
                    ), 
               array('3.5.3 Количество призовых мест, занятых  обучающимися в очных олимпиадах для школьников (кроме Всероссийской олимпиады школьников), проводимых сторонними организациями и организациими ', 
                    'мест.', 
                    array(1, 'select sum(pok3_5_3) from ons2014'), 
                    array(1, 'select sum(pok3_5_3) from ons2014 where id_okr = ')
                    ), 
                array('3.5.4 Численность обучающихся, принявших участие в дистанционных олимпиадах, проводимых сторонними организациями', 
                    'чел.', 
                    array(1, 'select sum(pok3_5_4) from ons2014'), 
                    array(1, 'select sum(pok3_5_4) from ons2014 where id_okr = ')
                    ),
               array('3.5.5 Численность обучающихся, ставших победителями и призерами в дистанционных олимпиадах, проводимых сторонними организациями', 
                    'чел.', 
                    array(1, 'select sum(pok3_5_5) from ons2014'), 
                    array(1, 'select sum(pok3_5_5) from ons2014 where id_okr = ')
                    ), 
               array('3.5.6 Количество призовых мест, занятых учащимися в дистанционных олимпиадах, проводимых сторонними организациями', 
                    'мест.', 
                    array(1, 'select sum(pok3_5_6) from ons2014'), 
                    array(1, 'select sum(pok3_5_6) from ons2014 where id_okr = ')
                    ),
                array('3.6.1 Численность обучающихся, которым созданы условия для занятий творчеством в специально оборудованных студиях', 
                    'чел.', 
                    array(1, 'select sum(pok3_6_1) from ons2014'), 
                    array(1, 'select sum(pok3_6_1) from ons2014 where id_okr = ')
                    ),
               array('3.6.2 Численность обучающихся, которым созданы условия для занятий творчеством в специально оборудованных актовых залах', 
                    'чел.', 
                    array(1, 'select sum(pok3_6_2) from ons2014'), 
                    array(1, 'select sum(pok3_6_2) from ons2014 where id_okr = ')
                    ),               
            );
            $part4 = array(
               array('4.1 Общая численность персонала общеобразовательной организации', 
                    'чел.', 
                    array(1, 'select sum(pok4_1) from ons2014'), 
                    array(1, 'select sum(pok4_1) from ons2014 where id_okr = ')
                    ),
               array('4.2 Общая численность педагогических работников', 
                    'чел.', 
                    array(1, 'select sum(pok4_2) from ons2014'), 
                    array(1, 'select sum(pok4_2) from ons2014 where id_okr = ')
                    ), 
               array('4.3 Общая численность учителей в составе персонала общеобразовательной организации', 
                    'чел.', 
                    array(1, 'select sum(pok4_3) from ons2014'), 
                    array(1, 'select sum(pok4_3) from ons2014 where id_okr = ')
                    ), 
               array('4.4 Общая численность прочих педагогических работников в общеобразовательных учреждениях', 
                    'чел.', 
                    array(1, 'select sum(pok4_4) from ons2014'), 
                    array(1, 'select sum(pok4_4) from ons2014 where id_okr = ')
                    ), 
               array('4.5 Численность управленческих кадров в составе персонала общеобразовательной организации ', 
                    'чел.', 
                    array(1, 'select sum(pok4_5) from ons2014'), 
                    array(1, 'select sum(pok4_5) from ons2014 where id_okr = ')
                    ), 
               array('4.6 Численность педагогических работников, имеющих действующий аттестат на соответствие занимаемой должности', 
                    'чел.', 
                    array(1, 'select sum(pok4_6) from ons2014'), 
                    array(1, 'select sum(pok4_6) from ons2014 where id_okr = ')
                    ), 
               array('4.7 Численность педагогических работников, имеющих действующий аттестат  на соответствие первой квалификационной категории', 
                    'чел.', 
                    array(1, 'select sum(pok4_7) from ons2014'), 
                    array(1, 'select sum(pok4_7) from ons2014 where id_okr = ')
                    ), 
               array('4.8 Численность педагогических работников,  имеющих действующий аттестат на соответствие высшей квалификационной категории', 
                    'чел.', 
                    array(1, 'select sum(pok4_8) from ons2014'), 
                    array(1, 'select sum(pok4_8) from ons2014 where id_okr = ')
                    ), 
               array('4.9 Среднемесячная начисленная заработная плата работников общеобразовательной организации за отчетный год', 
                    'руб.', 
                    array(2, 'select sum(pok4_9) from ons2014', 'select count(pok4_9) from ons2014 where pok4_9 is not null'), 
                    array(2, 'select sum(pok4_9) from ons2014 where id_okr =', 'select count(pok4_9) from ons2014 where pok4_9 is not null and id_okr =')
                    ),
               array('4.9.1 Среднемесячная начисленная заработная плата учителей общеобразовательной организации за отчетный год', 
                    'руб.', 
                    array(2, 'select sum(pok4_9_1) from ons2014', 'select count(pok4_9_1) from ons2014 where pok4_9_1 is not null'), 
                    array(2, 'select sum(pok4_9_1) from ons2014 where id_okr =', 'select count(pok4_9_1) from ons2014 where pok4_9_1 is not null and id_okr =')
                    ),
               array('4.9.2 Среднемесячная начисленная заработная плата управленческого персонала (директор и заместители директора) общеобразовательной организации за отчетный год', 
                    'руб.', 
                    array(2, 'select sum(pok4_9_2) from ons2014', 'select count(pok4_9_2) from ons2014 where pok4_9_2 is not null'), 
                    array(2, 'select sum(pok4_9_2) from ons2014 where id_okr =', 'select count(pok4_9_2) from ons2014 where pok4_9_2 is not null and id_okr =')
                    ),
               array('4.9.3 Среднемесячная начисленная заработная плата прочих педагогических работников общеобразовательной организации за отчетный год', 
                    'руб.', 
                    array(2, 'select sum(pok4_9_3) from ons2014', 'select count(pok4_9_3) from ons2014 where pok4_9_3 is not null'), 
                    array(2, 'select sum(pok4_9_3) from ons2014 where id_okr =', 'select count(pok4_9_3) from ons2014 where pok4_9_3 is not null and id_okr =')
                    ),
                array('4.10 Численность педагогических работников (учителей и прочих педагогических работников), принятых на работу в текущем году ', 'чел.', 
                    array(1,'select sum(pok4_10) from ons2014'), 
                    array(1, 'select sum(pok4_10) from ons2014 where id_okr=')
                    ),
                array('4.10.1 Численность педагогических работников (учителей и прочих педагогических работников), принятых на работу в текущем году, в том числе в сельской местности', 'чел.', 
                    array(3, 'select sum(pok4_10) from ons2014 where mesto = 0'), 
                    array(3, 'select sum(pok4_10) from ons2014 where mesto = 0 and id_okr=')
                    ),
                array('4.10.2 Численность педагогических работников (учителей и прочих педагогических работников), принятых на работу в текущем году, в том числе в городской местности', 'чел.', 
                    array(3, 'select sum(pok4_10) from ons2014 where mesto = 1'), 
                    array(3, 'select sum(pok4_10) from ons2014 where mesto = 1 and id_okr=')), 
               array('4.11 Численность педагогических работников (учителей и прочих педагогических работников), принятых на работу в текущем году и поддержанных на уровне субъекта РФ разовыми выплатами', 
                    'чел.', 
                    array(1, 'select sum(pok4_11) from ons2014'), 
                    array(1, 'select sum(pok4_11) from ons2014 where id_okr = ')
                    ),
               array('4.12 Численность педагогических работников (учителей и прочих педагогических работников), принятых на работу в текущем году и включенных в программу по поддержке молодых специалистов выплатами на период от 2-х и более лет', 
                    'чел.', 
                    array(1, 'select sum(pok4_12) from ons2014'), 
                    array(1, 'select sum(pok4_12) from ons2014 where id_okr = ')
                    ), 
               array('4.14 Численность педагогических кадров, имеющих высшее профессиональное образование в составе персонала общеобразовательной организации', 
                    'чел.', 
                    array(1, 'select sum(pok4_14) from ons2014'), 
                    array(1, 'select sum(pok4_14) from ons2014 where id_okr = ')
                    ), 
               array('4.15 Численность учителей в возрасте до 30 лет  в составе персонала общеобразовательной организации', 
                    'чел.', 
                    array(1, 'select sum(pok4_15) from ons2014'), 
                    array(1, 'select sum(pok4_15) from ons2014 where id_okr = ')
                    ), 
               array('4.16 Численность учителей, которые являются наставниками для молодых специалистов, в составе персонала общеобразовательной организации', 
                    'чел.', 
                    array(1, 'select sum(pok4_16) from ons2014'), 
                    array(1, 'select sum(pok4_16) from ons2014 where id_okr = ')
                    ), 
               array('4.17 Численность учителей, которые являются наставниками для молодых специалистов и которым в отчетном году была оказана моральная поддержка (присвоение званий, награждение и т.д.)', 
                    'чел.', 
                    array(1, 'select sum(pok4_17) from ons2014'), 
                    array(1, 'select sum(pok4_17) from ons2014 where id_okr = ')
                    ), 
               array('4.18 Численность учителей, которые являются наставниками для молодых специалистов и которым в отчетном году была оказана материальная поддержка (доплаты из стимулирующей части фонда заработной платы, выплаты по отдельно принятым нормативным правовым актам и т.д.)', 
                    'чел.', 
                    array(1, 'select sum(pok4_18) from ons2014'), 
                    array(1, 'select sum(pok4_18) from ons2014 where id_okr = ')
                    ), 
               array('4.19 Численность учителей, работающих в созданных в субъекте Российской Федерации профессиональных сообществах (ассоциации учителей-предметников иные общественные профессиональные объединения)', 
                    'чел.', 
                    array(1, 'select sum(pok4_19) from ons2014'), 
                    array(1, 'select sum(pok4_19) from ons2014 where id_okr = ')
                    ), 
               array('4.20 Численность педагогических работников,  прошедших в истекшем учебном году курсы повышения квалификации, в том числе:', 
                    'чел.', 
                    array(1, 'select sum(pok4_20) from ons2014'), 
                    array(1, 'select sum(pok4_20) from ons2014 where id_okr = ')
                    ), 
               array('4.21 Численность педагогических работников,  прошедших в истекшем учебном году курсы повышения квалификации по персонифицированной модели повышения квалификации', 
                    'чел.', 
                    array(1, 'select sum(pok4_21) from ons2014'), 
                    array(1, 'select sum(pok4_21) from ons2014 where id_okr = ')
                    ),                 
                
            );
            $part5 = array(
               array('5.3 Средняя наполняемость класса  старшей ступени в государственных (муниципальных) общеобразовательных организациях ', 
                    'чел.', 
                    array(2, 'select sum(pok5_1) from ons2014', 'select count(pok5_1) from ons2014 where pok5_1 > 0'), 
                    array(2, 'select sum(pok5_1) from ons2014 where id_okr =', 'select count(pok5_1) from ons2014 where pok5_1 > 0 and id_okr =')
                    ), 
               array('5.4.1 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой имеющей читальный зал библиотеки/медиатеки с числом рабочих мест не менее 25', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_1) from ons2014'), 
                    array(1, 'select sum(pok5_2_1) from ons2014 where id_okr = ')
                    ),
               array('5.4.2 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой с обеспечением возможности работы на стационарных компьютерах или использования переносных компьютеров ', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_2) from ons2014'), 
                    array(1, 'select sum(pok5_2_2) from ons2014 where id_okr = ')
                    ),
               array('5.4.3 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой с медиатекой', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_3) from ons2014'), 
                    array(1, 'select sum(pok5_2_3) from ons2014 where id_okr = ')
                    ), 
               array('5.4.4 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой оснащенную средствами сканирования и распознавания текстов ', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_4) from ons2014'), 
                    array(1, 'select sum(pok5_2_4) from ons2014 where id_okr = ')
                    ), 
               array('5.4.5 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой с выходом в Интернет с компьютеров, расположенных в помещении библиотеки ', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_5) from ons2014'), 
                    array(1, 'select sum(pok5_2_5) from ons2014 where id_okr = ')
                    ), 
               array('5.4.6 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой с контролируемой распечаткой бумажных материалов', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_6) from ons2014'), 
                    array(1, 'select sum(pok5_2_6) from ons2014 where id_okr = ')
                    ), 
               array('5.4.7 Численность обучающихся, которые имеют возможность пользоваться современной библиотекой с контролируемым копированием бумажных материалов', 
                    'чел.', 
                    array(1, 'select sum(pok5_2_7) from ons2014'), 
                    array(1, 'select sum(pok5_2_7) from ons2014 where id_okr = ')
                    ),
               array('5.5 Численность обучающихся, которым обеспечена возможность пользоваться широкополосным Интернетом (не менее 2 Мб/с), от общей численности обучающихся ', 
                    'чел.', 
                    array(1, 'select sum(pok5_3) from ons2014'), 
                    array(1, 'select sum(pok5_3) from ons2014 where id_okr = ')
                    ),
               array('5.6 Количество школ, имеющих широкополосный Интернет (не менее 2 Мб/с)', 
                    'ед.', 
                    array(1, 'select sum(pok5_4) from ons2014'), 
                    array(1, 'select sum(pok5_4) from ons2014 where id_okr = ')
                    ), 
               array('5.7 Численность детей-инвалидов, которым  показано обучение на дому', 
                    'чел.', 
                    array(1, 'select sum(pok5_5) from ons2014'), 
                    array(1, 'select sum(pok5_5) from ons2014 where id_okr = ')
                    ), 
               array('5.9 Численность обучающихся 10-11 классов общеобразовательных организаций, обучающихся в отдельных зданиях общеобразовательных организаций ', 
                    'чел.', 
                    array(1, 'select sum(pok5_7) from ons2014'), 
                    array(1, 'select sum(pok5_7) from ons2014 where id_okr = ')
                    ), 
               array('5.10 Количество построенных новых школ в отчетном году', 
                    'ед.', 
                    array(1, 'select sum(pok5_8) from ons2014'), 
                    array(1, 'select sum(pok5_8) from ons2014 where id_okr = ')
                    ),
               array('5.11 Численность обучающихся в школах, построенных в отчетном году', 
                    'чел.', 
                    array(3, 'select sum(pok1_1) from ons2014 where pok5_8 = 1'), 
                    array(3, 'select sum(pok1_1) from ons2014 where pok5_8 = 1 and id_okr=')
                    ),
               array('5.12 Количество построенных новых спортивных залов при школах в отчетном году ', 
                    'ед.', 
                    array(1, 'select sum(pok5_9) from ons2014'), 
                    array(1, 'select sum(pok5_9) from ons2014 where id_okr = ')
                    ),
               array('5.13 Количество школ, в которых в отчетном году проведен капитальный ремонт', 
                    'ед.', 
                    array(1, 'select sum(pok5_10) from ons2014'), 
                    array(1, 'select sum(pok5_10) from ons2014 where id_okr = ')
                    ),
               array('5.14 Общая численность сельских школьников нуждающихся в подвозе', 
                    'чел.', 
                    array(1, 'select sum(pok5_11) from ons2014'), 
                    array(1, 'select sum(pok5_11) from ons2014 where id_okr = ')
                    ),
               array('5.15 Численность сельских школьников, которым  обеспечен ежедневный подвоз в школы', 
                    'чел.', 
                    array(1, 'select sum(pok5_12) from ons2014'), 
                    array(1, 'select sum(pok5_12) from ons2014 where id_okr = ')
                    ),
               array('5.16 Общая численность городских школьников нуждающихся в подвозе', 
                    'чел.', 
                    array(1, 'select sum(pok5_13) from ons2014'), 
                    array(1, 'select sum(pok5_13) from ons2014 where id_okr = ')
                    ),
               array('5.17 Численность  городских школьников, которым обеспечен ежедневный подвоз в школы', 
                    'чел.', 
                    array(1, 'select sum(pok5_14) from ons2014'), 
                    array(1, 'select sum(pok5_14) from ons2014 where id_okr = ')
                    ),
               array('5.18 Количество общеобразовательных организаций, имеющих учебно-производственные мастерские', 
                    'ед.', 
                    array(1, 'select sum(pok5_15) from ons2014'), 
                    array(1, 'select sum(pok5_15) from ons2014 where id_okr = ')
                    ),
               array('5.19 Численность обучающихся в общеобразовательных организациях, имеющих учебно-производственные мастерские', 
                    'чел.', 
                    array(3, 'select sum(pok1_1) from ons2014 where pok5_15 = 1'), 
                    array(3, 'select sum(pok1_1) from ons2014 where pok5_15 = 1 and id_okr=')
                    ),                
                
            );
            $part6 = array(
               array('6.1 Общее количество зданий общеобразовательных организаций', 
                    'ед.', 
                    array(1, 'select sum(pok6_1) from ons2014'), 
                    array(1, 'select sum(pok6_1) from ons2014 where id_okr = ')
                    ),
               array('6.2 Количество зданий общеобразовательных организаций, в которых обеспечена безбарьерная среда для детей с ограниченными возможностями здоровья', 
                    'ед.', 
                    array(1, 'select sum(pok6_2) from ons2014'), 
                    array(1, 'select sum(pok6_2) from ons2014 where id_okr = ')
                    ),
               array('6.3 Количество общеобразовательных организаций, в которых обеспечена возможность пользоваться столовыми, в которых выполнены все перечисленные требования:', 
                    'ед.', 
                    array(3, 'select count(id_report) from ons2014 where pok6_3_1 = 1 and pok6_3_2 = 1 and pok6_3_3 = 1 and pok6_3_4 = 1 and pok6_3_5 = 1'), 
                    array(3, 'select count(id_report) from ons2014 where pok6_3_1 = 1 and pok6_3_2 = 1 and pok6_3_3 = 1 and pok6_3_4 = 1 and pok6_3_5 = 1 and id_okr=')
                    ),                
               array('6.3.1 - собственная (на условиях договора пользования) столовая или зал для приема пищи с площадью в соответствии с СанПиН', 
                    'ед.', 
                    array(1, 'select sum(pok6_3_1) from ons2014'), 
                    array(1, 'select sum(pok6_3_1) from ons2014 where id_okr = ')
                    ),
               array('6.3.2 - технологическое оборудование', 
                    'ед.', 
                    array(1, 'select sum(pok6_3_2) from ons2014'), 
                    array(1, 'select sum(pok6_3_2) from ons2014 where id_okr = ')
                    ),
               array('6.3.3 - наличие сотрудников, квалифицированных для работы на современном технологическом оборудовании', 
                    'ед.', 
                    array(1, 'select sum(pok6_3_3) from ons2014'), 
                    array(1, 'select sum(pok6_3_3) from ons2014 where id_okr = ')
                    ),
               array('6.3.4 - помещение столовой не требует ремонта', 
                    'ед.', 
                    array(1, 'select sum(pok6_3_4) from ons2014'), 
                    array(1, 'select sum(pok6_3_4) from ons2014 where id_okr = ')
                    ),
               array('6.3.5 - современно оформленный зал для приема пищи ', 
                    'ед.', 
                    array(1, 'select sum(pok6_3_5) from ons2014'), 
                    array(1, 'select sum(pok6_3_5) from ons2014 where id_okr = ')
                    ),  
               array('6.4 Количество общеобразовательных организаций, в которых осуществляется реализация образовательных программ по формированию культуры здорового питания', 
                    'ед.', 
                    array(1, 'select sum(pok6_4) from ons2014'), 
                    array(1, 'select sum(pok6_4) from ons2014 where id_okr = ')
                    ),
               array('6.5.1 Численность обучающихся, которые получают только горячие завтраки', 
                    'чел.', 
                    array(1, 'select sum(pok6_5_1) from ons2014'), 
                    array(1, 'select sum(pok6_5_1) from ons2014 where id_okr = ')
                    ),
               array('6.5.2 Численность обучающихся, которые получают только горячие обеды', 
                    'чел.', 
                    array(1, 'select sum(pok6_5_2) from ons2014'), 
                    array(1, 'select sum(pok6_5_2) from ons2014 where id_okr = ')
                    ),
               array('6.5.4 Обеспечение условий для реализации федеральных требований к общеобразовательным организациям в части охраны здоровья обучающихся, воспитанников', 
                    'чел.', 
                    array(1, 'select sum(pok6_5_4) from ons2014'), 
                    array(1, 'select sum(pok6_5_4) from ons2014 where id_okr = ')
                    ),
               array('6.5.5 Численность обучающихся, которым созданы современные условия для занятий физической культурой, в том числе обеспечена возможность пользоваться современно оборудованными спортзалами и спортплощадками', 
                    'чел.', 
                    array(1, 'select sum(pok6_5_5) from ons2014'), 
                    array(1, 'select sum(pok6_5_5) from ons2014 where id_okr = ')
                    ),                
               array('6.5.3 Численность обучающихся, которые получают горячие завтраки и обеды', 
                    'чел.', 
                    array(1, 'select sum(pok6_5_3) from ons2014'), 
                    array(1, 'select sum(pok6_5_3) from ons2014 where id_okr = ')
                    ),                
               array('6.6.1 -  собственный спортивный зал или спортивный зал на условиях договора пользования ', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_1) from ons2014'), 
                    array(1, 'select sum(pok6_6_1) from ons2014 where id_okr = ')
                    ),
               array('6.6.2 - площадь зала для занятий не менее 9х18м', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_2) from ons2014'), 
                    array(1, 'select sum(pok6_6_2) from ons2014 where id_okr = ')
                    ),
               array('6.6.3 - высота зала не менее 6 м', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_3) from ons2014'), 
                    array(1, 'select sum(pok6_6_3) from ons2014 where id_okr = ')
                    ),
               array('6.6.4 - оборудованные раздевалки', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_4) from ons2014'), 
                    array(1, 'select sum(pok6_6_4) from ons2014 where id_okr = ')
                    ),
               array('6.6.5 - действующие душевые комнаты', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_5) from ons2014'), 
                    array(1, 'select sum(pok6_6_5) from ons2014 where id_okr = ')
                    ),
               array('6.6.6 - действующие туалеты', 
                    'чел.', 
                    array(1, 'select sum(pok6_6_6) from ons2014'), 
                    array(1, 'select sum(pok6_6_6) from ons2014 where id_okr = ')
                    ), 
               array('6.7.1 - собственная оборудованная территория или на условиях договора пользования', 
                    'чел.', 
                    array(1, 'select sum(pok6_7_1) from ons2014'), 
                    array(1, 'select sum(pok6_7_1) from ons2014 where id_okr = ')
                    ),
               array('6.7.2 - размеченные дорожки для бега', 
                    'чел.', 
                    array(1, 'select sum(pok6_7_2) from ons2014'), 
                    array(1, 'select sum(pok6_7_2) from ons2014 where id_okr = ')
                    ),
               array('6.7.3 - дорожки для бега с твердым покрытием', 
                    'чел.', 
                    array(1, 'select sum(pok6_7_3) from ons2014'), 
                    array(1, 'select sum(pok6_7_3) from ons2014 where id_okr = ')
                    ),
               array('6.7.4 - оборудованный сектор для метания', 
                    'чел.', 
                    array(1, 'select sum(pok6_7_4) from ons2014'), 
                    array(1, 'select sum(pok6_7_4) from ons2014 where id_okr = ')
                    ),
               array('6.7.5 - оборудованный сектор для прыжков в длину', 
                    'чел.', 
                    array(1, 'select sum(pok6_7_5) from ons2014'), 
                    array(1, 'select sum(pok6_7_5) from ons2014 where id_okr = ')
                    ),
               array('6.8 Количество общеобразовательных организаций,  в которых предусмотрено более 3-х часов физической культуры в неделю', 
                    'ед.', 
                    array(1, 'select sum(pok6_8) from ons2014'), 
                    array(1, 'select sum(pok6_8) from ons2014 where id_okr = ')
                    ),
               array('6.9 Численность обучающихся, в образовательном плане которых предусмотрено более 3 часов занятий физической культуры в неделю', 
                    'чел.', 
                    array(1, 'select sum(pok6_9) from ons2014'), 
                    array(1, 'select sum(pok6_9) from ons2014 where id_okr = ')
                    ),
               array('6.10.1 собственный лицензионный медицинский кабинет или на условиях договора пользования', 
                    'чел.', 
                    array(1, 'select sum(pok6_10_1) from ons2014'), 
                    array(1, 'select sum(pok6_10_1) from ons2014 where id_okr = ')
                    ),
               array('6.10.2 имеется  не менее 1 квалифицированного медицинского работника', 
                    'чел.', 
                    array(1, 'select sum(pok6_10_2) from ons2014'), 
                    array(1, 'select sum(pok6_10_2) from ons2014 where id_okr = ')
                    ),                
            );
            $part7 = array(
               array('7.1 Количество общеобразовательных организаций, перешедших на нормативное подушевое финансирование в соответствии с модельной методикой Минобрнауки России', 
                    'ед.', 
                    array(1, 'select sum(pok7_1) from ons2014'), 
                    array(1, 'select sum(pok7_1) from ons2014 where id_okr = ')
                    ),
               array('7.2 Количество общеобразовательных организаций, перешедших на новую систему оплаты труда в соответствии с модельной методикой Минобрнауки России', 
                    'ед.', 
                    array(1, 'select sum(pok7_2) from ons2014'), 
                    array(1, 'select sum(pok7_2) from ons2014 where id_okr = ')
                    ),
               array('7.3 Количество автономных общеобразовательных организаций ', 
                    'ед.', 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 1'), 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 1 and id_okr=')
                    ),
               array('7.4 Количество бюджетных  общеобразовательных организаций ', 
                    'ед.', 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 2'), 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 2 and id_okr=')
                    ),
               array('7.5 Количество  казенных  общеобразовательных организаций ', 
                    'ед.', 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 3'), 
                    array(3, 'select count(id_report) from ons2014 where pok7_3 = 3 and id_okr=')
                    ),
               array('7.6 Количество общеобразовательных организаций, которые представили общественности публичный доклад и/или отчет о самообследовании, обеспечивающий открытость и прозрачность деятельности организации', 
                    'ед.', 
                    array(1, 'select sum(pok7_4) from ons2014'), 
                    array(1, 'select sum(pok7_4) from ons2014 where id_okr = ')
                    ),
               array('7.7 Количество общеобразовательных организаций, которые представили общественности публичный доклад и/или отчет о самообследовании, при наличии технической возможности размещенный в сети Интернет', 
                    'ед.', 
                    array(1, 'select sum(pok7_5) from ons2014'), 
                    array(1, 'select sum(pok7_5) from ons2014 where id_okr = ')
                    ), 
               array('7.8 Количество общеобразовательных организаций, в которых взаимодействие с родителями осуществляется посредством постоянно-действующих реальных и виртуальных переговорных площадок (форум на сайте образовательного организации, общественная родительская организация, лекторий, семинар и др.)', 
                    'ед.', 
                    array(1, 'select sum(pok7_6) from ons2014'), 
                    array(1, 'select sum(pok7_6) from ons2014 where id_okr = ')
                    ),
               array('7.9 Количество общеобразовательных организаций, в которых созданы органы государственно-общественного управления', 
                    'ед.', 
                    array(1, 'select sum(pok7_7) from ons2014'), 
                    array(1, 'select sum(pok7_7) from ons2014 where id_okr = ')
                    ),
               array('7.10.1 - основных образовательных программ', 
                    'ед.', 
                    array(1, 'select sum(pok7_8_1) from ons2014'), 
                    array(1, 'select sum(pok7_8_1) from ons2014 where id_okr = ')
                    ),
               array('7.10.2 - программ развития образовательного организации', 
                    'ед.', 
                    array(1, 'select sum(pok7_8_2) from ons2014'), 
                    array(1, 'select sum(pok7_8_2) from ons2014 where id_okr = ')
                    ),
               array('7.10.3 - иных нормативно-правовых актов школы и программ', 
                    'ед.', 
                    array(1, 'select sum(pok7_8_3) from ons2014'), 
                    array(1, 'select sum(pok7_8_3) from ons2014 where id_okr = ')
                    ),
               array('7.10.4 - планов финансово-хозяйственной деятельности', 
                    'ед.', 
                    array(1, 'select sum(pok7_8_4) from ons2014'), 
                    array(1, 'select sum(pok7_8_4) from ons2014 where id_okr = ')
                    ),
               array('7.11.1 - электронный дневник', 
                    'ед.', 
                    array(1, 'select sum(pok7_9_1) from ons2014'), 
                    array(1, 'select sum(pok7_9_1) from ons2014 where id_okr = ')
                    ),
               array('7.11.2 - электронный журнал', 
                    'ед.', 
                    array(1, 'select sum(pok7_9_2) from ons2014'), 
                    array(1, 'select sum(pok7_9_2) from ons2014 where id_okr = ')
                    ),
               array('7.11.3 - электронная учительская', 
                    'ед.', 
                    array(1, 'select sum(pok7_9_3) from ons2014'), 
                    array(1, 'select sum(pok7_9_3) from ons2014 where id_okr = ')
                    ),
               array('7.12 Количество общеобразовательных организаций, предоставляющих некоторые образовательные услуги в электронном виде (запись в школу, ответы на обращения и др.)', 
                    'ед.', 
                    array(1, 'select sum(pok7_10) from ons2014'), 
                    array(1, 'select sum(pok7_10) from ons2014 where id_okr = ')
                    ),                 
            );
            $name = 'part'.$id;
            return $$name;                        
        }
        
        
        public function actionExcel() {
              if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                //if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                if(Yii::app()->session['type_adm'] == 4) {
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            ons2014.mesto as mesto,
                            ons2014.pok1_1 as pok1_1,
                            ons2014.pok1_2 as pok1_2,
                            ons2014.pok1_2_1 as pok1_2_1,
                            ons2014.pok1_2_2 as pok1_2_2,
                            ons2014.pok1_3 as pok1_3,
                            ons2014.pok1_3_1 as pok1_3_1,
                            ons2014.pok1_3_2 as pok1_3_2,
                            ons2014.pok1_4_1 as pok1_4_1,
                            ons2014.pok1_4_2 as pok1_4_2,
                            ons2014.pok1_5_1 as pok1_5_1,
                            ons2014.pok1_5_2 as pok1_5_2,
                            ons2014.pok1_6_1 as pok1_6_1,
                            ons2014.pok1_6_2 as pok1_6_2,
                            ons2014.pok1_7_1 as pok1_7_1,
                            ons2014.pok1_7_2 as pok1_7_2,
                            ons2014.pok1_8 as pok1_8,
                            ons2014.pok1_8_1 as pok1_8_1,
                            ons2014.pok1_8_2 as pok1_8_2,
                            ons2014.pok1_9_1 as pok1_9_1,
                            ons2014.pok1_9_2 as pok1_9_2,
                            ons2014.pok1_10_1 as pok1_10_1,
                            ons2014.pok1_10_2 as pok1_10_2,
                            ons2014.pok1_11_1 as pok1_11_1,
                            ons2014.pok1_11_2 as pok1_11_2,
                            ons2014.pok1_12 as pok1_12,
                            ons2014.pok1_13 as pok1_13,
                            ons2014.pok2_1 as pok2_1,
                            ons2014.pok2_1_1 as pok2_1_1,
                            ons2014.pok2_1_2 as pok2_1_2,
                            ons2014.pok2_1_3 as pok2_1_3,
                            ons2014.pok2_1_4 as pok2_1_4,
                            ons2014.pok2_1_5 as pok2_1_5,
                            ons2014.pok2_1_6 as pok2_1_6,
                            ons2014.pok2_2_1 as pok2_2_1,
                            ons2014.pok2_2_2 as pok2_2_2,
                            ons2014.pok2_2_3 as pok2_2_3,
                            ons2014.pok2_3_1 as pok2_3_1,
                            ons2014.pok2_3_2 as pok2_3_2,
                            ons2014.pok2_3_3 as pok2_3_3,
                            ons2014.pok2_4_1 as pok2_4_1,
                            ons2014.pok2_4_2 as pok2_4_2,
                            ons2014.pok2_4_3 as pok2_4_3,
                            ons2014.pok2_5_1 as pok2_5_1,
                            ons2014.pok2_5_2 as pok2_5_2,
                            ons2014.pok2_5_3 as pok2_5_3,
                            ons2014.pok2_5_4 as pok2_5_4,
                            ons2014.pok2_5_5 as pok2_5_5,
                            ons2014.pok2_5_6 as pok2_5_6,
                            ons2014.pok2_6_1 as pok2_6_1,
                            ons2014.pok2_6_2 as pok2_6_2,
                            ons2014.pok2_6_3 as pok2_6_3,
                            ons2014.pok2_6_4 as pok2_6_4,
                            ons2014.pok2_6_5 as pok2_6_5,
                            ons2014.pok2_6_6 as pok2_6_6,
                            ons2014.pok2_7_1 as pok2_7_1,
                            ons2014.pok2_7_2 as pok2_7_2,
                            ons2014.pok2_7_3 as pok2_7_3,
                            ons2014.pok2_7_4 as pok2_7_4,
                            ons2014.pok2_7_5 as pok2_7_5,
                            ons2014.pok2_7_6 as pok2_7_6,
                            ons2014.pok2_8_1 as pok2_8_1,
                            ons2014.pok2_8_2 as pok2_8_2,
                            ons2014.pok2_8_3 as pok2_8_3,
                            ons2014.pok2_9_1 as pok2_9_1,
                            ons2014.pok2_9_2 as pok2_9_2,
                            ons2014.pok2_10_1 as pok2_10_1,
                            ons2014.pok2_10_2 as pok2_10_2,
                            ons2014.pok2_10_3 as pok2_10_3,
                            ons2014.pok2_11 as pok2_11,
                            ons2014.pok2_11_1 as pok2_11_1,
                            ons2014.pok3_1_1 as pok3_1_1,
                            ons2014.pok3_1_2 as pok3_1_2,
                            ons2014.pok3_2_1 as pok3_2_1,
                            ons2014.pok3_2_2 as pok3_2_2,
                            ons2014.pok3_2_3 as pok3_2_3,
                            ons2014.pok3_2_4 as pok3_2_4,
                            ons2014.pok3_3_1 as pok3_3_1,
                            ons2014.pok3_3_2 as pok3_3_2,
                            ons2014.pok3_3_4 as pok3_3_4,
                            ons2014.pok3_3_5 as pok3_3_5,
                            ons2014.pok3_4_1 as pok3_4_1,
                            ons2014.pok3_4_2 as pok3_4_2,
                            ons2014.pok3_4_3 as pok3_4_3,
                            ons2014.pok3_5_1 as pok3_5_1,
                            ons2014.pok3_5_2 as pok3_5_2,
                            ons2014.pok3_5_3 as pok3_5_3,
                            ons2014.pok3_5_4 as pok3_5_4,
                            ons2014.pok3_5_5 as pok3_5_5,
                            ons2014.pok3_5_6 as pok3_5_6,
                            ons2014.pok3_6_1 as pok3_6_1,
                            ons2014.pok3_6_2 as pok3_6_2,
                            ons2014.pok4_1 as pok4_1,
                            ons2014.pok4_2 as pok4_2,
                            ons2014.pok4_3 as pok4_3,
                            ons2014.pok4_4 as pok4_4,
                            ons2014.pok4_5 as pok4_5,
                            ons2014.pok4_6 as pok4_6,
                            ons2014.pok4_7 as pok4_7,
                            ons2014.pok4_8 as pok4_8,
                            ons2014.pok4_9 as pok4_9,
                            ons2014.pok4_9_1 as pok4_9_1,
                            ons2014.pok4_9_2 as pok4_9_2,
                            ons2014.pok4_9_3 as pok4_9_3,
                            ons2014.pok4_10 as pok4_10,
                            ons2014.pok4_11 as pok4_11,
                            ons2014.pok4_12 as pok4_12,
                            ons2014.pok4_14 as pok4_14,
                            ons2014.pok4_15 as pok4_15,
                            ons2014.pok4_16 as pok4_16,
                            ons2014.pok4_17 as pok4_17,
                            ons2014.pok4_18 as pok4_18,
                            ons2014.pok4_19 as pok4_19,
                            ons2014.pok4_20 as pok4_20,
                            ons2014.pok4_21 as pok4_21,
                            ons2014.pok5_1 as pok5_1,
                            ons2014.pok5_2_1 as pok5_2_1,
                            ons2014.pok5_2_2 as pok5_2_2,
                            ons2014.pok5_2_3 as pok5_2_3,
                            ons2014.pok5_2_4 as pok5_2_4,
                            ons2014.pok5_2_5 as pok5_2_5,
                            ons2014.pok5_2_6 as pok5_2_6,
                            ons2014.pok5_2_7 as pok5_2_7,
                            ons2014.pok5_3 as pok5_3,
                            ons2014.pok5_4 as pok5_4,
                            ons2014.pok5_5 as pok5_5,
                            ons2014.pok5_7 as pok5_7,
                            ons2014.pok5_8 as pok5_8,
                            ons2014.pok5_9 as pok5_9,
                            ons2014.pok5_10 as pok5_10,
                            ons2014.pok5_11 as pok5_11,
                            ons2014.pok5_12 as pok5_12,
                            ons2014.pok5_13 as pok5_13,
                            ons2014.pok5_14 as pok5_14,
                            ons2014.pok5_15 as pok5_15,
                            ons2014.pok6_1 as pok6_1,
                            ons2014.pok6_2 as pok6_2,
                            ons2014.pok6_3_1 as pok6_3_1,
                            ons2014.pok6_3_2 as pok6_3_2,
                            ons2014.pok6_3_3 as pok6_3_3,
                            ons2014.pok6_3_4 as pok6_3_4,
                            ons2014.pok6_3_5 as pok6_3_5,
                            ons2014.pok6_4 as pok6_4,
                            ons2014.pok6_5_1 as pok6_5_1,
                            ons2014.pok6_5_2 as pok6_5_2,
                            ons2014.pok6_5_3 as pok6_5_3,
                            ons2014.pok6_6_1 as pok6_6_1,
                            ons2014.pok6_6_2 as pok6_6_2,
                            ons2014.pok6_6_3 as pok6_6_3,
                            ons2014.pok6_6_4 as pok6_6_4,
                            ons2014.pok6_6_5 as pok6_6_5,
                            ons2014.pok6_6_6 as pok6_6_6,
                            ons2014.pok6_7_1 as pok6_7_1,
                            ons2014.pok6_7_2 as pok6_7_2,
                            ons2014.pok6_7_3 as pok6_7_3,
                            ons2014.pok6_7_4 as pok6_7_4,
                            ons2014.pok6_7_5 as pok6_7_5,
                            ons2014.pok6_8 as pok6_8,
                            ons2014.pok6_9 as pok6_9,
                            ons2014.pok6_10_1 as pok6_10_1,
                            ons2014.pok6_10_2 as pok6_10_2,
                            ons2014.pok7_1 as pok7_1,
                            ons2014.pok7_2 as pok7_2,
                            ons2014.pok7_3 as pok7_3,
                            ons2014.pok7_4 as pok7_4,
                            ons2014.pok7_5 as pok7_5,
                            ons2014.pok7_6 as pok7_6,
                            ons2014.pok7_7 as pok7_7,
                            ons2014.pok7_8_1 as pok7_8_1,
                            ons2014.pok7_8_2 as pok7_8_2,
                            ons2014.pok7_8_3 as pok7_8_3,
                            ons2014.pok7_8_4 as pok7_8_4,
                            ons2014.pok7_9_1 as pok7_9_1,
                            ons2014.pok7_9_2 as pok7_9_2,
                            ons2014.pok7_9_3 as pok7_9_3,
                            ons2014.pok7_10 as pok7_10
                            from ons2014, report, est where
                            ons2014.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type);
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            ons2014.mesto as mesto,
                            ons2014.pok1_1 as pok1_1,
                            ons2014.pok1_2 as pok1_2,
                            ons2014.pok1_2_1 as pok1_2_1,
                            ons2014.pok1_2_2 as pok1_2_2,
                            ons2014.pok1_3 as pok1_3,
                            ons2014.pok1_3_1 as pok1_3_1,
                            ons2014.pok1_3_2 as pok1_3_2,
                            ons2014.pok1_4_1 as pok1_4_1,
                            ons2014.pok1_4_2 as pok1_4_2,
                            ons2014.pok1_5_1 as pok1_5_1,
                            ons2014.pok1_5_2 as pok1_5_2,
                            ons2014.pok1_6_1 as pok1_6_1,
                            ons2014.pok1_6_2 as pok1_6_2,
                            ons2014.pok1_7_1 as pok1_7_1,
                            ons2014.pok1_7_2 as pok1_7_2,
                            ons2014.pok1_8 as pok1_8,
                            ons2014.pok1_8_1 as pok1_8_1,
                            ons2014.pok1_8_2 as pok1_8_2,
                            ons2014.pok1_9_1 as pok1_9_1,
                            ons2014.pok1_9_2 as pok1_9_2,
                            ons2014.pok1_10_1 as pok1_10_1,
                            ons2014.pok1_10_2 as pok1_10_2,
                            ons2014.pok1_11_1 as pok1_11_1,
                            ons2014.pok1_11_2 as pok1_11_2,
                            ons2014.pok1_12 as pok1_12,
                            ons2014.pok1_13 as pok1_13,
                            ons2014.pok2_1 as pok2_1,
                            ons2014.pok2_1_1 as pok2_1_1,
                            ons2014.pok2_1_2 as pok2_1_2,
                            ons2014.pok2_1_3 as pok2_1_3,
                            ons2014.pok2_1_4 as pok2_1_4,
                            ons2014.pok2_1_5 as pok2_1_5,
                            ons2014.pok2_1_6 as pok2_1_6,
                            ons2014.pok2_2_1 as pok2_2_1,
                            ons2014.pok2_2_2 as pok2_2_2,
                            ons2014.pok2_2_3 as pok2_2_3,
                            ons2014.pok2_3_1 as pok2_3_1,
                            ons2014.pok2_3_2 as pok2_3_2,
                            ons2014.pok2_3_3 as pok2_3_3,
                            ons2014.pok2_4_1 as pok2_4_1,
                            ons2014.pok2_4_2 as pok2_4_2,
                            ons2014.pok2_4_3 as pok2_4_3,
                            ons2014.pok2_5_1 as pok2_5_1,
                            ons2014.pok2_5_2 as pok2_5_2,
                            ons2014.pok2_5_3 as pok2_5_3,
                            ons2014.pok2_5_4 as pok2_5_4,
                            ons2014.pok2_5_5 as pok2_5_5,
                            ons2014.pok2_5_6 as pok2_5_6,
                            ons2014.pok2_6_1 as pok2_6_1,
                            ons2014.pok2_6_2 as pok2_6_2,
                            ons2014.pok2_6_3 as pok2_6_3,
                            ons2014.pok2_6_4 as pok2_6_4,
                            ons2014.pok2_6_5 as pok2_6_5,
                            ons2014.pok2_6_6 as pok2_6_6,
                            ons2014.pok2_7_1 as pok2_7_1,
                            ons2014.pok2_7_2 as pok2_7_2,
                            ons2014.pok2_7_3 as pok2_7_3,
                            ons2014.pok2_7_4 as pok2_7_4,
                            ons2014.pok2_7_5 as pok2_7_5,
                            ons2014.pok2_7_6 as pok2_7_6,
                            ons2014.pok2_8_1 as pok2_8_1,
                            ons2014.pok2_8_2 as pok2_8_2,
                            ons2014.pok2_8_3 as pok2_8_3,
                            ons2014.pok2_9_1 as pok2_9_1,
                            ons2014.pok2_9_2 as pok2_9_2,
                            ons2014.pok2_10_1 as pok2_10_1,
                            ons2014.pok2_10_2 as pok2_10_2,
                            ons2014.pok2_10_3 as pok2_10_3,
                            ons2014.pok2_11 as pok2_11,
                            ons2014.pok2_11_1 as pok2_11_1,
                            ons2014.pok3_1_1 as pok3_1_1,
                            ons2014.pok3_1_2 as pok3_1_2,
                            ons2014.pok3_2_1 as pok3_2_1,
                            ons2014.pok3_2_2 as pok3_2_2,
                            ons2014.pok3_2_3 as pok3_2_3,
                            ons2014.pok3_2_4 as pok3_2_4,
                            ons2014.pok3_3_1 as pok3_3_1,
                            ons2014.pok3_3_2 as pok3_3_2,
                            ons2014.pok3_3_4 as pok3_3_4,
                            ons2014.pok3_3_5 as pok3_3_5,
                            ons2014.pok3_4_1 as pok3_4_1,
                            ons2014.pok3_4_2 as pok3_4_2,
                            ons2014.pok3_4_3 as pok3_4_3,
                            ons2014.pok3_5_1 as pok3_5_1,
                            ons2014.pok3_5_2 as pok3_5_2,
                            ons2014.pok3_5_3 as pok3_5_3,
                            ons2014.pok3_5_4 as pok3_5_4,
                            ons2014.pok3_5_5 as pok3_5_5,
                            ons2014.pok3_5_6 as pok3_5_6,
                            ons2014.pok3_6_1 as pok3_6_1,
                            ons2014.pok3_6_2 as pok3_6_2,
                            ons2014.pok4_1 as pok4_1,
                            ons2014.pok4_2 as pok4_2,
                            ons2014.pok4_3 as pok4_3,
                            ons2014.pok4_4 as pok4_4,
                            ons2014.pok4_5 as pok4_5,
                            ons2014.pok4_6 as pok4_6,
                            ons2014.pok4_7 as pok4_7,
                            ons2014.pok4_8 as pok4_8,
                            ons2014.pok4_9 as pok4_9,
                            ons2014.pok4_9_1 as pok4_9_1,
                            ons2014.pok4_9_2 as pok4_9_2,
                            ons2014.pok4_9_3 as pok4_9_3,
                            ons2014.pok4_10 as pok4_10,
                            ons2014.pok4_11 as pok4_11,
                            ons2014.pok4_12 as pok4_12,
                            ons2014.pok4_14 as pok4_14,
                            ons2014.pok4_15 as pok4_15,
                            ons2014.pok4_16 as pok4_16,
                            ons2014.pok4_17 as pok4_17,
                            ons2014.pok4_18 as pok4_18,
                            ons2014.pok4_19 as pok4_19,
                            ons2014.pok4_20 as pok4_20,
                            ons2014.pok4_21 as pok4_21,
                            ons2014.pok5_1 as pok5_1,
                            ons2014.pok5_2_1 as pok5_2_1,
                            ons2014.pok5_2_2 as pok5_2_2,
                            ons2014.pok5_2_3 as pok5_2_3,
                            ons2014.pok5_2_4 as pok5_2_4,
                            ons2014.pok5_2_5 as pok5_2_5,
                            ons2014.pok5_2_6 as pok5_2_6,
                            ons2014.pok5_2_7 as pok5_2_7,
                            ons2014.pok5_3 as pok5_3,
                            ons2014.pok5_4 as pok5_4,
                            ons2014.pok5_5 as pok5_5,
                            ons2014.pok5_7 as pok5_7,
                            ons2014.pok5_8 as pok5_8,
                            ons2014.pok5_9 as pok5_9,
                            ons2014.pok5_10 as pok5_10,
                            ons2014.pok5_11 as pok5_11,
                            ons2014.pok5_12 as pok5_12,
                            ons2014.pok5_13 as pok5_13,
                            ons2014.pok5_14 as pok5_14,
                            ons2014.pok5_15 as pok5_15,
                            ons2014.pok6_1 as pok6_1,
                            ons2014.pok6_2 as pok6_2,
                            ons2014.pok6_3_1 as pok6_3_1,
                            ons2014.pok6_3_2 as pok6_3_2,
                            ons2014.pok6_3_3 as pok6_3_3,
                            ons2014.pok6_3_4 as pok6_3_4,
                            ons2014.pok6_3_5 as pok6_3_5,
                            ons2014.pok6_4 as pok6_4,
                            ons2014.pok6_5_1 as pok6_5_1,
                            ons2014.pok6_5_2 as pok6_5_2,
                            ons2014.pok6_5_3 as pok6_5_3,
                            ons2014.pok6_6_1 as pok6_6_1,
                            ons2014.pok6_6_2 as pok6_6_2,
                            ons2014.pok6_6_3 as pok6_6_3,
                            ons2014.pok6_6_4 as pok6_6_4,
                            ons2014.pok6_6_5 as pok6_6_5,
                            ons2014.pok6_6_6 as pok6_6_6,
                            ons2014.pok6_7_1 as pok6_7_1,
                            ons2014.pok6_7_2 as pok6_7_2,
                            ons2014.pok6_7_3 as pok6_7_3,
                            ons2014.pok6_7_4 as pok6_7_4,
                            ons2014.pok6_7_5 as pok6_7_5,
                            ons2014.pok6_8 as pok6_8,
                            ons2014.pok6_9 as pok6_9,
                            ons2014.pok6_10_1 as pok6_10_1,
                            ons2014.pok6_10_2 as pok6_10_2,
                            ons2014.pok7_1 as pok7_1,
                            ons2014.pok7_2 as pok7_2,
                            ons2014.pok7_3 as pok7_3,
                            ons2014.pok7_4 as pok7_4,
                            ons2014.pok7_5 as pok7_5,
                            ons2014.pok7_6 as pok7_6,
                            ons2014.pok7_7 as pok7_7,
                            ons2014.pok7_8_1 as pok7_8_1,
                            ons2014.pok7_8_2 as pok7_8_2,
                            ons2014.pok7_8_3 as pok7_8_3,
                            ons2014.pok7_8_4 as pok7_8_4,
                            ons2014.pok7_9_1 as pok7_9_1,
                            ons2014.pok7_9_2 as pok7_9_2,
                            ons2014.pok7_9_3 as pok7_9_3,
                            ons2014.pok7_10 as pok7_10
                            from ons2014, report, est where
                            ons2014.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }                
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    /*if($data[$i]['mesto'] == 0) $data[$i]['mesto']='город';
                    else $data[$i]['mesto'] = 'село';*/
                }
                $pokaz = Ons2014::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                //array_unshift($data, $pokaz);
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                 // Turn off our amazing library autoload
                spl_autoload_unregister(array('YiiBase','autoload'));
                 //
                 // making use of our reference, include the main class
                 // when we do this, phpExcel has its own autoload registration
                 // procedure (PHPExcel_Autoloader::Register();)
                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                //подключаем и создаем класс PHPExcel
                $diap = 'A2:FW2';
                $pExcel = new PHPExcel();
                $pExcel->setActiveSheetIndex(0);
                $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                $pExcel->getDefaultStyle()->getFont()->setSize(10);
                $aSheet = $pExcel->getActiveSheet();
                $center = array(
                    'alignment'=>array(
                        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    ),                    
                );
                $aSheet->getDefaultStyle($diap)->applyFromArray($center);                
                $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
                $aSheet->getStyle($diap)->getFont()->setBold(true);
                $aSheet->setTitle('ННШ-2014');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $aSheet->getRowDimension('2')->setRowHeight(130);
                for($i = 0; $i < sizeof($data); $i++) {
                    $k = 0;
                    foreach ($data[$i] as $value) {
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="ons2014.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
                /*$xls = new Excel_XML('UTF-8', false, 'osn');
                $xls->addArray($data);
                $xls->generateXML('osn');*/
            }
            else {
                header("Location: http://mon.cposo.ru/"); /* Redirect browser */
                exit;
            }
        }         
        
}        

