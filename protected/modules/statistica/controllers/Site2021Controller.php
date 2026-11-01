<?php

class Site2021Controller extends Controller
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
                'accessControl + index, excel, excel2016, excel2016spo'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }
        
        public function actionIndex() {
             echo 1;
        }        

        public function actionExcel($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2021.site2 as site2,
                        site2021.pok1 as pok1,
                        site2021.pok2 as pok2,
                        site2021.pok3 as pok3,
                        site2021.pok4 as pok4,
                        site2021.pok5 as pok5,
                        site2021.pok6 as pok6,
                        site2021.pok7 as pok7,
                        site2021.pok8 as pok8,
                        site2021.pok9 as pok9,
                        site2021.pok10 as pok10,
                        site2021.pok11 as pok11,
                        site2021.pok12 as pok12,
                        site2021.pok13 as pok13,
                        site2021.pok14 as pok14,
                        site2021.pok15 as pok15,
                        site2021.pok16 as pok16,
                        site2021.pok17 as pok17,
                        site2021.pok18 as pok18,
                        site2021.pok19 as pok19,
                        site2021.pok20 as pok20,
                        site2021.pok21 as pok21,
                        site2021.pok22 as pok22,
                        site2021.pok23 as pok23,
                        site2021.pok24 as pok24,
                        site2021.pok25 as pok25,
                        site2021.pok26 as pok26,
                        site2021.pok27 as pok27,
                        site2021.pok28 as pok28,
                        site2021.pok29 as pok29,
                        site2021.pok30 as pok30,
                        site2021.pok31 as pok31,
                        site2021.pok32 as pok32,
                        site2021.pok33 as pok33,
                        site2021.pok34 as pok34,
                        site2021.pok35 as pok35,
                        site2021.pok36 as pok36,
                        site2021.pok37 as pok37,
                        site2021.pok38 as pok38,
                        site2021.pok39 as pok39,
                        site2021.pok40 as pok40,
                        site2021.pok41 as pok41,
                        site2021.pok42 as pok42,
                        site2021.pok43 as pok43,
                        site2021.pok44 as pok44,
                        site2021.pok45 as pok45,
                        site2021.pok46 as pok46,
                        site2021.pok47 as pok47,
                        site2021.pok48 as pok48,
                        site2021.pok49 as pok49,
                        site2021.pok50 as pok50,
                        site2021.pok51 as pok51,
                        site2021.pok52 as pok52,
                        site2021.pok53 as pok53,
                        site2021.pok54 as pok54,
                        site2021.pok55 as pok55,
                        site2021.pok56 as pok56,
                        site2021.pok57 as pok57,
                        site2021.pok58 as pok58,
                        site2021.pok59 as pok59,
                        site2021.pok60 as pok60,
                        site2021.pok61 as pok61,
                        site2021.pok62 as pok62,
                        site2021.pok63 as pok63,
                        site2021.pok64 as pok64,
                        site2021.pok65 as pok65,
                        site2021.pok66 as pok66,
                        site2021.pok67 as pok67,
                        site2021.pok68 as pok68,
                        site2021.pok69 as pok69,
                        site2021.pok70 as pok70,
                        site2021.pok71 as pok71,
                        site2021.pok72 as pok72,
                        site2021.pok73 as pok73,
                        site2021.pok74 as pok74,
                        site2021.pok75 as pok75,
                        site2021.pok76 as pok76,
                        site2021.pok77 as pok77,
                        site2021.pok78 as pok78,
                        site2021.pok79 as pok79,
                        site2021.pok80 as pok80,
                        site2021.pok81 as pok81,
                        site2021.pok82 as pok82,
                        site2021.pok83 as pok83,
                        site2021.pok84 as pok84,
                        site2021.pok85 as pok85,
                        site2021.pok86 as pok86,
                        site2021.pok87 as pok87,
                        site2021.pok88 as pok88,
                        site2021.pok89 as pok89,
                        site2021.pok90 as pok90,
                        site2021.pok91 as pok91,
                        site2021.pok92 as pok92,
                        site2021.pok93 as pok93,                        
                        DATE_FORMAT(site2021.p_date, "%d.%m.%Y") AS p_date,
                        site2021.red as red,
                        site2021.remark as remark
                        from site2021, report, est where
                        site2021.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2021::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                //print_r($data);
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
                $aSheet->setTitle('Проверка сайтов 2021');
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
                $aSheet->getStyle('A2:CV2')->getFont()->setBold(true);
                $aSheet->getRowDimension('2')->setRowHeight(100);
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
                header('Content-Disposition: attachment;filename="site2021.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }
        
        public function actionExcel_spo($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2021_spo.site2 as site2,
                        site2021_spo.pok1 as pok1,
                        site2021_spo.pok2 as pok2,
                        site2021_spo.pok3 as pok3,
                        site2021_spo.pok4 as pok4,
                        site2021_spo.pok5 as pok5,
                        site2021_spo.pok6 as pok6,
                        site2021_spo.pok7 as pok7,
                        site2021_spo.pok8 as pok8,
                        site2021_spo.pok9 as pok9,
                        site2021_spo.pok10 as pok10,
                        site2021_spo.pok11 as pok11,
                        site2021_spo.pok12 as pok12,
                        site2021_spo.pok13 as pok13,
                        site2021_spo.pok14 as pok14,
                        site2021_spo.pok15 as pok15,
                        site2021_spo.pok16 as pok16,
                        site2021_spo.pok17 as pok17,
                        site2021_spo.pok18 as pok18,
                        site2021_spo.pok19 as pok19,
                        site2021_spo.pok20 as pok20,
                        site2021_spo.pok21 as pok21,
                        site2021_spo.pok22 as pok22,
                        site2021_spo.pok23 as pok23,
                        site2021_spo.pok24 as pok24,
                        site2021_spo.pok25 as pok25,
                        site2021_spo.pok26 as pok26,
                        site2021_spo.pok27 as pok27,
                        site2021_spo.pok28 as pok28,
                        site2021_spo.pok29 as pok29,
                        site2021_spo.pok30 as pok30,
                        site2021_spo.pok31 as pok31,
                        site2021_spo.pok32 as pok32,
                        site2021_spo.pok33 as pok33,
                        site2021_spo.pok34 as pok34,
                        site2021_spo.pok35 as pok35,
                        site2021_spo.pok36 as pok36,
                        site2021_spo.pok37 as pok37,
                        site2021_spo.pok38 as pok38,
                        site2021_spo.pok39 as pok39,
                        site2021_spo.pok40 as pok40,
                        site2021_spo.pok41 as pok41,
                        site2021_spo.pok42 as pok42,
                        site2021_spo.pok43 as pok43,
                        site2021_spo.pok44 as pok44,
                        site2021_spo.pok45 as pok45,
                        site2021_spo.pok46 as pok46,
                        site2021_spo.pok47 as pok47,
                        site2021_spo.pok48 as pok48,
                        site2021_spo.pok49 as pok49,
                        site2021_spo.pok50 as pok50,
                        site2021_spo.pok51 as pok51,
                        site2021_spo.pok52 as pok52,
                        site2021_spo.pok53 as pok53,
                        site2021_spo.pok54 as pok54,
                        site2021_spo.pok55 as pok55,
                        site2021_spo.pok56 as pok56,
                        site2021_spo.pok57 as pok57,
                        site2021_spo.pok58 as pok58,
                        site2021_spo.pok59 as pok59,
                        site2021_spo.pok60 as pok60,
                        site2021_spo.pok61 as pok61,
                        site2021_spo.pok62 as pok62,
                        site2021_spo.pok63 as pok63,
                        site2021_spo.pok64 as pok64,
                        site2021_spo.pok65 as pok65,
                        site2021_spo.pok66 as pok66,
                        site2021_spo.pok67 as pok67,
                        site2021_spo.pok68 as pok68,
                        site2021_spo.pok69 as pok69,
                        site2021_spo.pok70 as pok70,
                        site2021_spo.pok71 as pok71,
                        site2021_spo.pok72 as pok72,
                        site2021_spo.pok73 as pok73,
                        site2021_spo.pok74 as pok74,
                        site2021_spo.pok75 as pok75,
                        site2021_spo.pok76 as pok76,
                        site2021_spo.pok77 as pok77,
                        site2021_spo.pok78 as pok78,
                        site2021_spo.pok79 as pok79,
                        site2021_spo.pok80 as pok80,
                        site2021_spo.pok81 as pok81,
                        site2021_spo.pok82 as pok82,
                        site2021_spo.pok83 as pok83,
                        site2021_spo.pok84 as pok84,
                        site2021_spo.pok85 as pok85,
                        site2021_spo.pok86 as pok86,
                        site2021_spo.pok87 as pok87,
                        site2021_spo.pok88 as pok88,
                        site2021_spo.pok89 as pok89,
                        site2021_spo.pok90 as pok90,
                        site2021_spo.pok91 as pok91,
                        site2021_spo.pok92 as pok92,
                        site2021_spo.pok93 as pok93,
                        site2021_spo.pok94 as pok94,
                        site2021_spo.pok95 as pok95,
                        site2021_spo.pok96 as pok96,
                        site2021_spo.pok97 as pok97,
                        site2021_spo.pok98 as pok98,                        
                        DATE_FORMAT(site2021_spo.p_date, "%d.%m.%Y") AS p_date,
                        site2021_spo.red as red,
                        site2021_spo.remark as remark
                        from site2021_spo, report, est where
                        site2021_spo.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2021_spo::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                //print_r($data);
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
                $aSheet->setTitle('Проверка сайтов 2021');
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
                $aSheet->getStyle('A2:DA2')->getFont()->setBold(true);
                $aSheet->getRowDimension('2')->setRowHeight(100);
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
                header('Content-Disposition: attachment;filename="site2021_spo.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }

        public function actionProverka2021($id_rep_type) {
            if(Yii::app()->session['type_adm'] == 4) {
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                if(!is_array($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select report.id_report as id, est_name as name, est.id_raion as raion, est.id_okr as okr, site2021.site2, DATE_FORMAT(site2021.p_date, "%d.%m.%Y %H:%i:%s") AS p_date from report, est, site2021 where report.id_report = site2021.id_report and report.id_est = est.id_est and report.id_rep_type = '.(int)$id_rep_type.' order by est.id_okr, est.id_raion')->queryAll();
                $pokrs = new CArrayDataProvider($reports , array('id'=>'id', 'pagination'=>array('pageSize'=>400)));
                $this->render('proverka2021', array(
                            'pokrs'=>$pokrs,
                            'otchet'=>$otchet,
                        ));                
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');            
        }
        
        public function actionProverka2021_spo($id_rep_type) {
            if(Yii::app()->session['type_adm'] == 4) {
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                if(!is_array($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select report.id_report as id, est_name as name, est.id_raion as raion, est.id_okr as okr, site2021_spo.site2, DATE_FORMAT(site2021_spo.p_date, "%d.%m.%Y %H:%i:%s") AS p_date from report, est, site2021_spo where report.id_report = site2021_spo.id_report and report.id_est = est.id_est and report.id_rep_type = '.(int)$id_rep_type.' order by est.id_okr, est.id_raion')->queryAll();
                $pokrs = new CArrayDataProvider($reports , array('id'=>'id', 'pagination'=>array('pageSize'=>400)));
                $this->render('proverka2021', array(
                            'pokrs'=>$pokrs,
                            'otchet'=>$otchet,
                        ));                
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');            
        }        
}        
?>
