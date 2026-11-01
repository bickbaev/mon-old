<?php

class Building2015Controller extends Controller
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
            if (Yii::app()->user->isGuest) $this->redirect('index.php?r=site/login');
            elseif (Yii::app()->session['type_adm'] < 2) throw new CHttpException(403,'У Вас нет необходимых прав');
            else $filterChain->run();
        }
        
	public function actionIndex($id_rep_type)
	{
            $otchet = $this->otchet($id_rep_type);
            $muns = Yii::app()->db->createCommand('select id_est, est_name, id_okr from est where type_adm = 2 order by id_okr ASC')->queryAll();
            $itog[0] = 'Область';                
            foreach($muns as $mun) {
                $data = array();
                $schet_sum = 0;
                $schet_count = 0;
                $data['id'] = $mun['id_est'];
                $data['okr'] = Yii::app()->db->createCommand('select est_name from est where id_est = '.$mun['id_okr'])->queryScalar();
                $data['mun'] = CHtml::link($mun['est_name'], array('building2015/mun', 'id_mun' => $mun['id_est'], 'id_rep_type' => $id_rep_type));
                $data['build'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build1'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 1 and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build2'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 2 and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build3'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 3 and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $munds = Yii::app()->db->createCommand('select 
                        building2015.pok1,
                        building2015.pok2,
                        building2015.pok3,
                        building2015.pok4,
                        building2015.pok5,
                        building2015.pok6,
                        building2015.pok7,
                        building2015.pok8,
                        building2015.pok9,
                        building2015.pok10,
                        building2015.pok11,
                        building2015.pok12,
                        building2015.pok13,
                        building2015.pok14,
                        building2015.pok15,
                        building2015.pok16,
                        building2015.pok17,
                        building2015.pok18,
                        building2015.pok19,
                        building2015.pok20,
                        building2015.pok21  
                        from building2015, report, est 
                        where building2015.id_report = report.id_report 
                        and report.id_est = est.id_est 
                        and est.id_raion = '.$mun['id_est'].' 
                        and report.id_rep_type= '.$id_rep_type)->queryAll();
                foreach($munds as $mund) {
                   $schet = 0; 
                   if($mund['pok1'] == 1)  $schet = $schet + 1;
                   if($mund['pok2'] == 1)  $schet = $schet + 1;
                   if($mund['pok3'] == 1)  $schet = $schet + 1;
                   if($mund['pok4'] == 1)  $schet = $schet + 1;
                   if($mund['pok5'] == 1)  $schet = $schet + 1;
                   if($mund['pok6'] == 1)  $schet = $schet + 1;
                   if($mund['pok7'] == 1)  $schet = $schet + 1;
                   if($mund['pok8'] == 1)  $schet = $schet + 1;
                   if($mund['pok9'] == 1)  $schet = $schet + 1;
                   if($mund['pok10'] == 1)  $schet = $schet + 1;
                   if($mund['pok11'] == 1)  $schet = $schet + 1;
                   if($mund['pok12'] == 2)  $schet = $schet + 1;
                   if($mund['pok13'] == 2)  $schet = $schet + 1;
                   if($mund['pok14'] == 2)  $schet = $schet + 1;
                   if($mund['pok15'] == 1)  $schet = $schet + 1;
                   if($mund['pok16'] == 2)  $schet = $schet + 1;
                   if($mund['pok17'] == 2)  $schet = $schet + 1;
                   if($mund['pok18'] == 2)  $schet = $schet + 1;
                   if($mund['pok19'] == 2)  $schet = $schet + 1;
                   if($mund['pok20'] == 1)  $schet = $schet + 1;
                   if($mund['pok21'] == 2)  $schet = $schet + 1;
                   if($schet == 21) $data['sto'] = $data['sto'] + 1;
                   if($schet > 17) $data['sem'] = $data['sem'] + 1;
                   $schet_sum = $schet_sum + $schet;
                   $schet_count = $schet_count + 1;
                }
                if($schet_count) $data['sr'] = round(($schet_sum*100/(21*$schet_count)), 2);                    
                else $data['sr'] = '';
                $mun_data[] = $data;
                $itog[1] = $itog[1] + $data['build'];
                $itog[5] = $itog[5] + $data['build1'];
                $itog[6] = $itog[6] + $data['build2'];
                $itog[7] = $itog[7] + $data['build3'];
                $itog[3] = $itog[3] + $data['sto'];
                $itog[4] = $itog[4] + $data['sem'];
                $schet_sum_i = $schet_sum_i + $schet_sum;                    
            }
            $itog[2] = round(($schet_sum_i*100/(21*$itog[1])), 2);
            $provider = new CArrayDataProvider($mun_data , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            $this->render('index', array('id_rep' => $id_rep_type, 'provider' => $provider, 'itog' => $itog, 'otchet'=>$otchet));
        }
        
        public function actionMun($id_mun, $id_rep_type) {
            $otchet = $this->otchet($id_rep_type);
            $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_est = '.(int)$id_mun)->queryRow();
            if(!$mun['est_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
            $itog[2][0] = 'Итого';
            $ests = Yii::app()->db->createCommand('select est.id_est, est.est_name from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type = 2 and est.id_raion ='.(int)$id_mun.' and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est')->queryAll();
            //$ests = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and id_type = '.$i.' and id_raion ='.(int)$id_mun)->queryAll();                
            foreach($ests as $est) {
                $data = array();
                $data['id'] = $est['id_est'];
                $data['naim'] = CHtml::link($est['est_name'], array('building2015/est', 'id_est' => $est['id_est'], 'id_rep_type' => $id_rep_type));                    
                $data['build'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build1'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 1 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build2'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 2 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                $data['build3'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 3 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();                
                $est_data[2][] = $data;
                $itog[2][1] = $itog[2][1] + $data['build'];
                $itog[2][2] = $itog[2][2] + $data['build1'];
                $itog[2][3] = $itog[2][3] + $data['build2'];
                $itog[2][4] = $itog[2][4] + $data['build3'];                
            }
            if($id_mun == 15 || $id_mun == 16) {
                $itog[1][0] = 'Итого';                
                $ests = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and id_type = 1 and id_raion ='.(int)$id_mun)->queryAll();                
                foreach($ests as $est) {
                    $data = array();
                    $data['id'] = $est['id_est'];
                    $data['naim'] = CHtml::link($est['est_name'], array('building2015/est', 'id_est' => $est['id_est'], 'id_rep_type' => $id_rep_type));                    
                    $data['build'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build1'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 1 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build2'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 2 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build3'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 3 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();                    
                    $est_data[1][] = $data;
                    $itog[1][1] = $itog[1][1] + $data['build'];
                    $itog[1][2] = $itog[1][2] + $data['build1'];
                    $itog[1][3] = $itog[1][3] + $data['build2'];
                    $itog[1][4] = $itog[1][4] + $data['build3'];                      
                }
                $itog[3][0] = 'Итого';                
                //$ests = Yii::app()->db->createCommand('select est.id_est, est.est_name from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type = 3 and est.id_raion ='.(int)$id_mun.' and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est')->queryAll();
                $ests = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and id_type = 3 and id_raion ='.(int)$id_mun)->queryAll();                
                foreach($ests as $est) {
                    $data = array();
                    $data['id'] = $est['id_est'];
                    $data['naim'] = CHtml::link($est['est_name'], array('building2015/est', 'id_est' => $est['id_est'], 'id_rep_type' => $id_rep_type));                    
                    $data['build'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build1'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 1 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build2'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 2 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build3'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 3 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();                      
                    $est_data[3][] = $data;
                    $itog[3][1] = $itog[3][1] + $data['build'];
                    $itog[3][2] = $itog[3][2] + $data['build1'];
                    $itog[3][3] = $itog[3][3] + $data['build2'];
                    $itog[3][4] = $itog[3][4] + $data['build3'];                      
                }                 
            }
            if($id_mun == 23) {
                $itog[3][0] = 'Итого';                
                $ests = Yii::app()->db->createCommand('select est.id_est, est.est_name from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type = 3 and est.id_raion ='.(int)$id_mun.' and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est')->queryAll();
                //$ests = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and id_type = 3 and id_raion ='.(int)$id_mun)->queryAll();                
                foreach($ests as $est) {
                    $data = array();
                    $data['id'] = $est['id_est'];
                    $data['naim'] = CHtml::link($est['est_name'], array('building2015/est', 'id_est' => $est['id_est'], 'id_rep_type' => $id_rep_type));                    
                    $data['build'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build1'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 1 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build2'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 2 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();
                    $data['build3'] = Yii::app()->db->createCommand('select count(building2015.id_building) from building2015, report, est where building2015.id_report = report.id_report and building2015.ur1 = 3 and report.id_est = est.id_est and est.id_est = '.$est['id_est'].' and report.id_rep_type='.$id_rep_type)->queryScalar();                      
                    $est_data[3][] = $data;
                    $itog[3][1] = $itog[3][1] + $data['build'];
                    $itog[3][2] = $itog[3][2] + $data['build1'];
                    $itog[3][3] = $itog[3][3] + $data['build2'];
                    $itog[3][4] = $itog[3][4] + $data['build3'];                      
                }                 
            }
            if(sizeof($est_data[1])) $dou = new CArrayDataProvider($est_data[1], array('id'=>'id', 'pagination'=>array('pageSize'=>300)));
            $sosh = new CArrayDataProvider($est_data[2], array('id'=>'id', 'pagination'=>array('pageSize'=>300)));
            if(sizeof($est_data[3]))$dod = new CArrayDataProvider($est_data[3], array('id'=>'id', 'pagination'=>array('pageSize'=>300)));
            $this->render('mun', array('id_rep' => $id_rep_type, 'dou' => $dou, 'sosh' => $sosh, 'dod' => $dod, 'otchet'=>$otchet, 'mun'=>$mun, 'itog'=>$itog));            
        }
        
        public function actionEst($id_est, $id_rep_type) {
            $otchet = $this->otchet($id_rep_type);
            $est = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and status = 1 and id_est = '.(int)$id_est)->queryRow();
            if(!$est['est_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
            $id_report = Yii::app()->db->createCommand('select id_report from report where id_est = '.$id_est.' and id_rep_type = '.$id_rep_type)->queryScalar();
            if(!$id_report) throw new CHttpException(403,'У Вас нет необходимых прав');
            $buildings = new CActiveDataProvider('Building2015', array(
                'criteria'=>array(
                    'condition' => 'id_report ='.$id_report,
                    'order' => 'id_building ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
                )
            );             
            $this->render('est', array('id_rep' => $id_rep_type, 'est' => $est, 'buildings' => $buildings, 'otchet'=>$otchet));
        }
        
        public function actionBuild($id_building) {
            $model = Building2015::model()->findByPk((int)$id_building);
            if($model===null) throw new CHttpException(403,'У Вас нет необходимых прав');
            $id_rep_type = Yii::app()->db->createCommand('select report.id_rep_type from report, building2015 where building2015.id_report=report.id_report and building2015.id_building = '.$model->id_building)->queryScalar();
            $this->render('build', array('model' => $model, 'id_rep_type' => $id_rep_type));            
        }
        
        public function address($data) {
            if($data->litera) $korpus = ', корпус '.$data->litera;
            $adr = Contact_gor::model()->findByPk($data->nas_punkt_type)->naim_gor.' '.$data->nas_punkt.', '.Contact_ul::model()->findByPk($data->street_type)->naim_ul.' '.$data->street.', дом №'.$data->dom.$korpus;
            return CHtml::link($adr, array('building2015/build', 'id_building' => $data->id_building));
        }
        
        public function ur($data) {
            if($data->ur1 == 1) $ur = 'дошкольного образования';
            elseif($data->ur1 == 2) $ur = 'общего образования';
            else $ur = 'дополнительного образования';            
            return $ur;
        }        
        
        public function actionExcel($id_rep_type) {
            
            $otchet = $this->otchet($id_rep_type);
            if(Yii::app()->session['type_adm'] > 3) $okr = '';
            elseif(Yii::app()->session['type_adm'] == 3) $okr = ' and est.id_okr = '.Yii::app()->session['est'];
            else  throw new CHttpException(403,'У Вас нет необходимых прав');
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();;
            foreach ($reader as $value) {
                $okrug[$value['id_est']] = $value['est_name'];
            }
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($reader as $value) {
                $raion[$value['id_est']] = $value['est_name'];
            }
            $reader = Yii::app()->db->createCommand('select * from contact_gor')->queryAll();
            foreach ($reader as $value) {
                $gor[$value['id_contact_gor']] = $value['naim_gor'];
            }
            $reader = Yii::app()->db->createCommand('select * from contact_ul')->queryAll();
            foreach ($reader as $value) {
                $ul[$value['id_contact_ul']] = $value['naim_ul'];
            }            
            $data = Yii::app()->db->createCommand('select
                    est.id_okr as id_okr,
                    est.id_raion as id_raion,
                    est.est_name as est_name,                    
                    building2015.nas_punkt_type,
                    building2015.nas_punkt,
                    building2015.street_type,
                    building2015.street,
                    building2015.dom,
                    building2015.litera,                    
                    building2015.pok1 as pok1,
                    building2015.pok2 as pok2,
                    building2015.pok3 as pok3,
                    building2015.pok4 as pok4,
                    building2015.pok5 as pok5,
                    building2015.pok6 as pok6,
                    building2015.pok7 as pok7,
                    building2015.pok8 as pok8,
                    building2015.pok9 as pok9,
                    building2015.pok10 as pok10,
                    building2015.pok11 as pok11,
                    building2015.pok12 as pok12,
                    building2015.pok13 as pok13,
                    building2015.pok14 as pok14,
                    building2015.pok15 as pok15,
                    building2015.pok16 as pok16,
                    building2015.pok17 as pok17,
                    building2015.pok18 as pok18,
                    building2015.pok19 as pok19,
                    building2015.pok20 as pok20,
                    building2015.pok21 as pok21
                    from building2015, report, est where
                    building2015.id_report = report.id_report
                    and report.id_est = est.id_est '.$okr.' 
                    and report.id_rep_type ='.$id_rep_type.
                    ' order by est.id_okr, est.id_raion, est.id_est')->queryAll();
            for($i = 0; $i <sizeof($data); $i++) {
                $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                $data[$i]['nas_punkt_type'] = $gor[$data[$i]['nas_punkt_type']];
                $data[$i]['street_type'] = $ul[$data[$i]['street_type']];
                for($k = 1; $k < 22; $k++) {
                    if($data[$i]['pok'.$k] == 1) $data[$i]['pok'.$k] = 'Да';
                    else $data[$i]['pok'.$k] = 'Нет';
                }
                /*$korpus = '';
                if($data[$i]['litera']) $korpus = ', корпус '.$data[$i]['litera'];
                $data[$i]['adr'] = $data[$i]['gor'].' '.$data[$i]['nas_punkt'].', '.$data[$i]['ul'].' '.$data[$i]['street'].', дом №'.$data[$i]['dom'].$korpus; */               
            }
            /*$pokaz = Building2015::model()->attributeLabels();
            array_shift($pokaz);
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
            $pokaz = $dabavka + $pokaz;*/
            $pokaz = array(
                'id_okr'=>'Округ',
                'id_raion'=>'Район',
                'est_name'=>'Учреждение',
                'nas_punkt_type' => 'Тип населенного пункта',
                'nas_punkt' => 'Название населенного пункта',
                'street_type' => 'Тип улицы',
                'street' => 'Улица',
                'dom' => 'Номер дома',
                'litera' => 'Номер корпуса',
                'pok1' => 'Наличие благоустроенного земельного участка с дорожками, площадками покрытыми асфальтобетоном и другим твердым покрытием, не требующего проведения капитального ремонта',
                'pok2' => 'Наличие ограждения территории, обеспечивающего безопасность детей и находящегося в технически исправном состоянии',
                'pok3' => 'Обеспечение температурного режима в соответствии с санитарными нормами и правилами',
                'pok4' => 'Наличие работающей системы холодного и горячего водоснабжения, обеспечивающей бесперебойный санитарный и хозяйственно-питьевой режим в соответствии с санитарными нормами и правилами (при отсутствии протечек)',
                'pok5' => 'Наличие работающей системы отопления, обеспечивающей необходимый температурный режим в помещениях зданий образовательных учреждений',
                'pok6' => 'Наличие работающей системы канализации',
                'pok7' => 'Наличие оборудованных туалетов в соответствии с санитарными нормами и правилами (наличие современного санитарно-технического оборудования, кабинок, отсутствие сколов и выбоин в плиточном покрытии стен и полов)',
                'pok8' => 'Наличие оборудованных аварийных выходов, отвечающих требованиям пожарной безопасности',
                'pok9' => 'Соответствие автоматической пожарной сигнализации и системы оповещения людей при пожаре требованиям пожарной безопасности',
                'pok10' => 'Соответствие электропроводки, электрооборудования требованиям пожарной безопасности',
                'pok11' => 'Соответствие путей эвакуации требованиям пожарной безопасности',
                'pok12' => 'Наличие деформаций наружных и внутренних стен (трещины, отклонение от вертикали, выпучивание, выпадение кирпичей)',
                'pok13' => 'Наличие следов протечек, промерзания наружных стен',
                'pok14' => 'Наличие в плоских крышах вздутий, пробоин, большое количество заплат кровельного покрытия, ржавление и разрушение настенных желобов (деталей водоприемных устройств), в скатных крышах – ослабление крепления отдельных листов к обрешетке, отдельные протечки, просветы, большое количество заплат, поражение гнилью и прогибы деревянных конструкций обрешетки и стропил, ржавление и разрушение настенных желобов (деталей водоприемных устройств)',
                'pok15' => 'Наличие ограждения кровли по периметру здания, высотой не менее 0,6 метра',
                'pok16' => 'Наличие в конструкции деревянного пола щелей между досками, стирание досок в ходовых местах, прогибы и просадка досок',
                'pok17' => 'Наличие в конструкции пола из рулонных материалов отставание в стыках от основания напольного покрытия и вздутие местами, истертость напольного покрытия местами',
                'pok18' => 'Наличие в оконных деревянных переплетах поражений гнилью, рассыхания, нарушение сопряжения, разрушение (отсутствие) отливов',
                'pok19' => 'Наличие в дверных деревянных переплетах скосов, по периметру неплотный притвор дверных полотен',
                'pok20' => 'Соответствие дверей на путях эвакуации техническому регламенту о требованиях пожарной безопасности (по огнестойкости, по высоте, по ширине, наличие приспособления для самозакрывания и уплотнения)',
                'pok21' => 'Наличие дефектов внутренних стен и перегородок (отставание или отбитые места накрывочного слоя, мелкие и глубокие трещины)',                
            );
            //array_unshift($data, $pokaz);
            $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
            $phpExcelPath = '/var/www/mon/public_html/www/protected/vendors/phpexcel';
             // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
             //
             // making use of our reference, include the main class
             // when we do this, phpExcel has its own autoload registration
             // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            //подключаем и создаем класс PHPExcel
            $pExcel = new PHPExcel();
            $diap = 'A2:AD2';
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Состояние зданий');
            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);
            $i = 0;
            foreach ($pokaz as $value) {
                $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                $i = $i + 1;
            }
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension('2')->setRowHeight(150);
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );
            $aSheet->getDefaultStyle($diap)->applyFromArray($center);
            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);            
            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(40);
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
            header('Content-Disposition: attachment;filename="building.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }          
        
        protected function otchet($id_rep_type) {
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.(int)$id_rep_type);
                $otchet = $command->queryRow();
                if(!$otchet['rep_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
                return $otchet;
        }
        
       
}
