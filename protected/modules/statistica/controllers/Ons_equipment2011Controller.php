<?php

class Ons_equipment2011Controller extends Controller
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
        
	public function actionIndex()
	{
          if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $osns = $this->osn($id_rep_type);
                $osn = new CArrayDataProvider($osns[0], array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                $o_col = $osns[1];
                $osnps = $this->osnp($id_rep_type);
                $osnp = new CArrayDataProvider($osnps[0], array('id'=>'id', 'pagination'=>array('pageSize'=>200)));                
                $op_col = $osnps[1];                
                $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'osn'=>$osn, 'o_col'=>$o_col, 'osnp'=>$osnp, 'op_col'=>$op_col));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        protected function osn($id_rep_type) {
                $col = array(
                    array(            // display 'create_time' using an expression
                        'name'=>'link',
                        'header'=>'Управление',   
                        'type'=>'html',
                        'footer'=>'<strong>Область</strong>',
                ));
                $okrs = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach($okrs as $okr) {
                    $mes_data = array();   
                    $mes_data['id'] = $okr['id_est'];
                    $mes_data['link'] = CHtml::link($okr['est_name'], array('ons_equipment2011/okr', 'id_okr' => $okr['id_est'], 'id_rep_type' => $id_rep_type, 'type'=> 1));
                    $mes_data['osn'] = $this->osn_data(1, $id_rep_type, $okr);                        
                    $okr_data[] = $mes_data;
                } 
                $obl_data['osn'] = $this->osn_data('', $id_rep_type, '');
                $col[] =  array(            // display 'create_time' using an expression
                    'name'=>'osn',
                    'header'=>'Значение',
                    'type'=>'html',
                    'footer'=>'<strong>'.$obl_data['osn'].'</strong>',
                    );                
                //$osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                return array($okr_data, $col);
                //$this->render('osn', array('osn'=>$osn, 'col'=>$col));             
        }
        
       public function osnp($id_rep_type) {
                $col = array(
                    array(            // display 'create_time' using an expression
                        'name'=>'link',
                        'header'=>'Управление',   
                        'type'=>'html',
                        'footer'=>'<strong>Область</strong>',
                ));
                $okrs = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach($okrs as $okr) {
                    $mes_data = array();   
                    $mes_data['id'] = $okr['id_est'];
                    $mes_data['link'] = CHtml::link($okr['est_name'], array('ons_equipment2011/okr', 'id_okr' => $okr['id_est'], 'id_rep_type' => $id_rep_type, 'type'=> 2));
                    $mes_data['osn'] = $this->osnp_data(1, $id_rep_type, $okr);                        
                    $okr_data[] = $mes_data;
                } 
                $obl_data['osn'] = $this->osnp_data('', $id_rep_type, '');
                $col[] =  array(            // display 'create_time' using an expression
                    'name'=>'osn',
                    'header'=>'Значение',
                    'type'=>'html',
                    'footer'=>'<strong>'.$obl_data['osn'].'</strong>',
                    );                
                //$osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                return array($okr_data, $col);            
        }         
        
        public function actionOkr($id_okr, $id_rep_type, $type) {
          if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int)$_GET['id_rep_type'];
                $id_okr = (int)$_GET['id_okr'];
                $type = (int)$type;
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                if(!$otchet['rep_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
                $naim_okr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3 and id_okr = '.$id_okr)->queryRow();
                if(!$naim_okr['id_est']) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $col = array(
                    array(            // display 'create_time' using an expression
                        'name'=>'link',
                        'header'=>'Муниципалитет',   
                        'type'=>'html',
                        'footer'=>'<strong>'.$naim_okr['est_name'].'</strong>',
                ));
                $okrs = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr = '.$id_okr)->queryAll();
                foreach($okrs as $okr) {
                    $mes_data = array();   
                    $mes_data['id'] = $okr['id_est'];
                    $mes_data['link'] = CHtml::link($okr['est_name'], array('ons_equipment2011/raion', 'id_raion' => $okr['id_est'], 'id_rep_type' => $id_rep_type, 'type'=> $type));
                    if($type == 1) $mes_data['osn'] = $this->osn_data(2, $id_rep_type, $okr);
                    else $mes_data['osn'] = $this->osnp_data(2, $id_rep_type, $okr);
                    $okr_data[] = $mes_data;
                } 
                if($type == 1) $obl_data['osn'] = $this->osn_data(1, $id_rep_type, $naim_okr);
                else $obl_data['osn'] = $this->osnp_data(1, $id_rep_type, $naim_okr);
                $col[] =  array(            // display 'create_time' using an expression
                    'name'=>'osn',
                    'header'=>'Значение',
                    'type'=>'html',
                    'footer'=>'<strong>'.$obl_data['osn'].'</strong>',
                    );                
                //$osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                //return array($okr_data, $col);
                //$this->render('osn', array('osn'=>$osn, 'col'=>$col));
                $osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                $this->render('okr', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'osn'=>$osn, 'o_col'=>$col, 'type'=>$type));                  
          }
          else $this->redirect(Yii::app()->user->returnUrl);                
        }
        
        public function actionRaion($id_raion, $id_rep_type, $type) {
                $id_rep_type = (int) $id_rep_type;
                $id_raion = (int) $id_raion;
                $type = (int)$type;
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow(); 
                if(!$otchet['rep_name']) throw new CHttpException(403,'У Вас нет необходимых прав'); 
                $naim_raion = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_raion = '.$id_raion)->queryRow();
                if(!$naim_raion['id_est']) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $col = array(
                    array(            // display 'create_time' using an expression
                        'name'=>'link',
                        'header'=>'Школа',   
                        'type'=>'html',
                        'footer'=>'<strong>'.$naim_raion['est_name'].'</strong>',
                ));
                $okrs = Yii::app()->db->createCommand('select id_report from ons_equipment2011 where id_rep_type ='.$id_rep_type.' and id_raion = '.$id_raion)->queryAll();
                foreach($okrs as $okr) {
                    $est_name = Yii::app()->db->createCommand('select est.est_name as est_name from est, report where est.id_est = report.id_est and report.id_report = '.$okr['id_report'])->queryScalar();
                    $mes_data = array();   
                    $mes_data['id'] = $okr['id_report'];
                    $mes_data['link'] = $est_name;
                    if($type == 1) $mes_data['osn'] = $this->osn_data(3, $id_rep_type, $okr);
                    else $mes_data['osn'] = $this->osnp_data(3, $id_rep_type, $okr);
                    $okr_data[] = $mes_data;
                } 
                if($type == 1) $obl_data['osn'] = $this->osn_data(2, $id_rep_type, $naim_raion);
                else $obl_data['osn'] = $this->osnp_data(2, $id_rep_type, $naim_raion);
                $col[] =  array(            // display 'create_time' using an expression
                    'name'=>'osn',
                    'header'=>'Значение',
                    'type'=>'html',
                    'footer'=>'<strong>'.$obl_data['osn'].'</strong>',
                    );                
                //$osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                //return array($okr_data, $col);
                //$this->render('osn', array('osn'=>$osn, 'col'=>$col));
                //print_r($okr_data);
                $osn = new CArrayDataProvider($okr_data, array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
                $this->render('okr', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'osn'=>$osn, 'o_col'=>$col, 'type'=>$type));                                  
        }         
        
        protected function osn_data($tip, $id_rep_type, $ter) {
            $dobavka = $this->dobavka($tip, $ter);
            $osn1_col = Yii::app()->db->createCommand('select count(id_report) from ons_equipment2011 where
                                                        (step2+step3) > 0 and
                                                        (pok0+pok1+pok2+pok3+pok4+pok5+pok6+pok7+pok8+pok9+pok10+((pok11+pok12)>0)+pok13+((pok16+pok17)>0)+pok18+pok19+pok20+pok21+pok22+((pok26+pok27)>0)+pok28+pok29+pok30+pok31+pok32+((pok33+pok34)>0)+((pok35+pok36)>0)+pok37+pok38+((pok50+pok51)>0)+pok53+pok54+pok55+pok56+pok57+(pok61>0)+(pok62>0)+pok65+pok67+pok68+pok69+pok70+pok71+pok72+pok73+pok74+pok75+pok76+pok78+pok79+pok80+pok81+pok82+pok83+pok84+pok85+pok87+pok89+(pok100>0)+((pok101+pok102)>0))>47
                                                        and id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();
            $osn2_col = Yii::app()->db->createCommand('select count(id_report) from ons_equipment2011 where
                                                        (step2+step3) = 0 and
                                                        (pok0+pok1+pok2+pok3+pok4+pok5+pok6+pok7+pok8+pok9+pok10+((pok11+pok12)>0)+pok13+((pok16+pok17)>0)+pok18+pok19+pok20+pok21+pok22+((pok26+pok27)>0)+pok28+pok29+pok30+pok31+pok32+((pok50+pok51)>0)+pok53+pok54+pok55+pok56+pok57+(pok61>0)+(pok62>0)+pok65+pok87+pok89+(pok100>0)+((pok101+pok102)>0))>30
                                                        and id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();
            $sch_col = Yii::app()->db->createCommand('select count(id_report) from ons_equipment2011 where id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();
            if($tip == 3) {
                if(!($sch_col)) return '';
                elseif (($osn1_col+$osn2_col) == 0) return '';
                else return 'соврем.';
            }
            else {
            if(!($sch_col)) return '';
            else return sprintf("%01.2f", ($osn1_col+$osn2_col)*100/$sch_col); 
            }
        }
        
        protected function osnp_data($tip, $id_rep_type, $ter) {
            $dobavka = $this->dobavka($tip, $ter);

            $osn1_col = Yii::app()->db->createCommand('select sum(step1+step2+step3) from ons_equipment2011 where
                                                        (step2+step3) > 0 and
                                                        (pok0+pok1+pok2+pok3+pok4+pok5+pok6+pok7+pok8+pok9+pok10+((pok11+pok12)>0)+pok13+((pok16+pok17)>0)+pok18+pok19+pok20+pok21+pok22+((pok26+pok27)>0)+pok28+pok29+pok30+pok31+pok32+((pok33+pok34)>0)+((pok35+pok36)>0)+pok37+pok38+((pok50+pok51)>0)+pok53+pok54+pok55+pok56+pok57+(pok61>0)+(pok62>0)+pok65+pok67+pok68+pok69+pok70+pok71+pok72+pok73+pok74+pok75+pok76+pok78+pok79+pok80+pok81+pok82+pok83+pok84+pok85+pok87+pok89+(pok100>0)+((pok101+pok102)>0))>47
                                                        and id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();
            $osn2_col = Yii::app()->db->createCommand('select sum(step1+step2+step3) from ons_equipment2011 where
                                                        (step2+step3) = 0 and
                                                        (pok0+pok1+pok2+pok3+pok4+pok5+pok6+pok7+pok8+pok9+pok10+((pok11+pok12)>0)+pok13+((pok16+pok17)>0)+pok18+pok19+pok20+pok21+pok22+((pok26+pok27)>0)+pok28+pok29+pok30+pok31+pok32+((pok50+pok51)>0)+pok53+pok54+pok55+pok56+pok57+(pok61>0)+(pok62>0)+pok65+pok87+pok89+(pok100>0)+((pok101+pok102)>0))>30
                                                        and id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();
            $sch_col = Yii::app()->db->createCommand('select sum(step1+step2+step3) from ons_equipment2011 where id_rep_type = '.$id_rep_type.$dobavka)->queryScalar();

            if(!($sch_col)) return '';
            else return sprintf("%01.2f", ($osn1_col+$osn2_col)*100/$sch_col); 
        }        
        
        protected function dobavka($tip, $ter) {
            if(!$tip) {
                $dobavka = '';

            }
            elseif($tip == 1) {
                $dobavka = ' and id_okr ='.$ter['id_est'];
                
            }
            elseif($tip == 2) {
                $dobavka = ' and id_raion ='.$ter['id_est'];

            }
            elseif($tip == 3) {
                $dobavka = ' and id_report ='.$ter['id_report'];             
            }
            return $dobavka;
        }        
        
        public function actionExcel() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') { 
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
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
                            ons_equipment2011.pok0 as pok0,
                            ons_equipment2011.pok1 as pok1,
                            ons_equipment2011.pok2 as pok2,
                            ons_equipment2011.pok3 as pok3,
                            ons_equipment2011.pok4 as pok4,
                            ons_equipment2011.pok5 as pok5,
                            ons_equipment2011.pok6 as pok6,
                            ons_equipment2011.pok7 as pok7,
                            ons_equipment2011.pok8 as pok8,
                            ons_equipment2011.pok9 as pok9,
                            ons_equipment2011.pok10 as pok10,
                            ons_equipment2011.pok11 as pok11,
                            ons_equipment2011.pok12 as pok12,
                            ons_equipment2011.pok13 as pok13,
                            ons_equipment2011.pok14 as pok14,
                            ons_equipment2011.pok15 as pok15,
                            ons_equipment2011.pok16 as pok16,
                            ons_equipment2011.pok17 as pok17,
                            ons_equipment2011.pok18 as pok18,
                            ons_equipment2011.pok19 as pok19,
                            ons_equipment2011.pok20 as pok20,
                            ons_equipment2011.pok21 as pok21,
                            ons_equipment2011.pok22 as pok22,
                            ons_equipment2011.pok23 as pok23,
                            ons_equipment2011.pok24 as pok24,
                            ons_equipment2011.pok25 as pok25,
                            ons_equipment2011.pok26 as pok26,
                            ons_equipment2011.pok27 as pok27,
                            ons_equipment2011.pok28 as pok28,
                            ons_equipment2011.pok29 as pok29,
                            ons_equipment2011.pok30 as pok30,
                            ons_equipment2011.pok31 as pok31,
                            ons_equipment2011.pok32 as pok32,
                            ons_equipment2011.pok33 as pok33,
                            ons_equipment2011.pok34 as pok34,
                            ons_equipment2011.pok35 as pok35,
                            ons_equipment2011.pok36 as pok36,
                            ons_equipment2011.pok37 as pok37,
                            ons_equipment2011.pok38 as pok38,
                            ons_equipment2011.pok39 as pok39,
                            ons_equipment2011.pok40 as pok40,
                            ons_equipment2011.pok41 as pok41,
                            ons_equipment2011.pok42 as pok42,
                            ons_equipment2011.pok43 as pok43,
                            ons_equipment2011.pok44 as pok44,
                            ons_equipment2011.pok45 as pok45,
                            ons_equipment2011.pok46 as pok46,
                            ons_equipment2011.pok47 as pok47,
                            ons_equipment2011.pok48 as pok48,
                            ons_equipment2011.pok49 as pok49,
                            ons_equipment2011.pok50 as pok50,
                            ons_equipment2011.pok51 as pok51,
                            ons_equipment2011.pok52 as pok52,
                            ons_equipment2011.pok53 as pok53,
                            ons_equipment2011.pok54 as pok54,
                            ons_equipment2011.pok55 as pok55,
                            ons_equipment2011.pok56 as pok56,
                            ons_equipment2011.pok57 as pok57,
                            ons_equipment2011.pok58 as pok58,
                            ons_equipment2011.pok59 as pok59,
                            ons_equipment2011.pok60 as pok60,
                            ons_equipment2011.pok61 as pok61,
                            ons_equipment2011.pok62 as pok62,
                            ons_equipment2011.pok63 as pok63,
                            ons_equipment2011.pok64 as pok64,
                            ons_equipment2011.pok65 as pok65,
                            ons_equipment2011.pok66 as pok66,
                            ons_equipment2011.pok67 as pok67,
                            ons_equipment2011.pok68 as pok68,
                            ons_equipment2011.pok69 as pok69,
                            ons_equipment2011.pok70 as pok70,
                            ons_equipment2011.pok71 as pok71,
                            ons_equipment2011.pok72 as pok72,
                            ons_equipment2011.pok73 as pok73,
                            ons_equipment2011.pok74 as pok74,
                            ons_equipment2011.pok75 as pok75,
                            ons_equipment2011.pok76 as pok76,
                            ons_equipment2011.pok77 as pok77,
                            ons_equipment2011.pok78 as pok78,
                            ons_equipment2011.pok79 as pok79,
                            ons_equipment2011.pok80 as pok80,
                            ons_equipment2011.pok81 as pok81,
                            ons_equipment2011.pok82 as pok82,
                            ons_equipment2011.pok83 as pok83,
                            ons_equipment2011.pok84 as pok84,
                            ons_equipment2011.pok85 as pok85,
                            ons_equipment2011.pok86 as pok86,
                            ons_equipment2011.pok87 as pok87,
                            ons_equipment2011.pok88 as pok88,
                            ons_equipment2011.pok89 as pok89,
                            ons_equipment2011.pok90 as pok90,
                            ons_equipment2011.pok91 as pok91,
                            ons_equipment2011.pok92 as pok92,
                            ons_equipment2011.pok93 as pok93,
                            ons_equipment2011.pok94 as pok94,
                            ons_equipment2011.pok95 as pok95,
                            ons_equipment2011.pok96 as pok96,
                            ons_equipment2011.pok97 as pok97,
                            ons_equipment2011.pok98 as pok98,
                            ons_equipment2011.pok99 as pok99,
                            ons_equipment2011.pok100 as pok100,
                            ons_equipment2011.pok101 as pok101,
                            ons_equipment2011.pok102 as pok102,
                            ons_equipment2011.pok103 as pok103,
                            ons_equipment2011.pok104 as pok104,
                            ons_equipment2011.pok105 as pok105,
                            ons_equipment2011.pok106 as pok106,
                            ons_equipment2011.pok107 as pok107,
                            ons_equipment2011.pok108 as pok108,
                            ons_equipment2011.pok109 as pok109,
                            ons_equipment2011.pok110 as pok110,
                            ons_equipment2011.pok111 as pok111,
                            ons_equipment2011.pok112 as pok112,
                            ons_equipment2011.step1 as step1,
                            ons_equipment2011.step2 as step2,
                            ons_equipment2011.step3 as step3
                            from ons_equipment2011, report, est where
                            ons_equipment2011.id_report = report.id_report 
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
                            ons_equipment2011.pok0 as pok0,
                            ons_equipment2011.pok1 as pok1,
                            ons_equipment2011.pok2 as pok2,
                            ons_equipment2011.pok3 as pok3,
                            ons_equipment2011.pok4 as pok4,
                            ons_equipment2011.pok5 as pok5,
                            ons_equipment2011.pok6 as pok6,
                            ons_equipment2011.pok7 as pok7,
                            ons_equipment2011.pok8 as pok8,
                            ons_equipment2011.pok9 as pok9,
                            ons_equipment2011.pok10 as pok10,
                            ons_equipment2011.pok11 as pok11,
                            ons_equipment2011.pok12 as pok12,
                            ons_equipment2011.pok13 as pok13,
                            ons_equipment2011.pok14 as pok14,
                            ons_equipment2011.pok15 as pok15,
                            ons_equipment2011.pok16 as pok16,
                            ons_equipment2011.pok17 as pok17,
                            ons_equipment2011.pok18 as pok18,
                            ons_equipment2011.pok19 as pok19,
                            ons_equipment2011.pok20 as pok20,
                            ons_equipment2011.pok21 as pok21,
                            ons_equipment2011.pok22 as pok22,
                            ons_equipment2011.pok23 as pok23,
                            ons_equipment2011.pok24 as pok24,
                            ons_equipment2011.pok25 as pok25,
                            ons_equipment2011.pok26 as pok26,
                            ons_equipment2011.pok27 as pok27,
                            ons_equipment2011.pok28 as pok28,
                            ons_equipment2011.pok29 as pok29,
                            ons_equipment2011.pok30 as pok30,
                            ons_equipment2011.pok31 as pok31,
                            ons_equipment2011.pok32 as pok32,
                            ons_equipment2011.pok33 as pok33,
                            ons_equipment2011.pok34 as pok34,
                            ons_equipment2011.pok35 as pok35,
                            ons_equipment2011.pok36 as pok36,
                            ons_equipment2011.pok37 as pok37,
                            ons_equipment2011.pok38 as pok38,
                            ons_equipment2011.pok39 as pok39,
                            ons_equipment2011.pok40 as pok40,
                            ons_equipment2011.pok41 as pok41,
                            ons_equipment2011.pok42 as pok42,
                            ons_equipment2011.pok43 as pok43,
                            ons_equipment2011.pok44 as pok44,
                            ons_equipment2011.pok45 as pok45,
                            ons_equipment2011.pok46 as pok46,
                            ons_equipment2011.pok47 as pok47,
                            ons_equipment2011.pok48 as pok48,
                            ons_equipment2011.pok49 as pok49,
                            ons_equipment2011.pok50 as pok50,
                            ons_equipment2011.pok51 as pok51,
                            ons_equipment2011.pok52 as pok52,
                            ons_equipment2011.pok53 as pok53,
                            ons_equipment2011.pok54 as pok54,
                            ons_equipment2011.pok55 as pok55,
                            ons_equipment2011.pok56 as pok56,
                            ons_equipment2011.pok57 as pok57,
                            ons_equipment2011.pok58 as pok58,
                            ons_equipment2011.pok59 as pok59,
                            ons_equipment2011.pok60 as pok60,
                            ons_equipment2011.pok61 as pok61,
                            ons_equipment2011.pok62 as pok62,
                            ons_equipment2011.pok63 as pok63,
                            ons_equipment2011.pok64 as pok64,
                            ons_equipment2011.pok65 as pok65,
                            ons_equipment2011.pok66 as pok66,
                            ons_equipment2011.pok67 as pok67,
                            ons_equipment2011.pok68 as pok68,
                            ons_equipment2011.pok69 as pok69,
                            ons_equipment2011.pok70 as pok70,
                            ons_equipment2011.pok71 as pok71,
                            ons_equipment2011.pok72 as pok72,
                            ons_equipment2011.pok73 as pok73,
                            ons_equipment2011.pok74 as pok74,
                            ons_equipment2011.pok75 as pok75,
                            ons_equipment2011.pok76 as pok76,
                            ons_equipment2011.pok77 as pok77,
                            ons_equipment2011.pok78 as pok78,
                            ons_equipment2011.pok79 as pok79,
                            ons_equipment2011.pok80 as pok80,
                            ons_equipment2011.pok81 as pok81,
                            ons_equipment2011.pok82 as pok82,
                            ons_equipment2011.pok83 as pok83,
                            ons_equipment2011.pok84 as pok84,
                            ons_equipment2011.pok85 as pok85,
                            ons_equipment2011.pok86 as pok86,
                            ons_equipment2011.pok87 as pok87,
                            ons_equipment2011.pok88 as pok88,
                            ons_equipment2011.pok89 as pok89,
                            ons_equipment2011.pok90 as pok90,
                            ons_equipment2011.pok91 as pok91,
                            ons_equipment2011.pok92 as pok92,
                            ons_equipment2011.pok93 as pok93,
                            ons_equipment2011.pok94 as pok94,
                            ons_equipment2011.pok95 as pok95,
                            ons_equipment2011.pok96 as pok96,
                            ons_equipment2011.pok97 as pok97,
                            ons_equipment2011.pok98 as pok98,
                            ons_equipment2011.pok99 as pok99,
                            ons_equipment2011.pok100 as pok100,
                            ons_equipment2011.pok101 as pok101,
                            ons_equipment2011.pok102 as pok102,
                            ons_equipment2011.pok103 as pok103,
                            ons_equipment2011.pok104 as pok104,
                            ons_equipment2011.pok105 as pok105,
                            ons_equipment2011.pok106 as pok106,
                            ons_equipment2011.pok107 as pok107,
                            ons_equipment2011.pok108 as pok108,
                            ons_equipment2011.pok109 as pok109,
                            ons_equipment2011.pok110 as pok110,
                            ons_equipment2011.pok111 as pok111,
                            ons_equipment2011.pok112 as pok112,
                            ons_equipment2011.step1 as step1,
                            ons_equipment2011.step2 as step2,
                            ons_equipment2011.step3 as step3
                            from ons_equipment2011, report, est where
                            ons_equipment2011.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                $pokaz = Ons_equipment2011::model()->attributeLabels();
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
                $pExcel = new PHPExcel();
                $pExcel->setActiveSheetIndex(0);
                $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                $pExcel->getDefaultStyle()->getFont()->setSize(10); 
                $aSheet = $pExcel->getActiveSheet();
                $aSheet->setTitle('Оснащенность ННШ '.date("Y"));
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
                $center = array(
                    'alignment'=>array(
                        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    ),                    
                );
                $diap = 'A2:DO2';
                $aSheet->getDefaultStyle($diap)->applyFromArray($center);
                $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);                
                $aSheet->getStyle($diap)->getFont()->setBold(true);
                $aSheet->getRowDimension('2')->setRowHeight(200);
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
                header('Content-Disposition: attachment;filename="osn2015.xls"');
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

