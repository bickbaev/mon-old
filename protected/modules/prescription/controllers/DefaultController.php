<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
        if(!Yii::app()->session['type_adm']) {
            $ul = Yii::app()->db->createCommand('select contact_info.uch_status from contact_info, report where contact_info.id_report = report.id_report and report.id_rep_type = 39 and report.id_est = '.Yii::app()->session['est'])->queryScalar();
            if(!$ul) $this->redirect(Yii::app()->createUrl('prescription/default/cabinet',array('id_est'=>Yii::app()->session['est'])));
            else throw new CHttpException(403,'У Вас нет необходимых прав');
        }    
        elseif (Yii::app()->session['type_adm'] == 4) $this->redirect(Yii::app()->createUrl('prescription/default/cabinet_obl'));
        elseif (Yii::app()->session['type_adm'] == 3) $this->redirect(Yii::app()->createUrl('prescription/default/cabinet_upr',array('id_est'=>Yii::app()->session['est'])));
        else throw new CHttpException(403,'У Вас нет необходимых прав');
    }
    
    public function actionCabinet_obl() {
        if(Yii::app()->session['type_adm'] == 4) {
            $okrs = Yii::app()->db->createCommand('select id_est as id, est_name as name, id_okr from est where type_adm = 2 order by id_okr')->queryAll();
            foreach($okrs as $i=>$okr) {
                $okrs[$i]['okr'] = Yii::app()->db->createCommand('select est_name from est where id_est = '.$okr['id_okr'])->queryScalar();
                $okrs[$i]['ul'] = Yii::app()->db->createCommand('select count(id_est) from pr_est where id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['obj'] = Yii::app()->db->createCommand('select count(building_pr.id_build) from pr_est, building_pr where pr_est.id_est = building_pr.id_est and pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['pred'] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['pm'] = Yii::app()->db->createCommand('select count(pr_mer.id_mer) from pr_mer, pr_pred, pr_est, building_pr where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_mer.srok < NOW() and pr_est.id_raion = '.$okr['id'])->queryScalar();
                for ($k = 1; $k < 9; $k++ ) {
                    $okrs[$i]['t'.$k] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_pred.id_type = '.$k.' and pr_est.id_raion = '.$okr['id'])->queryScalar();
                    $itog['t'.$k] = $itog['t'.$k] + $okrs[$i]['t'.$k];
                }
                $itog['ul'] = $itog['ul'] + $okrs[$i]['ul'];
                $itog['obj'] = $itog['obj'] + $okrs[$i]['obj'];
                $itog['pred'] = $itog['pred'] + $okrs[$i]['pred'];
                $itog['pm'] = $itog['pm'] + $okrs[$i]['pm'];
            }            
            $pokrs = new CArrayDataProvider($okrs , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            $mons = Yii::app()->db->createCommand('select id_rep_type, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date, DATE_FORMAT(s_date, "%d.%m.%Y") as s_date from pr_rep_name')->queryAll();
            $this->render('cabinet_obl', array(
                        'pokrs'=>$pokrs,
                        'itog'=>$itog,
                        'vis_okr'=>true,
                        'mons'=>$mons,
                    ));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');
    }
    
    public function actionCabinet_upr($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $okr_id = Yii::app()->session['est'];
            }
            elseif(Yii::app()->session['type_adm'] == 4) {
                $okr_id = (int)$id_okr;
            }
            $okrs = Yii::app()->db->createCommand('select id_est as id, est_name as name, id_okr from est where type_adm = 2 and id_okr = '.$okr_id)->queryAll();
            foreach($okrs as $i=>$okr) {
                $okrs[$i]['okr'] = Yii::app()->db->createCommand('select est_name from est where id_est = '.$okr['id_okr'])->queryScalar();
                $okrs[$i]['ul'] = Yii::app()->db->createCommand('select count(id_est) from pr_est where id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['obj'] = Yii::app()->db->createCommand('select count(building_pr.id_build) from pr_est, building_pr where pr_est.id_est = building_pr.id_est and pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['pred'] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['pm'] = Yii::app()->db->createCommand('select count(pr_mer.id_mer) from pr_mer, pr_pred, pr_est, building_pr where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_mer.srok < NOW() and pr_est.id_raion = '.$okr['id'])->queryScalar();
                for ($k = 1; $k < 9; $k++ ) {
                    $okrs[$i]['t'.$k] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_pred.id_type = '.$k.' and pr_est.id_raion = '.$okr['id'])->queryScalar();
                    $itog['t'.$k] = $itog['t'.$k] +$okrs[$i]['t'.$k];
                }
                $itog['ul'] = $itog['ul'] + $okrs[$i]['ul'];
                $itog['obj'] = $itog['obj'] + $okrs[$i]['obj'];
                $itog['pred'] = $itog['pred'] + $okrs[$i]['pred'];
                $itog['pm'] = $itog['pm'] + $okrs[$i]['pm'];
            }            
            $pokrs = new CArrayDataProvider($okrs , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            $mons = Yii::app()->db->createCommand('select id_rep_type, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date, DATE_FORMAT(s_date, "%d.%m.%Y") as s_date from pr_rep_name')->queryAll();
            $this->render('cabinet_obl', array(
                        'pokrs'=>$pokrs,
                        'itog'=>$itog,
                        //'id_est'=>Yii::app()->session['est'],
                        'id_est'=>$okr_id,
                        'vis_okr'=>false,
                        'mons'=>$mons,
                    ));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');
    }

    public function actionCabinet_mun($id_mun) {
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $raion = Yii::app()->db->createCommand('select id_est from est where type_adm = 2 and id_okr = '.Yii::app()->session['est'].' and id_est = '.(int)$id_mun)->queryScalar();
                if(!$raion) throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            for($m = 1; $m < 10; $m++) {
                $orgs[$m] = Yii::app()->db->createCommand('select id_est as id, est_name as name from pr_est where id_raion = '.(int)$id_mun.' and id_type = '.$m)->queryAll();
                foreach($orgs[$m] as $i=>$org) {
                    $orgs[$m][$i]['obj'] = Yii::app()->db->createCommand('select count(building_pr.id_build) from pr_est, building_pr where pr_est.id_est = building_pr.id_est and pr_est.id_est = '.$org['id'])->queryScalar();
                    $orgs[$m][$i]['pred'] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_est.id_est = '.$org['id'])->queryScalar();
                    $orgs[$m][$i]['pm'] = Yii::app()->db->createCommand('select count(pr_mer.id_mer) from pr_mer, pr_pred, pr_est, building_pr where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_mer.srok < NOW() and pr_est.id_est = '.$org['id'])->queryScalar();
                    for ($k = 1; $k < 9; $k++ ) {
                        $orgs[$m][$i]['t'.$k] = Yii::app()->db->createCommand('select count(pr_pred.id_pr) from pr_pred, pr_est, building_pr where pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and pr_pred.id_type = '.$k.' and pr_est.id_est = '.$org['id'])->queryScalar();
                        $itog[$m]['t'.$k] = $itog[$m]['t'.$k] + $orgs[$m][$i]['t'.$k];
                    }
                    $itog[$m]['obj'] = $itog[$m]['obj'] + $orgs[$m][$i]['obj'];
                    $itog[$m]['pred'] = $itog[$m]['pred'] + $orgs[$m][$i]['pred'];
                    $itog[$m]['pm'] = $itog[$m]['pm'] + $orgs[$m][$i]['pred'];
                }
                $pokrs[$m] = new CArrayDataProvider($orgs[$m] , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            }
            //print_r($itog);
            $this->render('cabinet_mun', array(
                        'pokrs'=>$pokrs,
                        'itog'=>$itog,
                    ));            
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');        
    }

    public function actionMon_stat($id_rep_type, $id_okr = 0) {
        $mon = Yii::app()->db->createCommand('select id_rep_type, rep_mv, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date, DATE_FORMAT(s_date, "%d.%m.%Y") as s_date, svod from pr_rep_name where id_rep_type = '.(int)$id_rep_type)->queryRow();
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $vis_okr = false;
                $dobavka = ' and id_okr = '.Yii::app()->session['est'];
            }    
            else {
                $vis_okr = true;
                $dobavka = '';
            }    
            $okrs = Yii::app()->db->createCommand('select id_est as id, est_name as name, id_okr from est where type_adm = 2 '.$dobavka.' order by id_okr')->queryAll();
            foreach($okrs as $i=>$okr) {
                $okrs[$i]['okr'] = Yii::app()->db->createCommand('select est_name from est where id_est = '.$okr['id_okr'])->queryScalar();
                $okrs[$i]['nov'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from pr_est, building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and '.$mon['rep_mv'].'.status = 1 and  pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['nobn'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from pr_est, building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and '.$mon['rep_mv'].'.status = 2 and  pr_est.id_raion = '.$okr['id'])->queryScalar();
                $okrs[$i]['zap'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from pr_est, building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and '.$mon['rep_mv'].'.status = 3 and  pr_est.id_raion = '.$okr['id'])->queryScalar();
                $itog['nov'] = $itog['nov'] + $okrs[$i]['nov'];
                $itog['nobn'] = $itog['nobn'] + $okrs[$i]['nobn'];
                $itog['zap'] = $itog['zap'] + $okrs[$i]['zap'];
            }
            $pokrs = new CArrayDataProvider($okrs , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));            
            $this->render('mon_stat', array(
                        'pokrs'=>$pokrs,
                        'itog'=>$itog,
                        'mon'=>$mon,
                        'vis_okr'=>$vis_okr,
                        'id_okr'=>$id_okr,
                    ));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');
    }

    public function actionMon_stat_mun($id_mun, $id_rep_type) {
        $mon = Yii::app()->db->createCommand('select id_rep_type, rep_mv, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date, DATE_FORMAT(s_date, "%d.%m.%Y") as s_date from pr_rep_name where id_rep_type = '.(int)$id_rep_type)->queryRow();
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $raion = Yii::app()->db->createCommand('select id_est from est where type_adm = 2 and id_okr = '.Yii::app()->session['est'].' and id_est = '.(int)$id_mun)->queryScalar();
                if(!$raion) throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            for($m = 1; $m < 10; $m++) {
                $orgs[$m] = Yii::app()->db->createCommand('select id_est as id, est_name as name from pr_est where id_raion = '.(int)$id_mun.' and id_type = '.$m)->queryAll();
                foreach($orgs[$m] as $i=>$org) {
                    $orgs[$m][$i]['obj'] = Yii::app()->db->createCommand('select count(building_pr.id_build) from pr_est, building_pr where pr_est.id_est = building_pr.id_est and pr_est.id_est = '.$org['id'])->queryScalar();
                    $orgs[$m][$i]['nov'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and '.$mon['rep_mv'].'.status = 1 and  building_pr.id_est = '.$org['id'])->queryScalar();
                    $orgs[$m][$i]['nobn'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and '.$mon['rep_mv'].'.status = 2 and  building_pr.id_est = '.$org['id'])->queryScalar();
                    $orgs[$m][$i]['zap'] = Yii::app()->db->createCommand('select count('.$mon['rep_mv'].'.id_report) from building_pr, '.$mon['rep_mv'].' where '.$mon['rep_mv'].'.id_build = building_pr.id_build and '.$mon['rep_mv'].'.status = 3 and  building_pr.id_est = '.$org['id'])->queryScalar();

                    $itog[$m]['nov'] = $itog[$m]['nov'] + $orgs[$m][$i]['nov'];
                    $itog[$m]['nobn'] = $itog[$m]['nobn'] + $orgs[$m][$i]['nobn'];
                    $itog[$m]['zap'] = $itog[$m]['zap'] + $orgs[$m][$i]['zap'];
                }
                $pokrs[$m] = new CArrayDataProvider($orgs[$m] , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            }
            //print_r($orgs);
            $this->render('mon_stat_mun', array(
                        'pokrs'=>$pokrs,
                        'itog'=>$itog,
                        'mon'=>$mon,
                    ));           
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');        
    }

    public function actionExcel_apssps($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            $mon = Yii::app()->db->createCommand('select id_rep_type, rep_mv, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date, DATE_FORMAT(s_date, "%d.%m.%Y") as s_date from pr_rep_name where id_rep_type = 1')->queryRow();
            if($id_okr) $dobavka = 'and pr_est.id_okr = '.(int)$id_okr.' ';
            else $dobavka = '';
            $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, pr_apssps.id_build, pr_apssps.pok1, pr_apssps.pok2, pr_apssps.pok3, pr_apssps.pok4, pr_apssps.pok5, pr_apssps.pok6, pr_apssps.pok7, pr_apssps.pok8, pr_apssps.pok9, pr_apssps.pok10, pr_apssps.pok11, pr_apssps.pok12, pr_apssps.pok13, pr_apssps.pok14, DATE_FORMAT(pr_apssps.pok15, "%d.%m.%Y") as pok15, pr_apssps.pok16, DATE_FORMAT(pr_apssps.pok17, "%d.%m.%Y") as pok17, pr_apssps.pok18, pr_apssps.pok19, pr_apssps.pok20, pr_apssps.pok21, pr_apssps.pok22, pr_apssps.pok23, pr_apssps.pok24, pr_apssps.pok25, pr_apssps.pok26, DATE_FORMAT(pr_apssps.pok27, "%d.%m.%Y") as pok27, DATE_FORMAT(pr_apssps.pok28, "%d.%m.%Y") as pok28, DATE_FORMAT(pr_apssps.pok29, "%d.%m.%Y") as pok29, DATE_FORMAT(pr_apssps.pok30, "%d.%m.%Y") as pok30, pr_apssps.pok31, pr_apssps.pok32, pr_apssps.pok33, pr_apssps.pok34, pr_apssps.pok35, DATE_FORMAT(pr_apssps.pok36, "%d.%m.%Y") as pok36 '
                    . 'from pr_apssps, pr_est, building_pr '
                    . 'where pr_apssps.id_build = building_pr.id_build '
                    . 'and building_pr.id_est = pr_est.id_est '
                    . $dobavka
                    . 'group by pr_est.id_est '
                    . 'order by pr_est.id_okr, pr_est.id_raion')->queryAll();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $type1 = array(1 => 'кабель', 2 => 'GSM', 3 => 'радио');
            $type2 = array(1 => 'муниципальное', 2 => 'государственное');            
            foreach ($itog as $i=>$item) {
                $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
                $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];
                $itog[$i]['id_build'] = $this->addr(Building_pr::model()->findByPk($itog[$i]['id_build']));
                $itog[$i]['pok9'] = $type1[$itog[$i]['pok9']];
                $itog[$i]['pok33'] = $type2[$itog[$i]['pok33']];
                $itog[$i]['pok34'] = $type2[$itog[$i]['pok34']];
            }
            
            $pokaz = Pr_apssps::model()->attributeLabels();
            array_shift($pokaz);
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация', 'id_build'=>'Адрес объекта');
            $pokaz = $dabavka + $pokaz;
            
            $zag = $mon['rep_name'].' ('.$mon['s_date'].'-'.$mon['f_date'].')'.'. Сформирован по состоянию на '.date('d.m.Y H:i');
        
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

            spl_autoload_unregister(array('YiiBase','autoload'));

            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

            $diap = 'A2:AN2';
            $pExcel = new PHPExcel();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle($mon['rep_name']);
            
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),                    
            );

            $left = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );                

            $border = array(
                'borders'=>array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                            '	rgb' => '000000'
                            )
                    ),
                )    
            );                

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(25);
            $aSheet->getColumnDimension('AA')->setWidth(20);
            $aSheet->getColumnDimension('AB')->setWidth(20);
            $aSheet->getColumnDimension('AI')->setWidth(30);
            $aSheet->getColumnDimension('AJ')->setWidth(30);            

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);
            $i = 0;
            foreach ($pokaz as $value) {                
                $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                $aSheet->getStyleByColumnAndRow($i, 2)->applyFromArray($border);
                $i = $i + 1;
            }

            for($i = 0; $i < sizeof($itog); $i++) {
                $k = 0;
                foreach ($itog[$i] as $f=>$value) {

                    $aSheet->getStyleByColumnAndRow($k, $i + 3)->applyFromArray($border);
                    $aSheet->getStyleByColumnAndRow($k, $i + 3)->applyFromArray($left);
                    $aSheet->getStyleByColumnAndRow($k, $i + 3)->getAlignment()->setWrapText(true);
                    $aSheet->getStyleByColumnAndRow($k, $i + 3)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    
                    //$aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 3), $value, PHPExcel_Cell_DataType::TYPE_STRING);

                    if(in_array($k, array(4,5,10,11,13,14,15,26,27,28,29))) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 3), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 3), $value, PHPExcel_Cell_DataType::TYPE_STRING);                        
                    $k = $k + 1;
                }
            }            


            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="apssps.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');          
    }
    
    public function actionExcel_summa($id_okr = NULL) {
        if (Yii::app()->session['type_adm'] > 2) {
            if ($id_okr) $dobavka = 'and pr_est.id_okr = ' . (int)$id_okr . ' ';
            else         $dobavka = '';

            $itog = Yii::app()->db->createCommand(
                'select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, count(pr_pred.id_pr), sum(pr_mer.summa) '
                . 'from pr_mer, pr_pred, pr_est, building_pr '
                . 'where pr_mer.id_pr = pr_pred.id_pr '
                . 'and pr_pred.id_build = building_pr.id_build '
                . 'and building_pr.id_est = pr_est.id_est '
                . 'and pr_pred.compl = 1 '
                . 'and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null) '
                . $dobavka
                . 'group by pr_est.id_est '
                . 'order by pr_est.id_okr, pr_est.id_raion'
            )->queryAll();

            $okr   = array();
            $raion = array();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }

            foreach ($itog as $i => $item) {
                $itog[$i]['id_okr']   = isset($okr[$itog[$i]['id_okr']])     ? $okr[$itog[$i]['id_okr']]     : '';
                $itog[$i]['id_raion'] = isset($raion[$itog[$i]['id_raion']]) ? $raion[$itog[$i]['id_raion']] : '';
            }

            $zag = 'Отчет по потребности в финансировании действующих предписаний. '
                 . 'Сформирован по состоянию на ' . date('d.m.Y H:i');
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Предписания_потребности');

            $diap = 'A3:E3';

            $center = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ),
            );
            $left = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ),
            );
            $border = array(
                'borders' => array(
                    'outline' => array(
                        'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                ),
            );

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(15);
            $aSheet->getColumnDimension('E')->setWidth(15);

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $aSheet->setCellValue('A3', 'Территориальное управление');
            $aSheet->getStyle('A3')->applyFromArray($border);

            $aSheet->setCellValue('B3', 'Муниципалитет');
            $aSheet->getStyle('B3')->applyFromArray($border);

            $aSheet->setCellValue('C3', 'Организация');
            $aSheet->getStyle('C3')->applyFromArray($border);

            $aSheet->setCellValue('D3', 'Количество предписаний');
            $aSheet->getStyle('D3')->applyFromArray($border);

            $aSheet->setCellValue('E3', 'Необходимая сумма, руб.');
            $aSheet->getStyle('E3')->applyFromArray($border);

            for ($i = 0; $i < count($itog); $i++) {
                $k = 0;
                foreach ($itog[$i] as $f => $value) {
                    $coord = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1) . ($i + 4);
                    $aSheet->getStyle($coord)->applyFromArray($border);
                    $aSheet->getStyle($coord)->applyFromArray($left);
                    $aSheet->getStyle($coord)->getAlignment()->setWrapText(true);
                    $aSheet->getStyle($coord)->getNumberFormat()
                           ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

                    if ($k > 2) {
                        $aSheet->setCellValueExplicit($coord, $value,
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    } else {
                        $aSheet->setCellValueExplicit($coord, $value,
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    }
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="summa.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        } else {
            throw new CHttpException(403, 'У Вас нет необходимых прав');
        }
    } 
    
    public function actionExcel_mer($id_okr = NULL) {
        if (Yii::app()->session['type_adm'] > 2) {
            if (Yii::app()->session['type_adm'] == 3) {
                $dobavka = 'and pr_est.id_okr = ' . Yii::app()->session['est'] . ' ';
            } else {
                if ($id_okr) $dobavka = 'and pr_est.id_okr = ' . (int)$id_okr . ' ';
                else         $dobavka = '';
            }

            $itog = Yii::app()->db->createCommand(
                'select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, '
                . 'building_pr.naim as bnaim, building_pr.nas_punkt_type, building_pr.nas_punkt, '
                . 'building_pr.street_type, building_pr.street, building_pr.dom, building_pr.type_o, '
                . 'building_pr.ur1, building_pr.ur2, building_pr.ur3, building_pr.ur4, '
                . 'building_pr.ur5, building_pr.ur6, building_pr.ur7, building_pr.ur8, '
                . 'pr_pred.id_type, pr_pred.organ, pr_pred.doc_type, '
                . 'DATE_FORMAT(pr_pred.doc_date, "%d.%m.%Y") as doc_date, '
                . 'pr_pred.doc_num, pr_pred.isp, pr_pred.isp_naim, '
                . 'pr_mer.step2, pr_mer.id_naim, pr_mer.naim, pr_mer.norm, pr_mer.stat, '
                . 'DATE_FORMAT(pr_mer.srok, "%d.%m.%Y") as srok, '
                . 'pr_mer.summa, pr_mer.id_ist, pr_mer.vsumma, pr_mer.ppf, '
                . 'DATE_FORMAT(pr_mer.psrok, "%d.%m.%Y") as psrok '
                . 'from pr_mer, pr_pred, pr_est, building_pr '
                . 'where pr_mer.id_pr = pr_pred.id_pr '
                . 'and pr_pred.id_build = building_pr.id_build '
                . 'and building_pr.id_est = pr_est.id_est '
                . 'and pr_pred.compl = 1 '
                . 'and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null) '
                . $dobavka
                . 'order by pr_est.id_okr, pr_est.id_raion, building_pr.id_build, pr_pred.id_pr, pr_mer.id_mer'
            )->queryAll();

            $okr      = array();
            $raion    = array();
            $id_type  = array();
            $doc_type = array();
            $id_ist   = array();

            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $rtype = Yii::app()->db->createCommand('select id_type, naim from pr_type')->queryAll();
            foreach ($rtype as $item) {
                $id_type[$item['id_type']] = $item['naim'];
            }
            $rdoctype = Yii::app()->db->createCommand('select id_pr, naim from pr_doc')->queryAll();
            foreach ($rdoctype as $item) {
                $doc_type[$item['id_pr']] = $item['naim'];
            }
            $rid_ist = Yii::app()->db->createCommand('select id_ist, naim from pr_ist')->queryAll();
            foreach ($rid_ist as $item) {
                $id_ist[$item['id_ist']] = $item['naim'];
            }

            $type_o = Building_pr::type_o();

            foreach ($itog as $i => $item) {
                $rnaim      = '';
                $street     = '';
                $nas_punkt  = '';

                $itog[$i]['id_okr']   = isset($okr[$itog[$i]['id_okr']])     ? $okr[$itog[$i]['id_okr']]     : '';
                $itog[$i]['id_raion'] = isset($raion[$itog[$i]['id_raion']]) ? $raion[$itog[$i]['id_raion']] : '';
                $itog[$i]['id_type']  = isset($id_type[$itog[$i]['id_type']]) ? $id_type[$itog[$i]['id_type']] : '';
                $itog[$i]['doc_type'] = isset($doc_type[$itog[$i]['doc_type']]) ? $doc_type[$itog[$i]['doc_type']] : '';

                if ($itog[$i]['step2']) {
                    $vid_model = Pr_step2::model()->findByPk($itog[$i]['step2'])->naim;
                    $rnaim = $vid_model::model()->findByPk($itog[$i]['id_naim'])->naim;
                    if ($itog[$i]['step2'] == 2 && $itog[$i]['id_naim'] == 24) $rnaim = $itog[$i]['naim'];
                } else {
                    $rnaim = $itog[$i]['naim'];
                }
                $itog[$i]['naim']   = $rnaim;
                $itog[$i]['type_o'] = isset($type_o[$itog[$i]['type_o']]) ? $type_o[$itog[$i]['type_o']] : '';
                $itog[$i]['id_ist'] = isset($id_ist[$itog[$i]['id_ist']]) ? $id_ist[$itog[$i]['id_ist']] : '';

                if ($itog[$i]['ppf'] == 0) $itog[$i]['ppf'] = '';
                if ($itog[$i]['psrok'] == '00.00.0000') $itog[$i]['psrok'] = '';

                if ($itog[$i]['street_type']) $street = Contact_ul::model()->findByPk($itog[$i]['street_type'])->naim_ul . ' ' . $itog[$i]['street'] . ', ';
                else                          $street = '';

                if ($itog[$i]['nas_punkt_type']) $nas_punkt = Contact_gor::model()->findByPk($itog[$i]['nas_punkt_type'])->naim_gor . ' ' . $itog[$i]['nas_punkt'] . ', ';
                else                             $nas_punkt = '';

                $itog[$i]['addr'] = $itog[$i]['id_raion'] . ', ' . $nas_punkt . $street . $itog[$i]['dom'];
            }

            $itog_res = array();
            foreach ($itog as $i => $item) {
                $itog_res[$i]['id_okr']   = $item['id_okr'];
                $itog_res[$i]['id_raion'] = $item['id_raion'];
                $itog_res[$i]['est_name'] = $item['est_name'];
                $itog_res[$i]['bnaim']    = $item['bnaim'];
                $itog_res[$i]['addr']     = $item['addr'];
                $itog_res[$i]['type_o']   = $item['type_o'];
                $itog_res[$i]['ur1']      = $item['ur1'];
                $itog_res[$i]['ur2']      = $item['ur2'];
                $itog_res[$i]['ur3']      = $item['ur3'];
                $itog_res[$i]['ur4']      = $item['ur4'];
                $itog_res[$i]['ur5']      = $item['ur5'];
                $itog_res[$i]['ur6']      = $item['ur6'];
                $itog_res[$i]['ur7']      = $item['ur7'];
                $itog_res[$i]['ur8']      = $item['ur8'];
                $itog_res[$i]['id_type']  = $item['id_type'];
                $itog_res[$i]['organ']    = $item['organ'];
                $itog_res[$i]['doc_type'] = $item['doc_type'];
                $itog_res[$i]['doc_date'] = $item['doc_date'];
                $itog_res[$i]['doc_num']  = $item['doc_num'];
                $itog_res[$i]['naim']     = $item['naim'];
                $itog_res[$i]['norm']     = $item['norm'];
                $itog_res[$i]['stat']     = $item['stat'];
                $itog_res[$i]['srok']     = $item['srok'];
                $itog_res[$i]['summa']    = $item['summa'];
                $itog_res[$i]['id_ist']   = $item['id_ist'];
                $itog_res[$i]['vsumma']   = $item['vsumma'];
                $itog_res[$i]['ppf']      = $item['ppf'];
                $itog_res[$i]['psrok']    = $item['psrok'];
            }

            $zag = 'Отчет по мероприятиям действующих предписаний. '
                 . 'Сформирован по состоянию на ' . date('d.m.Y H:i');
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Предписания');

            $diap = 'A3:AB3';

            $center = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ),
            );
            $left = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ),
            );
            $border = array(
                'borders' => array(
                    'outline' => array(
                        'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                ),
            );

            $widths = array(
                'A' => 25, 'B' => 25, 'C' => 50, 'D' => 40, 'E' => 25, 'F' => 15, 'G' => 15,
                'H' => 15, 'I' => 15, 'J' => 15, 'K' => 15, 'L' => 15, 'M' => 15, 'N' => 15,
                'O' => 25, 'P' => 50, 'Q' => 15, 'R' => 15, 'S' => 15, 'T' => 50, 'U' => 35,
                'V' => 20, 'W' => 10, 'X' => 15, 'Y' => 15, 'Z' => 15, 'AA' => 15, 'AB' => 15,
            );
            foreach ($widths as $col => $w) {
                $aSheet->getColumnDimension($col)->setWidth($w);
            }

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $headers = array(
                'A3'  => 'Территориальное управление',
                'B3'  => 'Муниципалитет',
                'C3'  => 'Организация',
                'D3'  => 'Наименование объекта',
                'E3'  => 'Адрес объекта',
                'F3'  => 'На объекте располагается',
                'G3'  => 'дошкольное образование',
                'H3'  => 'начальное общее образование',
                'I3'  => 'основное общее образование',
                'J3'  => 'среднее общее образование',
                'K3'  => 'дополнительное образование детей',
                'L3'  => 'среднее профессиональное образование',
                'M3'  => 'профессиональное обучение',
                'N3'  => 'дополнительное профессиональное образование',
                'O3'  => 'Тип предписания',
                'P3'  => 'Орган, проводивший провеку',
                'Q3'  => 'Тип документа по результатам проверки',
                'R3'  => 'Дата документа по результатам проверки',
                'S3'  => 'Номер документа по результатам проверки',
                'T3'  => 'Наименование мероприятия предписания',
                'U3'  => 'Нормативный правовой документ, положения которого были нарушены',
                'V3'  => 'Пункт/статья нормативного документа',
                'W3'  => 'Срок исполнения мероприятия по предписанию',
                'X3'  => 'Необходимая сумма для устранения нарушения, руб.',
                'Y3'  => 'Источник финансирования',
                'Z3'  => 'Выделяемая сумма, руб.',
                'AA3' => 'По мере поступления финансирования',
                'AB3' => 'Планируемый срок устаранения',
            );
            foreach ($headers as $coord => $text) {
                $aSheet->setCellValue($coord, $text);
                $aSheet->getStyle($coord)->applyFromArray($border);
            }

            for ($i = 0; $i < count($itog_res); $i++) {
                $k = 0;
                foreach ($itog_res[$i] as $f => $value) {
                    $coord = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1) . ($i + 4);
                    $aSheet->getStyle($coord)->applyFromArray($border);
                    $aSheet->getStyle($coord)->applyFromArray($left);
                    $aSheet->getStyle($coord)->getAlignment()->setWrapText(true);
                    $aSheet->getStyle($coord)->getNumberFormat()
                           ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

                    if (($k > 5 && $k < 14) || $k == 23 || $k == 25) {
                        $aSheet->setCellValueExplicit($coord, $value,
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    } else {
                        $aSheet->setCellValueExplicit($coord, $value,
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    }
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="pred.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        } else {
            throw new CHttpException(403, 'У Вас нет необходимых прав');
        }
    }

    public function actionExcel_srok($id_okr = NULL) {
        if (Yii::app()->session['type_adm'] > 2) {
            if ($id_okr) $dobavka = 'and pr_est.id_okr = ' . (int)$id_okr . ' ';
            else         $dobavka = '';

            $itog = Yii::app()->db->createCommand(
                'select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, '
                . 'pr_pred.id_type, pr_pred.organ, pr_pred.doc_type, '
                . 'DATE_FORMAT(pr_pred.doc_date, "%d.%m.%Y") as doc_date, '
                . 'pr_pred.doc_num, pr_mer.step2, pr_mer.id_naim, pr_mer.naim, '
                . 'pr_mer.norm, pr_mer.stat, '
                . 'DATE_FORMAT(pr_mer.srok, "%d.%m.%Y") as srok '
                . 'from pr_mer, pr_pred, pr_est, building_pr '
                . 'where pr_mer.id_pr = pr_pred.id_pr '
                . 'and pr_pred.id_build = building_pr.id_build '
                . 'and building_pr.id_est = pr_est.id_est '
                . 'and pr_pred.compl = 1 '
                . 'and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null) '
                . 'and pr_mer.summa = 0 '
                . 'and (TO_DAYS(NOW()) - TO_DAYS(pr_pred.doc_date) > 31) '
                . $dobavka
                . 'order by pr_est.id_okr, pr_est.id_raion'
            )->queryAll();

            $okr      = array();
            $raion    = array();
            $id_type  = array();
            $doc_type = array();

            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $rtype = Yii::app()->db->createCommand('select id_type, naim from pr_type')->queryAll();
            foreach ($rtype as $item) {
                $id_type[$item['id_type']] = $item['naim'];
            }
            $rdoctype = Yii::app()->db->createCommand('select id_pr, naim from pr_doc')->queryAll();
            foreach ($rdoctype as $item) {
                $doc_type[$item['id_pr']] = $item['naim'];
            }

            foreach ($itog as $i => $item) {
                $rnaim = '';
                $itog[$i]['id_okr']   = isset($okr[$itog[$i]['id_okr']])     ? $okr[$itog[$i]['id_okr']]     : '';
                $itog[$i]['id_raion'] = isset($raion[$itog[$i]['id_raion']]) ? $raion[$itog[$i]['id_raion']] : '';
                $itog[$i]['id_type']  = isset($id_type[$itog[$i]['id_type']]) ? $id_type[$itog[$i]['id_type']] : '';
                $itog[$i]['doc_type'] = isset($doc_type[$itog[$i]['doc_type']]) ? $doc_type[$itog[$i]['doc_type']] : '';

                if ($itog[$i]['step2']) {
                    $vid_model = Pr_step2::model()->findByPk($itog[$i]['step2'])->naim;
                    $rnaim = $vid_model::model()->findByPk($itog[$i]['id_naim'])->naim;
                    if ($itog[$i]['step2'] == 2 && $itog[$i]['id_naim'] == 24) $rnaim = $itog[$i]['naim'];
                } else {
                    $rnaim = $itog[$i]['naim'];
                }
                $itog[$i]['naim'] = $rnaim;
            }

            $itog_res = array();
            foreach ($itog as $i => $item) {
                $itog_res[$i]['id_okr']   = $item['id_okr'];
                $itog_res[$i]['id_raion'] = $item['id_raion'];
                $itog_res[$i]['est_name'] = $item['est_name'];
                $itog_res[$i]['id_type']  = $item['id_type'];
                $itog_res[$i]['organ']    = $item['organ'];
                $itog_res[$i]['doc_type'] = $item['doc_type'];
                $itog_res[$i]['doc_date'] = $item['doc_date'];
                $itog_res[$i]['doc_num']  = $item['doc_num'];
                $itog_res[$i]['naim']     = $item['naim'];
                $itog_res[$i]['norm']     = $item['norm'];
                $itog_res[$i]['stat']     = $item['stat'];
                $itog_res[$i]['srok']     = $item['srok'];
            }

            $zag = 'Отчет по мероприятиям, по которым не введена необходимая сумма. '
                 . 'Сформирован по состоянию на ' . date('d.m.Y H:i');
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Без суммы');

            $diap = 'A3:L3';

            $center = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ),
            );
            $left = array(
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ),
            );
            $border = array(
                'borders' => array(
                    'outline' => array(
                        'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('rgb' => '000000'),
                    ),
                ),
            );

            $widths = array(
                'A' => 25, 'B' => 25, 'C' => 50, 'D' => 15, 'E' => 15, 'F' => 15,
                'G' => 15, 'H' => 25, 'I' => 50, 'J' => 20, 'K' => 10, 'L' => 15,
            );
            foreach ($widths as $col => $w) {
                $aSheet->getColumnDimension($col)->setWidth($w);
            }

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $headers = array(
                'A3' => 'Территориальное управление',
                'B3' => 'Муниципалитет',
                'C3' => 'Организация',
                'D3' => 'Тип предписания',
                'E3' => 'Орган, проводивший провеку',
                'F3' => 'Тип документа по результатам проверки',
                'G3' => 'Дата документа по результатам проверки',
                'H3' => 'Номер документа по результатам проверки',
                'I3' => 'Наименование мероприятия',
                'J3' => 'Нормативный правовой документ, положения которого были нарушены',
                'K3' => 'Пункт/статья нормативного документа',
                'L3' => 'Срок исполнения мероприятия по предписанию',
            );
            foreach ($headers as $coord => $text) {
                $aSheet->setCellValue($coord, $text);
                $aSheet->getStyle($coord)->applyFromArray($border);
            }

            for ($i = 0; $i < count($itog_res); $i++) {
                $k = 0;
                foreach ($itog_res[$i] as $f => $value) {
                    $coord = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1) . ($i + 4);
                    $aSheet->getStyle($coord)->applyFromArray($border);
                    $aSheet->getStyle($coord)->applyFromArray($left);
                    $aSheet->getStyle($coord)->getAlignment()->setWrapText(true);
                    $aSheet->getStyle($coord)->getNumberFormat()
                           ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

                    $aSheet->setCellValueExplicit($coord, $value,
                        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="woutsumma.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        } else {
            throw new CHttpException(403, 'У Вас нет необходимых прав');
        }
    }    
    
    public function actionExcel_summa2($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            if($id_okr) $dobavka = 'and pr_est.id_okr = '.(int)$id_okr.' ';
            else $dobavka = '';
            $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, count(pr_pred.id_pr), sum(pr_mer.summa) '
                    . 'from pr_mer, pr_pred, pr_est, building_pr '
                    . 'where pr_mer.id_pr = pr_pred.id_pr '
                    . 'and pr_pred.id_build = building_pr.id_build '
                    . 'and building_pr.id_est = pr_est.id_est '
                    . 'and pr_pred.compl = 1 '
                    . 'and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null)'
                    . $dobavka
                    . 'group by pr_est.id_est '
                    . 'order by pr_est.id_okr, pr_est.id_raion')->queryAll();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            foreach ($itog as $i=>$item) {
                $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
                $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];
            }
            
            /*print_r($itog);
            die();*/
            
            $zag = 'Отчет по потребности в финансировании действующих предписаний. Сформирован по состоянию на '.date('d.m.Y H:i');
        
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

            spl_autoload_unregister(array('YiiBase','autoload'));

            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

            $diap = 'A3:E3';
            $pExcel = new PHPExcel();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Предписания_потребности');
            
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),                    
            );

            $left = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );                

            $border = array(
                'borders'=>array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                            '	rgb' => '000000'
                            )
                    ),
                )    
            );                

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(15);
            $aSheet->getColumnDimension('E')->setWidth(15);            

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $aSheet->setCellValue('A3','Территориальное управление'); 
            $aSheet->getStyle('A3')->applyFromArray($border); 
            
            $aSheet->setCellValue('B3','Муниципалитет'); 
            $aSheet->getStyle('B3')->applyFromArray($border); 
            
            $aSheet->setCellValue('C3','Организация'); 
            $aSheet->getStyle('C3')->applyFromArray($border);

            $aSheet->setCellValue('D3','Количество предписаний'); 
            $aSheet->getStyle('D3')->applyFromArray($border);

            $aSheet->setCellValue('E3','Необходимая сумма, руб.'); 
            $aSheet->getStyle('E3')->applyFromArray($border);

            for($i = 0; $i < sizeof($itog); $i++) {
                $k = 0;
                foreach ($itog[$i] as $f=>$value) {

                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($border);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($left);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getAlignment()->setWrapText(true);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

                    if($k > 2) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);                        
                    $k = $k + 1;
                }
            }            


            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="summa.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');                
    }
    
    public function actionExcel_srok2($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            if($id_okr) $dobavka = 'and pr_est.id_okr = '.(int)$id_okr.' ';
            else $dobavka = '';
            $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, pr_pred.id_type, pr_pred.organ, pr_pred.doc_type, DATE_FORMAT(pr_pred.doc_date, "%d.%m.%Y") as doc_date, pr_pred.doc_num, pr_mer.step2, pr_mer.id_naim, pr_mer.naim, pr_mer.norm, pr_mer.stat, DATE_FORMAT(pr_mer.srok, "%d.%m.%Y") as srok from pr_mer, pr_pred, pr_est, building_pr where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null) and pr_mer.summa = 0 and (TO_DAYS(NOW()) - TO_DAYS(pr_pred.doc_date) > 31) '.$dobavka.' order by pr_est.id_okr, pr_est.id_raion')->queryAll();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $rtype = Yii::app()->db->createCommand('select id_type, naim from pr_type')->queryAll();
            foreach($rtype as $item) {
                $id_type[$item['id_type']] = $item['naim'];
            }
            $rdoctype = Yii::app()->db->createCommand('select id_pr, naim from pr_doc')->queryAll();
            foreach($rdoctype as $item) {
                $doc_type[$item['id_pr']] = $item['naim'];
            }            
            foreach ($itog as $i=>$item) {
                $rnaim = '';
                $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
                $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];
                $itog[$i]['id_type'] = $id_type[$itog[$i]['id_type']];
                $itog[$i]['doc_type'] = $doc_type[$itog[$i]['doc_type']];
                if($itog[$i]['step2']) {
                    $vid_model = Pr_step2::model()->findByPk($itog[$i]['step2'])->naim;
                    $rnaim = $vid_model::model()->findByPk($itog[$i]['id_naim'])->naim;
                    if($itog[$i]['step2'] == 2 && $itog[$i]['id_naim'] == 24) $rnaim = $itog[$i]['naim'];
                }
                else $rnaim = $itog[$i]['naim'];
                $itog[$i]['naim'] = $rnaim;
            }
            
            foreach ($itog as $i=>$item) {
                $itog_res[$i]['id_okr'] = $item['id_okr'];
                $itog_res[$i]['id_raion'] = $item['id_raion'];
                $itog_res[$i]['est_name'] = $item['est_name'];
                $itog_res[$i]['id_type'] = $item['id_type'];
                $itog_res[$i]['organ'] = $item['organ'];
                $itog_res[$i]['doc_type'] = $item['doc_type'];
                $itog_res[$i]['doc_date'] = $item['doc_date'];
                $itog_res[$i]['doc_num'] = $item['doc_num'];
                $itog_res[$i]['naim'] = $item['naim'];
                $itog_res[$i]['norm'] = $item['norm'];
                $itog_res[$i]['stat'] = $item['stat'];
                $itog_res[$i]['srok'] = $item['srok'];                
            }
            
            /*print_r($itog);
            die();*/
            
            $zag = 'Отчет по мероприятиям, по которым не введена необходимая сумма. Сформирован по состоянию на '.date('d.m.Y H:i');
        
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

            spl_autoload_unregister(array('YiiBase','autoload'));

            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

            $diap = 'A3:L3';
            $pExcel = new PHPExcel();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Без суммы');
            
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),                    
            );

            $left = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );                

            $border = array(
                'borders'=>array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                            '	rgb' => '000000'
                            )
                    ),
                )    
            );                

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(15);
            $aSheet->getColumnDimension('E')->setWidth(15);
            $aSheet->getColumnDimension('F')->setWidth(15);
            $aSheet->getColumnDimension('G')->setWidth(15);
            $aSheet->getColumnDimension('H')->setWidth(25);
            $aSheet->getColumnDimension('I')->setWidth(50);
            $aSheet->getColumnDimension('J')->setWidth(20);
            $aSheet->getColumnDimension('K')->setWidth(10);
            $aSheet->getColumnDimension('L')->setWidth(15);            

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $aSheet->setCellValue('A3','Территориальное управление'); 
            $aSheet->getStyle('A3')->applyFromArray($border); 
            
            $aSheet->setCellValue('B3','Муниципалитет'); 
            $aSheet->getStyle('B3')->applyFromArray($border); 
            
            $aSheet->setCellValue('C3','Организация'); 
            $aSheet->getStyle('C3')->applyFromArray($border);

            $aSheet->setCellValue('D3','Тип предписания'); 
            $aSheet->getStyle('D3')->applyFromArray($border);

            $aSheet->setCellValue('E3','Орган, проводивший провеку'); 
            $aSheet->getStyle('E3')->applyFromArray($border);
            
            $aSheet->setCellValue('F3','Тип документа по результатам проверки'); 
            $aSheet->getStyle('F3')->applyFromArray($border);

            $aSheet->setCellValue('G3','Дата документа по результатам проверки'); 
            $aSheet->getStyle('G3')->applyFromArray($border);

            $aSheet->setCellValue('H3','Номер документа по результатам проверки'); 
            $aSheet->getStyle('H3')->applyFromArray($border);

            $aSheet->setCellValue('I3','Наименование мероприятия'); 
            $aSheet->getStyle('I3')->applyFromArray($border);
            
            $aSheet->setCellValue('J3','Нормативный правовой документ, положения которого были нарушены'); 
            $aSheet->getStyle('J3')->applyFromArray($border);

            $aSheet->setCellValue('K3','Пункт/статья нормативного документа'); 
            $aSheet->getStyle('K3')->applyFromArray($border);

            $aSheet->setCellValue('L3','Срок исполнения мероприятия по предписанию'); 
            $aSheet->getStyle('L3')->applyFromArray($border);            

            for($i = 0; $i < sizeof($itog_res); $i++) {
                $k = 0;
                foreach ($itog_res[$i] as $f=>$value) {
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($border);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($left);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getAlignment()->setWrapText(true);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

                    $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                    $k = $k + 1;
                }
            }            


            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="woutsumma.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');                
    }

    public function actionExcel_dvoe() {
        $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name from pr_est where id_est in (SELECT building_pr.id_est FROM building_pr LEFT OUTER JOIN pr_pred ON building_pr.id_build = pr_pred.id_build WHERE pr_pred.id_pr IS null group by building_pr.id_est) order by id_okr, id_raion')->queryAll();
        $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
        foreach($rokr as $item) {
            $okr[$item['id_est']] = $item['est_name'];
        }
        $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
        foreach($rraions as $item) {
            $raion[$item['id_est']] = $item['est_name'];
        }
        foreach ($itog as $i=>$item) {
            $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
            $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];

            echo $itog[$i]['id_okr'].';'.$itog[$i]['id_raion'].';'.$itog[$i]['est_name'].'<br>';

        }

    }

    public function actionExcel_mer2($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $dobavka = 'and pr_est.id_okr = '.Yii::app()->session['est'].' ';
            }
            else {
                if($id_okr) $dobavka = 'and pr_est.id_okr = '.(int)$id_okr.' ';
                else $dobavka = '';                
            }
            $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, building_pr.naim as bnaim, building_pr.nas_punkt_type, building_pr.nas_punkt, building_pr.street_type, building_pr.street, building_pr.dom, building_pr.type_o, building_pr.ur1, building_pr.ur2, building_pr.ur3, building_pr.ur4, building_pr.ur5, building_pr.ur6, building_pr.ur7, building_pr.ur8, pr_pred.id_type, pr_pred.organ, pr_pred.doc_type, DATE_FORMAT(pr_pred.doc_date, "%d.%m.%Y") as doc_date, pr_pred.doc_num, pr_pred.isp, pr_pred.isp_naim, pr_mer.step2, pr_mer.id_naim, pr_mer.naim, pr_mer.norm, pr_mer.stat, DATE_FORMAT(pr_mer.srok, "%d.%m.%Y") as srok, pr_mer.summa, pr_mer.summa, pr_mer.id_ist, pr_mer.vsumma, pr_mer.ppf, DATE_FORMAT(pr_mer.psrok, "%d.%m.%Y") as psrok
