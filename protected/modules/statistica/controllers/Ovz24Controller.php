<?php

class Ovz24Controller extends Controller
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
        
	public function actionIndex($id_rep_type)
        {
            $id_rep_type = (int) $_GET['id_rep_type'];
            $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
            $otchet = $command->queryRow();  
            if(!sizeof($otchet)) $this->redirect(Yii::app()->user->returnUrl);
            $this->render('index', array('otchet'=> $otchet, 'id_rep_type'=>$id_rep_type));
        }
        
        public function actionExcel($id_rep_type) {
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
                            ovz24.pok1 as pok1,
                            ovz24.pok2 as pok2,
                            ovz24.pok3 as pok3,
                            ovz24.pok4 as pok4,
                            ovz24.pok5 as pok5,
                            ovz24.pok6 as pok6,
                            ovz24.pok7 as pok7,
                            ovz24.pok8 as pok8,
                            ovz24.pok9 as pok9,
                            ovz24.pok10 as pok10,
                            ovz24.pok11 as pok11,
                            ovz24.pok12 as pok12,
                            ovz24.pok13 as pok13,
                            ovz24.pok14 as pok14,
                            ovz24.pok15 as pok15,
                            ovz24.pok16 as pok16,
                            ovz24.pok17 as pok17,
                            ovz24.pok18 as pok18,
                            ovz24.pok19 as pok19,
                            ovz24.pok20 as pok20,
                            ovz24.pok21 as pok21,
                            ovz24.pok22 as pok22,
                            ovz24.pok23 as pok23,
                            ovz24.pok24 as pok24,
                            ovz24.pok25 as pok25,
                            ovz24.pok26 as pok26,
                            ovz24.pok27 as pok27,
                            ovz24.pok28 as pok28,
                            ovz24.pok29 as pok29,
                            ovz24.pok30 as pok30,
                            ovz24.pok31 as pok31,
                            ovz24.pok32 as pok32,
                            ovz24.pok33 as pok33,
                            ovz24.pok34 as pok34,
                            ovz24.pok35 as pok35,
                            ovz24.pok36 as pok36,
                            ovz24.pok37 as pok37,
                            ovz24.pok38 as pok38,
                            ovz24.pok39 as pok39,
                            ovz24.pok40 as pok40,
                            ovz24.pok41 as pok41,
                            ovz24.pok42 as pok42,
                            ovz24.pok43 as pok43,
                            DATE_FORMAT(ovz24.p_date, "%d.%m.%Y") AS p_date                            
                            from ovz24, report, est where
                            ovz24.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            ovz24.pok1 as pok1,
                            ovz24.pok2 as pok2,
                            ovz24.pok3 as pok3,
                            ovz24.pok4 as pok4,
                            ovz24.pok5 as pok5,
                            ovz24.pok6 as pok6,
                            ovz24.pok7 as pok7,
                            ovz24.pok8 as pok8,
                            ovz24.pok9 as pok9,
                            ovz24.pok10 as pok10,
                            ovz24.pok11 as pok11,
                            ovz24.pok12 as pok12,
                            ovz24.pok13 as pok13,
                            ovz24.pok14 as pok14,
                            ovz24.pok15 as pok15,
                            ovz24.pok16 as pok16,
                            ovz24.pok17 as pok17,
                            ovz24.pok18 as pok18,
                            ovz24.pok19 as pok19,
                            ovz24.pok20 as pok20,
                            ovz24.pok21 as pok21,
                            ovz24.pok22 as pok22,
                            ovz24.pok23 as pok23,
                            ovz24.pok24 as pok24,
                            ovz24.pok25 as pok25,
                            ovz24.pok26 as pok26,
                            ovz24.pok27 as pok27,
                            ovz24.pok28 as pok28,
                            ovz24.pok29 as pok29,
                            ovz24.pok30 as pok30,
                            ovz24.pok31 as pok31,
                            ovz24.pok32 as pok32,
                            ovz24.pok33 as pok33,
                            ovz24.pok34 as pok34,
                            ovz24.pok35 as pok35,
                            ovz24.pok36 as pok36,
                            ovz24.pok37 as pok37,
                            ovz24.pok38 as pok38,
                            ovz24.pok39 as pok39,
                            ovz24.pok40 as pok40,
                            ovz24.pok41 as pok41,
                            ovz24.pok42 as pok42,
                            ovz24.pok43 as pok43,
                            ovz24.p_date as p_date
                            from ovz24, report, est where
                            ovz24.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();                    
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                /*$pok_zam = array('pok1', 'pok2', 'pok3', 'pok4', 'pok5', 'pok21', 'pok22', 'pok23', 'pok24', 'pok25', 'pok26', 'pok27', 'pok28', 'pok29', 'pok30', 'pok31', 'pok32', 'pok33', 'pok34', 'pok35', 'pok36', 'pok37', 'pok38', 'pok39', 'pok40', 'pok41', 'pok42', 'pok43', 'pok44', 'pok45', 'pok46', 'pok47', 'pok48');
                foreach($data as $i => $dt) {
                    foreach($pok_zam as $zam) {
                        if($dt[$zam]) $data[$i][$zam] = $dt[$zam] - 1;                                     
                    }
                }*/
                //print_r($data);
                $pokaz = Ovz24::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация');
                $pokaz = $dabavka + $pokaz;
                //$pokaz = array('Округ', 'Район', 'Учреждение', 'Наименование мероприятия', 'Планируемое число участников, чел. (заполняется до 27 декабря 2019 года)', 'Фактическое число участников, чел. (заполняется до 9 января 2020 года)', 'Дата проведения мероприятия', 'Время проведения мероприятия', 'Название организации/структурного подразделения, в котором будет проходить мероприятие', 'Адрес места проведения (в формате населенный пункт, улица, дом)');
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
                $aSheet->setTitle('ОВЗ');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(40);           
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {                
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $left = array(
                    'alignment'=>array(
                        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    ),                    
                );                
                $aSheet->getStyle('A2:AU2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:AU2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:AU2')->applyFromArray($left);
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
                header('Content-Disposition: attachment;filename="ovz24.xls"');
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

