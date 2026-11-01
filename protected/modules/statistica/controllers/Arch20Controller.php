<?php

class Arch20Controller extends Controller
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
                $command = Yii::app()->db->createCommand('select id_contact_gor, naim_gor from contact_gor');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $gor[$value['id_contact_gor']] = $value['naim_gor'];
                }
                $command = Yii::app()->db->createCommand('select id_contact_ul, naim_ul from contact_ul');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $ul[$value['id_contact_ul']] = $value['naim_ul'];
                }

                $pok40 = array('1'=>'Одномаршевая', '2'=>'С промежуточными площадками', '3'=>'Винтовая');
                $pok42 = array('1'=>'Бетонная', '2'=>'Металлическая', '3'=>'Керамогранит');
                $pok44 = array('1'=>'Бетонная', '2'=>'Металлическая', '3'=>'Керамогранит');
                $pok48 = array('1'=>'Одна створка распашная', '2'=>'Две створки распашных', '3'=>'Автоматическая раздвижная', '4'=>'Открывается в обе стороны (качающаяся)', '5'=>'Автоматическая распашная', '6'=>'Вращающаяся (вертушка)');
                $pok50 = array('1'=>'без доводчика', '2'=>'c доводчиком');
                if(Yii::app()->session['type_adm'] == 4) {
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            arch20.pok1 as pok1,
                            arch20.pok2 as pok2,
                            arch20.pok3 as pok3,
                            arch20.pok4 as pok4,
                            arch20.pok5 as pok5,
                            arch20.pok6 as pok6,
                            arch20.pok7 as pok7,
                            arch20.pok8 as pok8,
                            arch20.pok9 as pok9,
                            arch20.pok10 as pok10,
                            arch20.pok11 as pok11,
                            arch20.pok12 as pok12,
                            arch20.pok13 as pok13,
                            arch20.pok14 as pok14,
                            arch20.pok15 as pok15,
                            arch20.pok16 as pok16,
                            arch20.pok17 as pok17,
                            arch20.pok18 as pok18,
                            arch20.pok19 as pok19,
                            arch20.pok20 as pok20,
                            arch20.pok21 as pok21,
                            arch20.pok22 as pok22,
                            arch20.pok23 as pok23,
                            arch20.pok24 as pok24,
                            arch20.pok25 as pok25,
                            arch20.pok26 as pok26,
                            arch20.pok27 as pok27,
                            arch20.pok28 as pok28,
                            arch20.pok29 as pok29,
                            arch20.pok30 as pok30,
                            arch20.pok31 as pok31,
                            arch20.pok32 as pok32,
                            arch20.pok33 as pok33,
                            arch20.pok34 as pok34,
                            arch20.pok35 as pok35,
                            arch20.pok36 as pok36,
                            arch20.pok37 as pok37,
                            arch20.pok38 as pok38,
                            arch20.pok39 as pok39,
                            arch20.pok40 as pok40,
                            arch20.pok41 as pok41,
                            arch20.pok42 as pok42,
                            arch20.pok43 as pok43,
                            arch20.pok44 as pok44,
                            arch20.pok45 as pok45,
                            arch20.pok46 as pok46,
                            arch20.pok47 as pok47,
                            arch20.pok48 as pok48,
                            arch20.pok49 as pok49,
                            arch20.pok50 as pok50,
                            arch20.pok51 as pok51,
                            arch20.pok52 as pok52,
                            arch20.pok53 as pok53,
                            arch20.pok54 as pok54,
                            arch20.pok55 as pok55,
                            arch20.pok56 as pok56,
                            arch20.pok57 as pok57,
                            arch20.pok58 as pok58,
                            arch20.pok59 as pok59,
                            arch20.pok60 as pok60,
                            arch20.pok61 as pok61,
                            arch20.pok62 as pok62,
                            arch20.pok63 as pok63,
                            arch20.pok64 as pok64
                            from arch20, report, est where
                            arch20.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name, arch20.id_zd');
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            arch20.pok1 as pok1,
                            arch20.pok2 as pok2,
                            arch20.pok3 as pok3,
                            arch20.pok4 as pok4,
                            arch20.pok5 as pok5,
                            arch20.pok6 as pok6,
                            arch20.pok7 as pok7,
                            arch20.pok8 as pok8,
                            arch20.pok9 as pok9,
                            arch20.pok10 as pok10,
                            arch20.pok11 as pok11,
                            arch20.pok12 as pok12,
                            arch20.pok13 as pok13,
                            arch20.pok14 as pok14,
                            arch20.pok15 as pok15,
                            arch20.pok16 as pok16,
                            arch20.pok17 as pok17,
                            arch20.pok18 as pok18,
                            arch20.pok19 as pok19,
                            arch20.pok20 as pok20,
                            arch20.pok21 as pok21,
                            arch20.pok22 as pok22,
                            arch20.pok23 as pok23,
                            arch20.pok24 as pok24,
                            arch20.pok25 as pok25,
                            arch20.pok26 as pok26,
                            arch20.pok27 as pok27,
                            arch20.pok28 as pok28,
                            arch20.pok29 as pok29,
                            arch20.pok30 as pok30,
                            arch20.pok31 as pok31,
                            arch20.pok32 as pok32,
                            arch20.pok33 as pok33,
                            arch20.pok34 as pok34,
                            arch20.pok35 as pok35,
                            arch20.pok36 as pok36,
                            arch20.pok37 as pok37,
                            arch20.pok38 as pok38,
                            arch20.pok39 as pok39,
                            arch20.pok40 as pok40,
                            arch20.pok41 as pok41,
                            arch20.pok42 as pok42,
                            arch20.pok43 as pok43,
                            arch20.pok44 as pok44,
                            arch20.pok45 as pok45,
                            arch20.pok46 as pok46,
                            arch20.pok47 as pok47,
                            arch20.pok48 as pok48,
                            arch20.pok49 as pok49,
                            arch20.pok50 as pok50,
                            arch20.pok51 as pok51,
                            arch20.pok52 as pok52,
                            arch20.pok53 as pok53,
                            arch20.pok54 as pok54,
                            arch20.pok55 as pok55,
                            arch20.pok56 as pok56,
                            arch20.pok57 as pok57,
                            arch20.pok58 as pok58,
                            arch20.pok59 as pok59,
                            arch20.pok60 as pok60,
                            arch20.pok61 as pok61,
                            arch20.pok62 as pok62,
                            arch20.pok63 as pok63,
                            arch20.pok64 as pok64
                            from arch20, report, est where
                            arch20.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();                    
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $data[$i]['pok1'] = $gor[$data[$i]['pok1']];
                    $data[$i]['pok3'] = $ul[$data[$i]['pok3']];
                    $data[$i]['pok40'] = $pok40[$data[$i]['pok40']];
                    $data[$i]['pok42'] = $pok42[$data[$i]['pok42']];
                    $data[$i]['pok44'] = $pok44[$data[$i]['pok44']];
                    $data[$i]['pok48'] = $pok48[$data[$i]['pok48']];
                    $data[$i]['pok50'] = $pok50[$data[$i]['pok50']];
                }
                /*$pok_zam = array('pok1', 'pok2', 'pok3', 'pok4', 'pok5', 'pok21', 'pok22', 'pok23', 'pok24', 'pok25', 'pok26', 'pok27', 'pok28', 'pok29', 'pok30', 'pok31', 'pok32', 'pok33', 'pok34', 'pok35', 'pok36', 'pok37', 'pok38', 'pok39', 'pok40', 'pok41', 'pok42', 'pok43', 'pok44', 'pok45', 'pok46', 'pok47', 'pok48');
                foreach($data as $i => $dt) {
                    foreach($pok_zam as $zam) {
                        if($dt[$zam]) $data[$i][$zam] = $dt[$zam] - 1;                                     
                    }
                }*/
                //print_r($data);
                $pokaz = Arch20::model()->attributeLabels_svod();
                //array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
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
                $aSheet->setTitle('Доступность');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(40);
                $aSheet->getColumnDimension('D')->setWidth(10);
                $aSheet->getColumnDimension('E')->setWidth(25);
                $aSheet->getColumnDimension('F')->setWidth(20);
                $aSheet->getColumnDimension('G')->setWidth(25);
                $aSheet->getColumnDimension('I')->setWidth(10);               
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
                $aSheet->getStyle('A2:BO2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:BO2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:BO2')->applyFromArray($left);
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
                header('Content-Disposition: attachment;filename="arch20.xls"');
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