from pr_mer, pr_pred, pr_est, building_pr where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est and pr_pred.compl = 1 and (pr_mer.fsrok = "0000-00-00" or pr_mer.fsrok is null) '.$dobavka.' order by pr_est.id_okr, pr_est.id_raion, building_pr.id_build, pr_pred.id_pr, pr_mer.id_mer')->queryAll();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $rtype = Yii::app()->db->createCommand('select id_type, naim from pr_type')->queryAll();
            foreach($rtype as $item) {
                $id_type[$item['id_type']] = $item['naim'];
            }
            $rdoctype = Yii::app()->db->createCommand('select id_pr, naim from pr_doc')->queryAll();
            foreach($rdoctype as $item) {
                $doc_type[$item['id_pr']] = $item['naim'];
            }
            $rid_ist = Yii::app()->db->createCommand('select id_ist, naim from pr_ist')->queryAll();
            foreach($rid_ist as $item) {
                $id_ist[$item['id_ist']] = $item['naim'];
            }            
            $type_o = Building_pr::type_o();
            foreach ($itog as $i=>$item) {
                $rnaim = '';
                $street = '';
                $nas_punkt = '';
                $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
                $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];
                $itog[$i]['id_type'] = $id_type[$itog[$i]['id_type']];
                $itog[$i]['doc_type'] = $doc_type[$itog[$i]['doc_type']];
                if($itog[$i]['step2']) {
                    $vid_model = Pr_step2::model()->findByPk($itog[$i]['step2'])->naim;
                    $rnaim = $vid_model::model()->findByPk($itog[$i]['id_naim'])->naim;
                    if($itog[$i]['step2'] == 2 && $itog[$i]['id_naim'] == 24) $rnaim = $itog[$i]['naim'];
                }
                else $rnaim = $itog[$i]['naim'];
                $itog[$i]['naim'] = $rnaim;
                $itog[$i]['type_o'] = $type_o[$itog[$i]['type_o']];
                $itog[$i]['id_ist'] = $id_ist[$itog[$i]['id_ist']];
                if($itog[$i]['ppf'] == 0) $itog[$i]['ppf'] = '';
                if($itog[$i]['psrok'] == '00.00.0000') $itog[$i]['psrok'] = '';
                
                if($itog[$i]['street_type']) $street = Contact_ul::model()->findByPk($itog[$i]['street_type'])->naim_ul.' '.$itog[$i]['street'].', ';
                else $street = '';
                if($itog[$i]['nas_punkt_type']) $nas_punkt = Contact_gor::model()->findByPk($itog[$i]['nas_punkt_type'])->naim_gor.' '.$itog[$i]['nas_punkt'].', ';
                else $nas_punkt = '';
                $itog[$i]['addr'] = $itog[$i]['id_raion'].', '.$nas_punkt.$street.$itog[$i]['dom'];                
                
            }
            
            /*print_r($itog);
            die();*/
            
            foreach ($itog as $i=>$item) {
                $itog_res[$i]['id_okr'] = $item['id_okr'];
                $itog_res[$i]['id_raion'] = $item['id_raion'];
                $itog_res[$i]['est_name'] = $item['est_name'];
                $itog_res[$i]['bnaim'] = $item['bnaim'];
                $itog_res[$i]['addr'] = $item['addr'];
                $itog_res[$i]['type_o'] = $item['type_o'];
                $itog_res[$i]['ur1'] = $item['ur1'];
                $itog_res[$i]['ur2'] = $item['ur2'];
                $itog_res[$i]['ur3'] = $item['ur3'];
                $itog_res[$i]['ur4'] = $item['ur4'];
                $itog_res[$i]['ur5'] = $item['ur5'];
                $itog_res[$i]['ur6'] = $item['ur6'];
                $itog_res[$i]['ur7'] = $item['ur7'];
                $itog_res[$i]['ur8'] = $item['ur8'];
                $itog_res[$i]['id_type'] = $item['id_type'];
                $itog_res[$i]['organ'] = $item['organ'];
                $itog_res[$i]['doc_type'] = $item['doc_type'];
                $itog_res[$i]['doc_date'] = $item['doc_date'];
                $itog_res[$i]['doc_num'] = $item['doc_num'];
                $itog_res[$i]['naim'] = $item['naim'];
                $itog_res[$i]['norm'] = $item['norm'];
                $itog_res[$i]['stat'] = $item['stat'];
                $itog_res[$i]['srok'] = $item['srok'];
                $itog_res[$i]['summa'] = $item['summa'];
                $itog_res[$i]['id_ist'] = $item['id_ist'];
                $itog_res[$i]['vsumma'] = $item['vsumma'];
                $itog_res[$i]['ppf'] = $item['ppf'];
                $itog_res[$i]['psrok'] = $item['psrok'];
            }
            
            //print_r($itog_res);
            /*$this->render('excel_mer', array(
                    'itog_res'=>$itog_res,
            ));*/  
            
            
            $zag = 'Отчет по мероприятиям действующих предписаний. Сформирован по состоянию на '.date('d.m.Y H:i');
        
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

            spl_autoload_unregister(array('YiiBase','autoload'));

            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

            $diap = 'A3:AB3';
            $pExcel = new PHPExcel();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Предписания');
            
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),                    
            );

            $left = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );                

            $border = array(
                'borders'=>array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                            '	rgb' => '000000'
                            )
                    ),
                )    
            );                

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(40);
            $aSheet->getColumnDimension('E')->setWidth(25);
            $aSheet->getColumnDimension('F')->setWidth(15);
            $aSheet->getColumnDimension('G')->setWidth(15);
            $aSheet->getColumnDimension('H')->setWidth(15);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(15);
            $aSheet->getColumnDimension('L')->setWidth(15);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(15);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(50);
            $aSheet->getColumnDimension('Q')->setWidth(15);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(15);
            $aSheet->getColumnDimension('T')->setWidth(50);
            $aSheet->getColumnDimension('U')->setWidth(35);
            $aSheet->getColumnDimension('V')->setWidth(20);
            $aSheet->getColumnDimension('W')->setWidth(10);
            $aSheet->getColumnDimension('X')->setWidth(15);
            $aSheet->getColumnDimension('Y')->setWidth(15);
            $aSheet->getColumnDimension('Z')->setWidth(15);
            $aSheet->getColumnDimension('AA')->setWidth(15);
            $aSheet->getColumnDimension('AB')->setWidth(15);

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $aSheet->setCellValue('A3','Территориальное управление'); 
            $aSheet->getStyle('A3')->applyFromArray($border); 
            
            $aSheet->setCellValue('B3','Муниципалитет'); 
            $aSheet->getStyle('B3')->applyFromArray($border); 
            
            $aSheet->setCellValue('C3','Организация'); 
            $aSheet->getStyle('C3')->applyFromArray($border);
            
            $aSheet->setCellValue('D3','Наименование объекта'); 
            $aSheet->getStyle('D3')->applyFromArray($border);            

            $aSheet->setCellValue('E3','Адрес объекта'); 
            $aSheet->getStyle('E3')->applyFromArray($border);

            $aSheet->setCellValue('F3','На объекте располагается'); 
            $aSheet->getStyle('F3')->applyFromArray($border);
            
            $aSheet->setCellValue('G3','дошкольное образование'); 
            $aSheet->getStyle('G3')->applyFromArray($border);

            $aSheet->setCellValue('H3','начальное общее образование'); 
            $aSheet->getStyle('H3')->applyFromArray($border);

            $aSheet->setCellValue('I3','основное общее образование'); 
            $aSheet->getStyle('I3')->applyFromArray($border);

            $aSheet->setCellValue('J3','среднее общее образование'); 
            $aSheet->getStyle('J3')->applyFromArray($border);
            
            $aSheet->setCellValue('K3','дополнительное образование детей'); 
            $aSheet->getStyle('K3')->applyFromArray($border);

            $aSheet->setCellValue('L3','среднее профессиональное образование'); 
            $aSheet->getStyle('L3')->applyFromArray($border);

            $aSheet->setCellValue('M3','профессиональное обучение'); 
            $aSheet->getStyle('M3')->applyFromArray($border);

            $aSheet->setCellValue('N3','дополнительное профессиональное образование'); 
            $aSheet->getStyle('N3')->applyFromArray($border);

            $aSheet->setCellValue('O3','Тип предписания'); 
            $aSheet->getStyle('O3')->applyFromArray($border);
            
            $aSheet->setCellValue('P3','Орган, проводивший провеку'); 
            $aSheet->getStyle('P3')->applyFromArray($border); 

            $aSheet->setCellValue('Q3','Тип документа по результатам проверки'); 
            $aSheet->getStyle('Q3')->applyFromArray($border); 

            $aSheet->setCellValue('R3','Дата документа по результатам проверки'); 
            $aSheet->getStyle('R3')->applyFromArray($border);
            
            $aSheet->setCellValue('S3','Номер документа по результатам проверки'); 
            $aSheet->getStyle('S3')->applyFromArray($border);

            $aSheet->setCellValue('T3','Наименование мероприятия предписания'); 
            $aSheet->getStyle('T3')->applyFromArray($border);
            
            $aSheet->setCellValue('U3','Нормативный правовой документ, положения которого были нарушены'); 
            $aSheet->getStyle('U3')->applyFromArray($border);

            $aSheet->setCellValue('V3','Пункт/статья нормативного документа'); 
            $aSheet->getStyle('V3')->applyFromArray($border); 

            $aSheet->setCellValue('W3','Срок исполнения мероприятия по предписанию'); 
            $aSheet->getStyle('W3')->applyFromArray($border);

            $aSheet->setCellValue('X3','Необходимая сумма для устранения нарушения, руб.'); 
            $aSheet->getStyle('X3')->applyFromArray($border);

            $aSheet->setCellValue('Y3','Источник финансирования'); 
            $aSheet->getStyle('Y3')->applyFromArray($border);

            $aSheet->setCellValue('Z3','Выделяемая сумма, руб.'); 
            $aSheet->getStyle('Z3')->applyFromArray($border); 

            $aSheet->setCellValue('AA3','По мере поступления финансирования'); 
            $aSheet->getStyle('AA3')->applyFromArray($border);

            $aSheet->setCellValue('AB3','Планируемый срок устаранения'); 
            $aSheet->getStyle('AB3')->applyFromArray($border);             

            for($i = 0; $i < sizeof($itog_res); $i++) {
                $k = 0;
                foreach ($itog_res[$i] as $f=>$value) {
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($border);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($left);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getAlignment()->setWrapText(true);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    
                    if(($k > 5 && $k < 14) || $k == 23 || $k == 25) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);

                    //$aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                    $k = $k + 1;
                }
            }            


            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="pred.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');                
    }

    public function actionExcel_mer_all($id_okr = NULL) {
        if(Yii::app()->session['type_adm'] > 2) {
            if(Yii::app()->session['type_adm'] == 3) {
                $dobavka = 'and pr_est.id_okr = '.Yii::app()->session['est'].' ';
            }
            else {
                if($id_okr) $dobavka = 'and pr_est.id_okr = '.(int)$id_okr.' ';
                else $dobavka = '';                
            }
            $itog = Yii::app()->db->createCommand('select pr_est.id_okr, pr_est.id_raion, pr_est.est_name, building_pr.naim as bnaim, building_pr.nas_punkt_type, building_pr.nas_punkt, building_pr.street_type, building_pr.street, building_pr.dom, building_pr.type_o, building_pr.ur1, building_pr.ur2, building_pr.ur3, building_pr.ur4, building_pr.ur5, building_pr.ur6, building_pr.ur7, building_pr.ur8, pr_pred.id_type, pr_pred.organ, pr_pred.doc_type, DATE_FORMAT(pr_pred.doc_date, "%d.%m.%Y") as doc_date, pr_pred.doc_num, pr_pred.isp, pr_pred.isp_naim, pr_mer.step2, pr_mer.id_naim, pr_mer.naim, pr_mer.norm, pr_mer.stat, DATE_FORMAT(pr_mer.srok, "%d.%m.%Y") as srok, pr_mer.summa, pr_mer.summa, pr_mer.id_ist, pr_mer.vsumma, pr_mer.ppf, DATE_FORMAT(pr_mer.psrok, "%d.%m.%Y") as psrok, pr_pred.compl as compl, DATE_FORMAT(pr_mer.fsrok, "%d.%m.%Y") as fsrok
from pr_mer, pr_pred, pr_est, building_pr  where pr_mer.id_pr = pr_pred.id_pr and pr_pred.id_build = building_pr.id_build and building_pr.id_est = pr_est.id_est'.$dobavka.' order by pr_est.id_okr, pr_est.id_raion, building_pr.id_build, pr_pred.id_pr, pr_mer.id_mer')->queryAll();
            $rokr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($rokr as $item) {
                $okr[$item['id_est']] = $item['est_name'];
            }
            $rraions = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach($rraions as $item) {
                $raion[$item['id_est']] = $item['est_name'];
            }
            $rtype = Yii::app()->db->createCommand('select id_type, naim from pr_type')->queryAll();
            foreach($rtype as $item) {
                $id_type[$item['id_type']] = $item['naim'];
            }
            $rdoctype = Yii::app()->db->createCommand('select id_pr, naim from pr_doc')->queryAll();
            foreach($rdoctype as $item) {
                $doc_type[$item['id_pr']] = $item['naim'];
            }
            $rid_ist = Yii::app()->db->createCommand('select id_ist, naim from pr_ist')->queryAll();
            foreach($rid_ist as $item) {
                $id_ist[$item['id_ist']] = $item['naim'];
            }            
            $type_o = Building_pr::type_o();
            foreach ($itog as $i=>$item) {
                $rnaim = '';
                $street = '';
                $nas_punkt = '';
                $itog[$i]['id_okr'] = $okr[$itog[$i]['id_okr']];
                $itog[$i]['id_raion'] = $raion[$itog[$i]['id_raion']];
                $itog[$i]['id_type'] = $id_type[$itog[$i]['id_type']];
                $itog[$i]['doc_type'] = $doc_type[$itog[$i]['doc_type']];
                if($itog[$i]['step2']) {
                    $vid_model = Pr_step2::model()->findByPk($itog[$i]['step2'])->naim;
                    $rnaim = $vid_model::model()->findByPk($itog[$i]['id_naim'])->naim;
                    if($itog[$i]['step2'] == 2 && $itog[$i]['id_naim'] == 24) $rnaim = $itog[$i]['naim'];
                }
                else $rnaim = $itog[$i]['naim'];
                $itog[$i]['naim'] = $rnaim;
                $itog[$i]['type_o'] = $type_o[$itog[$i]['type_o']];
                $itog[$i]['id_ist'] = $id_ist[$itog[$i]['id_ist']];
                if($itog[$i]['ppf'] == 0) $itog[$i]['ppf'] = '';
                if($itog[$i]['psrok'] == '00.00.0000') $itog[$i]['psrok'] = '';
                if($itog[$i]['fsrok'] == '00.00.0000' || $itog[$i]['fsrok'] == '') $itog[$i]['fsrok'] = '';
                if($itog[$i]['street_type']) $street = Contact_ul::model()->findByPk($itog[$i]['street_type'])->naim_ul.' '.$itog[$i]['street'].', ';
                else $street = '';
                if($itog[$i]['nas_punkt_type']) $nas_punkt = Contact_gor::model()->findByPk($itog[$i]['nas_punkt_type'])->naim_gor.' '.$itog[$i]['nas_punkt'].', ';
                else $nas_punkt = '';
                $itog[$i]['addr'] = $itog[$i]['id_raion'].', '.$nas_punkt.$street.$itog[$i]['dom'];                
                if($itog[$i]['compl'] == 2) $itog[$i]['compl'] = 'Выполнено';
                else $itog[$i]['compl'] = 'Не выполнено';                
            }
            
            /*print_r($itog);
            die();*/
            
            foreach ($itog as $i=>$item) {
                $itog_res[$i]['id_okr'] = $item['id_okr'];
                $itog_res[$i]['id_raion'] = $item['id_raion'];
                $itog_res[$i]['est_name'] = $item['est_name'];
                $itog_res[$i]['bnaim'] = $item['bnaim'];
                $itog_res[$i]['addr'] = $item['addr'];
                $itog_res[$i]['type_o'] = $item['type_o'];
                $itog_res[$i]['ur1'] = $item['ur1'];
                $itog_res[$i]['ur2'] = $item['ur2'];
                $itog_res[$i]['ur3'] = $item['ur3'];
                $itog_res[$i]['ur4'] = $item['ur4'];
                $itog_res[$i]['ur5'] = $item['ur5'];
                $itog_res[$i]['ur6'] = $item['ur6'];
                $itog_res[$i]['ur7'] = $item['ur7'];
                $itog_res[$i]['ur8'] = $item['ur8'];
                $itog_res[$i]['id_type'] = $item['id_type'];
                $itog_res[$i]['organ'] = $item['organ'];
                $itog_res[$i]['doc_type'] = $item['doc_type'];
                $itog_res[$i]['doc_date'] = $item['doc_date'];
                $itog_res[$i]['doc_num'] = $item['doc_num'];
                $itog_res[$i]['naim'] = $item['naim'];
                $itog_res[$i]['norm'] = $item['norm'];
                $itog_res[$i]['stat'] = $item['stat'];
                $itog_res[$i]['srok'] = $item['srok'];
                $itog_res[$i]['summa'] = $item['summa'];
                $itog_res[$i]['id_ist'] = $item['id_ist'];
                $itog_res[$i]['vsumma'] = $item['vsumma'];
                $itog_res[$i]['ppf'] = $item['ppf'];
                $itog_res[$i]['psrok'] = $item['psrok'];
                $itog_res[$i]['fsrok'] = $item['fsrok'];
                $itog_res[$i]['compl'] = $item['compl'];
            }
            
            //print_r($itog_res);
            /*$this->render('excel_mer', array(
                    'itog_res'=>$itog_res,
            ));*/  
            
            
            $zag = 'Отчет по мероприятиям предписаний. Сформирован по состоянию на '.date('d.m.Y H:i');
        
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

            spl_autoload_unregister(array('YiiBase','autoload'));

            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

            $diap = 'A3:AB3';
            $pExcel = new PHPExcel();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(11);
            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Предписания');
            
            $center = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),                    
            );

            $left = array(
                'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                ),                    
            );                

            $border = array(
                'borders'=>array(
                    'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                            '	rgb' => '000000'
                            )
                    ),
                )    
            );                

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(50);
            $aSheet->getColumnDimension('D')->setWidth(40);
            $aSheet->getColumnDimension('E')->setWidth(25);
            $aSheet->getColumnDimension('F')->setWidth(15);
            $aSheet->getColumnDimension('G')->setWidth(15);
            $aSheet->getColumnDimension('H')->setWidth(15);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(15);
            $aSheet->getColumnDimension('L')->setWidth(15);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(15);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(50);
            $aSheet->getColumnDimension('Q')->setWidth(15);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(15);
            $aSheet->getColumnDimension('T')->setWidth(50);
            $aSheet->getColumnDimension('U')->setWidth(35);
            $aSheet->getColumnDimension('V')->setWidth(20);
            $aSheet->getColumnDimension('W')->setWidth(10);
            $aSheet->getColumnDimension('X')->setWidth(15);
            $aSheet->getColumnDimension('Y')->setWidth(15);
            $aSheet->getColumnDimension('Z')->setWidth(15);
            $aSheet->getColumnDimension('AA')->setWidth(15);
            $aSheet->getColumnDimension('AB')->setWidth(15);

            $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
            $aSheet->getStyle($diap)->getFont()->setBold(true);
            $aSheet->getRowDimension(2)->setRowHeight(-1);

            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $aSheet->setCellValue('A3','Территориальное управление'); 
            $aSheet->getStyle('A3')->applyFromArray($border); 
            
            $aSheet->setCellValue('B3','Муниципалитет'); 
            $aSheet->getStyle('B3')->applyFromArray($border); 
            
            $aSheet->setCellValue('C3','Организация'); 
            $aSheet->getStyle('C3')->applyFromArray($border);
            
            $aSheet->setCellValue('D3','Наименование объекта'); 
            $aSheet->getStyle('D3')->applyFromArray($border);            

            $aSheet->setCellValue('E3','Адрес объекта'); 
            $aSheet->getStyle('E3')->applyFromArray($border);

            $aSheet->setCellValue('F3','На объекте располагается'); 
            $aSheet->getStyle('F3')->applyFromArray($border);
            
            $aSheet->setCellValue('G3','дошкольное образование'); 
            $aSheet->getStyle('G3')->applyFromArray($border);

            $aSheet->setCellValue('H3','начальное общее образование'); 
            $aSheet->getStyle('H3')->applyFromArray($border);

            $aSheet->setCellValue('I3','основное общее образование'); 
            $aSheet->getStyle('I3')->applyFromArray($border);

            $aSheet->setCellValue('J3','среднее общее образование'); 
            $aSheet->getStyle('J3')->applyFromArray($border);
            
            $aSheet->setCellValue('K3','дополнительное образование детей'); 
            $aSheet->getStyle('K3')->applyFromArray($border);

            $aSheet->setCellValue('L3','среднее профессиональное образование'); 
            $aSheet->getStyle('L3')->applyFromArray($border);

            $aSheet->setCellValue('M3','профессиональное обучение'); 
            $aSheet->getStyle('M3')->applyFromArray($border);

            $aSheet->setCellValue('N3','дополнительное профессиональное образование'); 
            $aSheet->getStyle('N3')->applyFromArray($border);

            $aSheet->setCellValue('O3','Тип предписания'); 
            $aSheet->getStyle('O3')->applyFromArray($border);
            
            $aSheet->setCellValue('P3','Орган, проводивший провеку'); 
            $aSheet->getStyle('P3')->applyFromArray($border); 

            $aSheet->setCellValue('Q3','Тип документа по результатам проверки'); 
            $aSheet->getStyle('Q3')->applyFromArray($border); 

            $aSheet->setCellValue('R3','Дата документа по результатам проверки'); 
            $aSheet->getStyle('R3')->applyFromArray($border);
            
            $aSheet->setCellValue('S3','Номер документа по результатам проверки'); 
            $aSheet->getStyle('S3')->applyFromArray($border);

            $aSheet->setCellValue('T3','Наименование мероприятия предписания'); 
            $aSheet->getStyle('T3')->applyFromArray($border);
            
            $aSheet->setCellValue('U3','Нормативный правовой документ, положения которого были нарушены'); 
            $aSheet->getStyle('U3')->applyFromArray($border);

            $aSheet->setCellValue('V3','Пункт/статья нормативного документа'); 
            $aSheet->getStyle('V3')->applyFromArray($border); 

            $aSheet->setCellValue('W3','Срок исполнения мероприятия по предписанию'); 
            $aSheet->getStyle('W3')->applyFromArray($border);

            $aSheet->setCellValue('X3','Необходимая сумма для устранения нарушения, руб.'); 
            $aSheet->getStyle('X3')->applyFromArray($border);

            $aSheet->setCellValue('Y3','Источник финансирования'); 
            $aSheet->getStyle('Y3')->applyFromArray($border);

            $aSheet->setCellValue('Z3','Выделяемая сумма, руб.'); 
            $aSheet->getStyle('Z3')->applyFromArray($border); 

            $aSheet->setCellValue('AA3','По мере поступления финансирования'); 
            $aSheet->getStyle('AA3')->applyFromArray($border);

            $aSheet->setCellValue('AB3','Планируемый срок устаранения'); 
            $aSheet->getStyle('AB3')->applyFromArray($border);
            
            $aSheet->setCellValue('AC3','Дата выполнения мероприятия'); 
            $aSheet->getStyle('AC3')->applyFromArray($border);
            
            $aSheet->setCellValue('AD3','Выполенение предписания'); 
            $aSheet->getStyle('AD3')->applyFromArray($border);             

            for($i = 0; $i < sizeof($itog_res); $i++) {
                $k = 0;
                foreach ($itog_res[$i] as $f=>$value) {
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($border);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->applyFromArray($left);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getAlignment()->setWrapText(true);
                    $aSheet->getStyleByColumnAndRow($k, $i + 4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    
                    if(($k > 5 && $k < 14) || $k == 23 || $k == 25) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);

                    //$aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 4), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                    $k = $k + 1;
                }
            }            


            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="pred_all.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');                
    }    
    
    public function actionCabinet($id_est) {
        if($this->check_prava($id_est)) {
            $objs = new CActiveDataProvider('Building_pr', array(
                'criteria'=>array(
                    'condition' => 'id_est ='.$id_est,
                    'order' => 'id_build ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
            ));            
            $this->render('cabinet', array(
                        'id_est' => $id_est,
                        'objs' => $objs,
                    ));
        }
    }    
    
    public function actionObject_add($id_est) {
        if($this->check_prava($id_est)) {                  
            
            $model = new Building_pr;

            $model->id_est = $id_est;
            
            $blk = $this->blk($id_est);

            if(isset($_POST['Building_pr']))
            {
                $model->attributes=$_POST['Building_pr'];
                if($model->save()) {
                    $mons = Yii::app()->db->createCommand('select rep_mv from pr_rep_name where cur = 1')->queryColumn();
                    foreach($mons as $mon) {
                        Yii::app()->db->createCommand('insert into '.$mon.' set id_build = '.$model->id_build)->execute();
                    }
                    $this->redirect(array('cabinet','id_est'=>$model->id_est));
                }    
            }

            $this->render('object_add',array(
                'model'=>$model,
                'blk'=>$blk,
            ));
        }        
    }
    
    public function actionObject_delete($id_build)
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadObj($id_build);
            if($this->check_prava($model->id_est)) {
                if($model->pr_count()) {
                    new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
                else {
                    $mons = Yii::app()->db->createCommand('select rep_mv from pr_rep_name where cur = 1')->queryColumn();
                    foreach($mons as $mon) {
                        Yii::app()->db->createCommand('delete from '.$mon.' where id_build = '.$model->id_build)->execute();
                    }                    
                    $model->delete();
                }    
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            /*if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
            $this->redirect(Yii::app()->createUrl('prescription/default/cabinet',array('id_est'=>$model->id_est)));
        }
        else throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
    public function actionObject_update($id_build)
    {
        $status = array(1 => 'не заполнен', 2 => 'не обновлен', 3 => 'заполнен');
        $model = $this->loadObj($id_build);
        if($this->check_prava($model->id_est)) {
            $pred = new CActiveDataProvider('Pr_pred', array(
                'criteria'=>array(
                    'condition' => 'compl = 1 and id_build ='.$id_build,
                    'order' => 'id_pr ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
            ));
            $itog_mon = array();
            $mons = Yii::app()->db->createCommand('select id_rep_type, rep_mv, rep_name, DATE_FORMAT(f_date, "%d.%m.%Y") as f_date from pr_rep_name where archive is null')->queryAll();
            $i = 1;
            foreach($mons as $mon) {
                $res = Yii::app()->db->createCommand('select id_report, status from '.$mon['rep_mv'].' where id_build = '.$id_build)->queryRow();
                if(is_array($res)) {
                    $itog_mon[$i]['id'] = $i;
                    $itog_mon[$i]['rep_name'] = $mon['rep_name'];
                    $itog_mon[$i]['f_date'] = $mon['f_date'];
                    $itog_mon[$i]['id_rep_type'] = $mon['id_rep_type'];
                    $itog_mon[$i]['status'] = $status[$res['status']];
                    $itog_mon[$i]['id_report'] = $res['id_report'];
                    $i = $i + 1;
                }
            }
            $monitor = new CArrayDataProvider($itog_mon , array('id'=>'id', 'pagination'=>array('pageSize'=>200)));
            
            $vpr = Yii::app()->db->createCommand('select count(id_pr) from pr_pred where compl = 2 and id_build = '.$id_build)->queryScalar();
            $this->render('object_update',array(
                'model' => $model,
                'pred' => $pred,
                'vpr' => $vpr,
                'monitor'=>$monitor,
            ));            
        }
    }
    
    public function actionObject_vpr($id_build)
    {
        $model = $this->loadObj($id_build);
        if($this->check_prava($model->id_est)) {
            $pred = new CActiveDataProvider('Pr_pred', array(
                'criteria'=>array(
                    'condition' => 'compl = 2 and id_build ='.$id_build,
                    'order' => 'id_pr ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
            ));
            $this->render('object_vpr',array(
                'model' => $model,
                'pred' => $pred,
            ));            
        }
    }    
    
    public function actionObject_edit($id_build)
    {
        $model = $this->loadObj($id_build);
        
        if($this->check_prava($model->id_est)) {
        
            $blk = $this->blk($model->id_est);

            if(isset($_POST['Building_pr']))
            {
                $model->attributes = $_POST['Building_pr'];
                if($model->save()) {
                    $this->redirect(array('object_update','id_build' => $model->id_build));
                }    
            }

            $this->render('object_edit',array(
                'model'=>$model,
                'blk'=>$blk,
            ));
        }
    }
    
    public function actionMon_edit($id_rep_type, $id_report) {
        $mon = $this->loadMon($id_rep_type);
        $report = $this->loadReport($mon, $id_report);     
        if($this->check_prava($this->loadObj($report->id_build)->id_est)) {        
            $mv_p = ucfirst($mon->rep_mv);
            if (isset($_POST[$mv_p])) {
                $report->attributes = $_POST[$mv_p];
                $report->status = 3;
                if($report->save()) {
                    $this->redirect(array('object_update','id_build' => $report->id_build));
                }
            }
            $this->render($mon->rep_mv, array('model' => $report, 'mon'=>$mon));
        }
        else throw new CHttpException(403,'У Вас нет необходимых прав');
    }

    protected function loadMon($id_rep_type)
    {
        $model = Pr_rep_name::model()->findByPk((int)$id_rep_type);
        if($model === null) throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    protected function loadReport($mon, $id_report)
    {
        $mon_name = ucfirst($mon->rep_mv);
        $model = $mon_name::model()->findByPk((int)$id_report);
        if($model === null) throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }     
    
    public function actionPred_add($id_build) {
        if($this->check_prava($this->loadObj($id_build)->id_est)) {                 
            
            $model = new Pr_pred;

            $model->id_build = $id_build;
            $model->crt = date('Y-m-d H:i:s');
            $model->compl = 1;                       

            if(isset($_POST['Pr_pred']))
            {
                $model->attributes=$_POST['Pr_pred'];
                if($model->save()) {                         
                    $this->redirect(array('pred_update','id_pr' => $model->id_pr));
                }    
            }

            $this->render('pred_add', array(
                'model'=>$model,
            ));
        }        
    }
    
    public function actionPred_update($id_pr) {
        $model = $this->loadPred($id_pr);
        if($this->check_prava($model->building->id_est)) {
            $mer = new CActiveDataProvider('Pr_mer', array(
                'criteria'=>array(
                    'condition' => 'id_pr = '.$id_pr,
                    'order' => 'id_mer ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
            ));             
            $this->render('pred_update', array(
                'model' => $model,
                'mer' => $mer,
            ));            
        }
    }

    public function actionPred_edit($id_pr)
    {
        $model = $this->loadPred($id_pr);
        if($this->check_prava($model->building->id_est)) {        

            if(isset($_POST['Pr_pred']))
            {
                $model->attributes = $_POST['Pr_pred'];
                if($model->save()) {
                    $this->redirect(array('pred_update','id_pr' => $model->id_pr));
                }    
            }

            $this->render('pred_edit',array(
                'model'=>$model,
            ));
        }
    }

    
    public function actionPred_delete($id_pr)
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadPred($id_pr);
            if($this->check_prava($model->building->id_est)) {
                if($model->mer_count()) {
                    new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }                
                // we only allow deletion via POST request
                else $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        }
        else throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }    

    public function actionPreddown($id_pr) {
        $model = $this->loadPred($id_pr);
        if($this->check_prava($model->building->id_est)) {
            $file = $model::FILE_PATH.'/'.date('Y', strtotime($model->crt)).'/'.$model->id_build.'/'.$model->pred;
            if(file_exists($file)) { 
                Yii::app()->request->sendFile($model->pred_r, file_get_contents($file));
            }
            else throw new CHttpException(404,'Файл не найден.');            
        }         
    }
    
    public function actionPoddown($id_mer) {
        $model = $this->loadMer($id_mer);
        if($this->check_prava($model->pr_pred->building->id_est)) {
            $file = $model::FILE_PATH.'/'.date('Y', strtotime($model->crt)).'/'.$model->pr_pred->building->id_build.'/'.$model->pod;
            if(file_exists($file)) { 
                Yii::app()->request->sendFile($model->pod_r, file_get_contents($file));
            }
            else throw new CHttpException(404,'Файл не найден.');            
        }         
    }    
    
    public function actionMer_add($id_pr) {
        $model_pr = $this->loadPred($id_pr);
        if($this->check_prava($model_pr->building->id_est)) {
            $step2 = Pr_type::model()->findByPk($model_pr->id_type)->step2;
            if(!$step2) $this->redirect(array('mer_step2', 'id_pr' => $id_pr));
            else {
                $vid_model = Pr_step2::model()->findByPk($step2)->naim;            
                $model = new Step2Form ();
                $model->setScenario(lcfirst($vid_model));           
                $vid = CHtml::listData($vid_model::model()->findAll(array('order' => 'id_pr ASC')), 'id_pr', 'naim');
                if(isset($_POST['Step2Form'])) {
                    $model->attributes=$_POST['Step2Form'];
                    if($model->validate()) {
                        $this->redirect(array('mer_step2', 'id_pr' => $id_pr, 'step2' => $step2, 'id_naim' => $model->id_pr));
                    }
                }              
                $this->render('step2', array(
                    'model'=> $model,
                    'vid' => $vid,
                    'id_pr' => $id_pr,
                ));
            }             
        }        
    }
    
    public function actionMer_step2($id_pr, $step2 = NULL, $id_naim = NULL, $id_mer = NULL) {
        if($this->check_prava($this->loadPred($id_pr)->building->id_est)) {
            
            if($id_mer) {
                $model = $this->loadMer($id_mer);
                $type = 2;
            }    
            else {
                $model = new Pr_mer;
                $model->id_pr = $id_pr;
                $model->crt = date('Y-m-d H:i:s');
                $type = 1;
            }
            
            if($step2) {
                $vid_model = Pr_step2::model()->findByPk((int)$step2)->naim;
                if(!$vid_model) throw new CHttpException(404,'The requested page does not exist.');
                $model->step2 = $step2;
                $naim_model = $vid_model::model()->findByPk((int)$id_naim);
                if($naim_model === null) throw new CHttpException(404,'The requested page does not exist.');
                $model->id_naim = $id_naim;
            }

            if(isset($_POST['Pr_mer']))
            {
                $model->attributes = $_POST['Pr_mer'];
                if($model->save()) {
                    $model->pr_pred->check_status();
                    $this->redirect(array('pred_update','id_pr' => $model->id_pr));
                }   
            }

            $this->render('mer_add', array(
                'model' => $model,
                'type' => $type,
            ));
        }        
    }

    public function actionMer_update($id_mer) {
        $model = $this->loadMer($id_mer);
        if($this->check_prava($model->pr_pred->building->id_est)) {            
            $step2 = Pr_type::model()->findByPk($model->pr_pred->id_type)->step2;
            if(!$step2) $this->redirect(array('mer_step2', 'id_pr' => $model->id_pr, 'id_mer' => $id_mer));
            else {
                $vid_model = Pr_step2::model()->findByPk($model->step2)->naim;            
                $model_f = new Step2Form ();
                $model_f->setScenario(lcfirst($vid_model));
                $model_f->id_pr = $model->id_naim;
                $vid = CHtml::listData($vid_model::model()->findAll(array('order' => 'id_pr ASC')), 'id_pr', 'naim');
                if(isset($_POST['Step2Form'])) {
                    $model_f->attributes=$_POST['Step2Form'];
                    if($model_f->validate()) {
                        $this->redirect(array('mer_step2', 'id_pr' => $model->id_pr, 'step2' => $step2, 'id_naim' => $model_f->id_pr, 'id_mer'=> $model->id_mer));
                    }
                }              
                $this->render('step2', array(
                    'model'=> $model_f,
                    'vid' => $vid,
                    'id_pr' => $model->id_pr,
                ));
            }           
        }
    }
    
    public function actionMer_delete($id_mer)
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadMer($id_mer);
            $model_pr = $model->pr_pred;
            if($this->check_prava($model_pr->building->id_est)) { 
                // we only allow deletion via POST request
                $model->delete();
                $model_pr->check_status();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        }
        else throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }    

    protected function loadMer($id_mer)
    {
        $model = Pr_mer::model()->findByPk((int)$id_mer);
        if($model === null) throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }    

    protected function loadObj($id_build)
    {
        $model = Building_pr::model()->findByPk((int)$id_build);
        if($model === null) throw new CHttpException(404,'The requested page does not exist.');
        $this->check_prava($model->id_est);
        return $model;
    }
    
    protected function loadPred($id_pr)
    {
        $model = Pr_pred::model()->findByPk((int)$id_pr);
        if($model === null) throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    public function get_type($id_type) {
        $types =  array(
            1 => "Дошкольные образовательные организации",
            2 => "Общеобразовательные организации",
            3 => "Организации дополнительного образования детей",
            4 => "Организации начального профессионального образования",
            5 => "Организации среднего профессионального образования",
            6 => "Специальные (коррекционные) образовательные организации",
            7 => "Организации высшего професcионального образования",
            8 => "Организации для детей, нуждающихся в психолого-педагогической и медико-социальной помощи",
            9 => "Иные организации",            
        );
        return $types[(int)$id_type];
    }    

    public function naim_mer($data) {
        if($data->step2) {
            $vid_model = Pr_step2::model()->findByPk($data->step2)->naim;
            if($vid_model === null) throw new CHttpException(404,'The requested page does not exist.');
            $naim = $vid_model::model()->findByPk($data->id_naim)->naim;
            if($data->step2 == 2 && $data->id_naim == 24) $naim = $data->naim;
        }
        else $naim = $data->naim;
        return $naim;
    }  
 
    public function blk($id_est) {
        $id_mun = Est::model()->findByPk((int)$id_est)->id_raion;            
        if($id_mun < 25) $blk = true;
        else $blk = false;        
        return $blk;        
    }
    
    public function pred_doc($data) {
        $doc_type = Pr_doc::model()->findByPk($data->doc_type)->naim;
        $doc_date = date('d.m.Y', strtotime($data->doc_date));
        return $doc_type.' №'.$data->doc_num.' от '.$doc_date;
    }

    public function pred_mer($data) {
        $mer = Yii::app()->db->createCommand('select count(id_mer) from pr_mer where id_pr = '.$data->id_pr)->queryScalar();
        $nmer = Yii::app()->db->createCommand('select count(id_mer) from pr_mer where (fsrok = "0000-00-00" or fsrok is null) and id_pr = '.$data->id_pr)->queryScalar();
        return 'Всего: '.$mer.' /Не выполн.: '.$nmer;
    }

    public function obj_pred($data) {
        $pred = Yii::app()->db->createCommand('select count(id_pr) from pr_pred where compl = 1 and id_build = '.$data->id_build)->queryScalar();
        return $pred;
    }    
    
    public function addr($data) {
        if($data->street_type) $street = Contact_ul::model()->findByPk($data->street_type)->naim_ul.' '.$data->street.', ';
        else $street = '';
        if($data->nas_punkt_type) $nas_punkt = Contact_gor::model()->findByPk($data->nas_punkt_type)->naim_gor.' '.$data->nas_punkt.', ';
        else $nas_punkt = '';
        $id_mun = Est::model()->findByPk($data->id_est)->id_raion;
        $mun = Est::model()->findByPk($id_mun)->est_name;
        return $mun.', '.$nas_punkt.$street.$data->dom;
    }

    public function mer_fin($data) {
        if($data->id_ist) $id_ist = Pr_ist::model()->findByPk($data->id_ist)->naim.'<br>';
        else $id_ist = '';
        if($data->vsumma > 0) $vsumma = 'Сумма: '.$data->vsumma.'<br>';
        else $vsumma = '';
        if($data->ppf) $srok = 'по мере поступления фин.';
        elseif($data->psrok) $srok = 'Срок: '.$data->psrok;
        else $srok = '';
        return $id_ist.$vsumma.$srok;
    }    
    
    protected function check_prava($id_est)
    {
        if(!Yii::app()->session['type_adm']) {
            if($id_est != Yii::app()->session['est']) throw new CHttpException(403,'У Вас нет необходимых прав');
            $ul = Yii::app()->db->createCommand('select contact_info.uch_status from contact_info, report where contact_info.id_report = report.id_report and report.id_rep_type = 39 and report.id_est = '.(int)$id_est)->queryScalar();
            if($ul) throw new CHttpException(403,'У Вас нет необходимых прав');
            return true;
        }
        elseif(Yii::app()->session['type_adm'] == 3) {
            if(in_array((int)$id_est, Yii::app()->session['pid'])) return true;
            else return false;            
        }
        elseif(Yii::app()->session['type_adm'] == 4) {
            return true;
        }        
        else return false;                
    }
    
    public function actionPr_update($id_build, $id_pr = NULL) {
        $model_o = $this->loadObj($id_build);
        if($this->check_prava($model_o->id_est)) {
            $model = new Step1Form ();
            if(!$id_pr) {                
                $nazv = 'Создание';
            }
            else {
                $pred = $this->loadPred($id_pr);
                $model->id_type = $pred->id_type;
                $nazv = 'Редактирование';
            }
            if(isset($_POST['Step1Form'])) {
                $model->attributes=$_POST['Step1Form'];
                if($model->validate()) {
                    $step2 = Pr_type::model()->findByPk($model->id_type)->step2;
                    if(!$step2) $this->redirect(array('step3', 'id_build' => $id_build, 'id_pr' => $id_pr, 'id_type' => $model->id_type));
                    else {
                        $this->redirect(array('step2', 'id_build' => $id_build, 'id_pr' => $id_pr, 'id_type' => $model->id_type, 'step2' => $step2));
                    }    
                }
            }    
            $this->render('step1', array(
                'model'=> $model,
                'nazv' => $nazv,
                'id_build' => $id_build,
            ));                
        }
    }

    public function actionStep2($id_build, $id_pr = NULL, $id_type, $step2) {
        $model_o = $this->loadObj($id_build);
        if($this->check_prava($model_o->id_est)) {
            $vid_model = Pr_step2::model()->findByPk((int)$step2)->naim;
            if(!$vid_model) throw new CHttpException(404,'The requested page does not exist.');            
            $model = new Step2Form ();
            $model->setScenario(lcfirst($vid_model));           
            $vid = CHtml::listData($vid_model::model()->findAll(array('order' => 'id_pr ASC')), 'id_pr', 'naim');
            if(isset($_POST['Step2Form'])) {
                $model->attributes=$_POST['Step2Form'];
                if($model->validate()) {
                    $this->redirect(array('step3', 'id_build' => $id_build, 'id_pr' => $id_pr, 'id_type' => $id_type, 'vid' => $model->id_pr));
                }
            }              
            $this->render('step2', array(
                'model'=> $model,
                'id_build' => $id_build,
                'vid' => $vid,
            ));            
        }        
    }

    public function actionStep3($id_build, $id_pr = NULL, $id_type, $vid = NULL) {
        $model_o = $this->loadObj($id_build);
        if($this->check_prava($model_o->id_est)) {
            $type = Pr_type::model()->findByPk((int)$id_type);
            if($type === null) throw new CHttpException(404,'The requested page does not exist.');
            if($vid) {
                $vid_model = Pr_step2::model()->findByPk($type->step2)->naim;
                if(!$vid_model) throw new CHttpException(404,'The requested page does not exist.');
                $r_vid = $vid_model::model()->findByPk((int)$vid);
                if($r_vid === null) throw new CHttpException(404,'The requested page does not exist.');
            }
            if(!$id_pr) {                
                $model = new Pr_pred();
                $model->id_build = $id_build;
                $model->id_type = $id_type;
                $model->vid_type = $type->step2;
                $model->id_vid = $r_vid->id_pr;
            }
            if(isset($_POST['Pr_pred']))
            {
                $model->attributes = $_POST['Pr_pred'];
                if($model->save()) {
                    $this->redirect(array('object_update','id_build' => $model->id_build));
                }
            }            
            $this->render('step3', array(
                'model'=> $model,
                'id_build' => $id_build,
            ));            
        }        
    }     
} 

