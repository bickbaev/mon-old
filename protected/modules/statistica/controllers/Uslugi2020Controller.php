<?php

class Uslugi2020Controller extends Controller
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
                if(Yii::app()->session['type_adm'] == 3) {
                    $okr = Yii::app()->db->createCommand('select id_est, est_name from est where id_est = '.Yii::app()->session['est'])->queryAll();
                    //$okr = array();
                }
                elseif(Yii::app()->session['type_adm'] == 4) {
                    $okr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                }
                else {
                    throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'okr'=>$okr));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        } 
        
	public function actionIndex_mun()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();                
                $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                $this->render('index_mun', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'mun'=>$mun));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }  
        
	public function actionIndex_mun2()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();                
                $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                $this->render('index_mun2', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'mun'=>$mun));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

	public function actionIndex_mun2_2()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();                
                $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                $this->render('index_mun2_2', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'mun'=>$mun));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

	public function actionIndex_mun2_3()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();                
                $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                $this->render('index_mun2_3', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'mun'=>$mun));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }        
        
        public function actionExcel($id_rep_type, $id_okr) {
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();                            
                if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'].'. Сформирован по состоянию на '.date('d.m.Y H:i');
                $nazv = 'Ведомственный перечень государственных услуг и работ, оказываемых и выполняемых государственными учреждениями, находящимися в ведении министерства образования и науки Самарской области';
                
                if($id_okr == 0) {
                    if(Yii::app()->session['type_adm'] == 4) {
                        $poks = Yii::app()->db->createCommand('select id_pok from uslugi2017')->queryColumn();
                        foreach($poks as $m=>$pok) {
                            $cols = Yii::app()->db->createCommand('select
                                uslugi2017.id_pok,
                                uslugi2017.pok1,
                                uslugi2017.pok2,
                                uslugi2017.pok3,
                                uslugi2017.pok4,
                                uslugi2017.pok5,
                                uslugi2017.pok6,
                                uslugi2017.pok7,
                                uslugi2017.pok8,
                                uslugi2017.pok9,
                                uslugi2017.pok10,                              
                                sum(usluga20_res.col) as col,
                                sum(usluga20_res.col2) as col2                            
                                from uslugi2017, usluga20_res, report where
                                uslugi2017.id_pok = usluga20_res.id_pok
                                and usluga20_res.id_report = report.id_report
                                and report.id_rep_type = '.$id_rep_type.'
                                and uslugi2017.id_pok ='.$pok)->queryAll();
                                $itog[$m] = $cols[0];
                        }                        
                        
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else {
                    if(Yii::app()->session['type_adm'] == 3) {$id_okr = Yii::app()->session['est'];}
                    elseif(Yii::app()->session['type_adm'] == 4) {$id_okr = (int)$id_okr;}
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                    $poks = Yii::app()->db->createCommand('select uslugi2017.id_pok as id_pok from uslugi2017, usluga20_res, report, est where
                        uslugi2017.id_pok = usluga20_res.id_pok
                        and usluga20_res.id_report = report.id_report
                        and report.id_est = est.id_est
                        and est.id_okr = '.$id_okr.'
                        and report.id_rep_type = '.$id_rep_type.'
                        group by uslugi2017.id_pok
                        order by uslugi2017.id_pok')->queryColumn(); 
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2017.id_pok,
                            uslugi2017.pok1,
                            uslugi2017.pok2,
                            uslugi2017.pok3,
                            uslugi2017.pok4,
                            uslugi2017.pok5,
                            uslugi2017.pok6,
                            uslugi2017.pok7,
                            uslugi2017.pok8,
                            uslugi2017.pok9,
                            uslugi2017.pok10,
                            sum(usluga20_res.col) as col,
                            sum(usluga20_res.col2) as col2                            
                            from uslugi2017, usluga20_res, report, est where
                            uslugi2017.id_pok = usluga20_res.id_pok
                            and usluga20_res.id_report = report.id_report
                            and report.id_est = est.id_est
                            and est.id_okr = '.$id_okr.'
                            and report.id_rep_type = '.$id_rep_type.'
                            and uslugi2017.id_pok ='.$pok)->queryAll();
                            $itog[$m] = $cols[0];
                    }                    
                }
                               
                
                //print_r($itog);
                
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                 // Turn off our amazing library autoload
                spl_autoload_unregister(array('YiiBase','autoload'));
                 //
                 // making use of our reference, include the main class
                 // when we do this, phpExcel has its own autoload registration
                 // procedure (PHPExcel_Autoloader::Register();)
                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                //подключаем и создаем класс PHPExcel
                $diap = 'A4:P3';
                $pExcel = new PHPExcel();
                $pExcel->setActiveSheetIndex(0);
                $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                $pExcel->getDefaultStyle()->getFont()->setSize(11);
                $aSheet = $pExcel->getActiveSheet();
                $aSheet->setTitle('Государственные услуги и работы');
                
                
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
                
                //$aSheet->getDefaultStyle($diap)->applyFromArray($center);
                $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
                $aSheet->getRowDimension(2)->setRowHeight(-1);
                
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                //$aSheet->mergeCells('B2:M2');
                $aSheet->setCellValue('B2',$nazv);
                $aSheet->getStyle('B2')->getFont()->setBold(true);
                                
                //рисуем заголовок таблицы
                $aSheet->getColumnDimension('A')->setWidth(5);
                $aSheet->getColumnDimension('B')->setWidth(20);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->getColumnDimension('D')->setWidth(10);
                $aSheet->getColumnDimension('E')->setWidth(10);
                $aSheet->getColumnDimension('F')->setWidth(12);
                $aSheet->getColumnDimension('G')->setWidth(25);
                $aSheet->getColumnDimension('H')->setWidth(20);
                $aSheet->getColumnDimension('I')->setWidth(15);
                $aSheet->getColumnDimension('J')->setWidth(20);
                $aSheet->getColumnDimension('L')->setWidth(15);
                $aSheet->getColumnDimension('M')->setWidth(20);
                $aSheet->getColumnDimension('N')->setWidth(12);
                
                $aSheet->getRowDimension(4)->setRowHeight(40);
                $aSheet->getRowDimension(5)->setRowHeight(40);                               
                
                $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A4:P4')->getFont()->setBold(true);
                
                $aSheet->mergeCells('A4:A5');
                $aSheet->setCellValue('A4','№ п/п'); 
                $aSheet->getStyle('A4:A5')->applyFromArray($border);
                
                $aSheet->mergeCells('B4:B5');
                $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                
                $aSheet->mergeCells('C4:H4');
                $aSheet->setCellValue('C4','Общая информация'); 
                $aSheet->getStyle('C4:H4')->applyFromArray($border);  
                
                $aSheet->setCellValue('C5','Реестровый номер услуги'); 
                $aSheet->getStyle('C5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('D5','Код услуги'); 
                $aSheet->getStyle('D5')->applyFromArray($border);  
                
                $aSheet->setCellValue('E5','Тип'); 
                $aSheet->getStyle('E5')->applyFromArray($border);  
                
                $aSheet->setCellValue('F5','Платность'); 
                $aSheet->getStyle('F5')->applyFromArray($border);  
                
                $aSheet->setCellValue('G5','Виды учреждений'); 
                $aSheet->getStyle('G5')->applyFromArray($border);  
                
                $aSheet->setCellValue('H5','Категории потребителей'); 
                $aSheet->getStyle('H5')->applyFromArray($border);  
                
                $aSheet->mergeCells('I4:I5');
                $aSheet->setCellValue('I4','Содержание услуги (работы)'); 
                $aSheet->getStyle('I4:I5')->applyFromArray($border);                  
                
                $aSheet->mergeCells('J4:J5');
                $aSheet->setCellValue('J4','Условия оказания услуги (работы)'); 
                $aSheet->getStyle('J4:J5')->applyFromArray($border);
                
                $aSheet->mergeCells('K4:K5');
                $aSheet->setCellValue('K4','Объем услуги'); 
                $aSheet->getStyle('K4:K5')->applyFromArray($border);                
                
                $aSheet->mergeCells('L4:M4');
                $aSheet->setCellValue('L4','Объем услуги (работы)'); 
                $aSheet->getStyle('L4:M4')->applyFromArray($border);  
                
                $aSheet->setCellValue('L5','на 01.01.20'); 
                $aSheet->getStyle('L5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('M5','на 01.09.20'); 
                $aSheet->getStyle('M5')->applyFromArray($border);                
                
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $f=>$value) {
                        //if($f == 'pok14' || $f == 'pok15') continue;
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                        //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        
                        if($k == 11 || $k == 12) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                        
                        /*if($k == 8 || $k == 9) {
                            $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                            if($k == 8) {
                                $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $itog[$i]['pok14'], PHPExcel_Cell_DataType::TYPE_STRING);
                            }
                            else {
                                $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $itog[$i]['pok15'], PHPExcel_Cell_DataType::TYPE_STRING);
                            }
                            $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($left);
                            $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getAlignment()->setWrapText(true);
                            $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        }
                        else {
                            $aSheet->mergeCellsByColumnAndRow($k,$i*2+6,$k,$i*2+7);                        
                            if($k == 14 || $k == 15) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                            else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                            
                            //$aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                        }*/
                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi2020.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));                
        }
        
        
        public function actionConvert(){
            $reports = Yii::app()->db->createCommand('select report.id_est, usluga17_res.id_pok, usluga17_res.col, usluga17_res.col2 from report, usluga17_res where usluga17_res.id_report = report.id_report and report.id_rep_type = 170')->queryAll();
            foreach($reports as $report) {
                $res = Yii::app()->db->createCommand('insert into usluga1820_3 set id_est = '.$report['id_est'].', id_pok = '.$report['id_pok'].', col8 = '.$report['col'].', col82 = '.$report['col2'])->execute();
            }
            echo 'ok';
        }
        
        public function actionConvert2(){
            $reports = Yii::app()->db->createCommand('select report.id_est, usluga19_res.id_pok, usluga19_res.col, usluga19_res.col2 from report, usluga19_res where usluga19_res.id_report = report.id_report and report.id_rep_type = 171')->queryAll();
            foreach($reports as $report) {
                $cusl = 0;
                $cusl = Yii::app()->db->createCommand('select count(id_usluga) from usluga1820_3 where id_est = '.$report['id_est'].' and id_pok = '.$report['id_pok'])->queryScalar();
                if(!$cusl) {
                    $res = Yii::app()->db->createCommand('insert into usluga1820_3 set id_est = '.$report['id_est'].', id_pok = '.$report['id_pok'].', col9 = '.$report['col'].', col92 = '.$report['col2'])->execute();
                }
                else {
                    $res = Yii::app()->db->createCommand('update usluga1820_3 set col9 = '.$report['col'].', col92 = '.$report['col2'].' where id_est = '.$report['id_est'].' and id_pok = '.$report['id_pok'])->execute();
                }
            }
            echo 'ok';
        }

        public function actionConvert3(){
            $reports = Yii::app()->db->createCommand('select report.id_est, usluga20_res.id_pok, usluga20_res.col, usluga20_res.col2 from report, usluga20_res where usluga20_res.id_report = report.id_report and report.id_rep_type = 172')->queryAll();
            foreach($reports as $report) {
                $cusl = 0;
                $cusl = Yii::app()->db->createCommand('select count(id_usluga) from usluga1820_3 where id_est = '.$report['id_est'].' and id_pok = '.$report['id_pok'])->queryScalar();
                if(!$cusl) {
                    $res = Yii::app()->db->createCommand('insert into usluga1820_3 set id_est = '.$report['id_est'].', id_pok = '.$report['id_pok'].', col0 = '.$report['col'].', col02 = '.$report['col2'])->execute();
                }
                else {
                    $res = Yii::app()->db->createCommand('update usluga1820_3 set col0 = '.$report['col'].', col02 = '.$report['col2'].' where id_est = '.$report['id_est'].' and id_pok = '.$report['id_pok'])->execute();
                }
            }
            echo 'ok';
        }        
        
        
        public function actionExcel_mun23($id_mun) {
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select est.est_name, est.id_est from usluga1820, est where usluga1820.id_est = est.id_est and est.id_raion = '.$id_mun.' group by est.id_est')->queryAll();                
                $nv = 'Объемы государственного задания на 2018-2020 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2017.pok3 from uslugi2017, usluga1820 where uslugi2017.id_pok = usluga1820.id_pok and usluga1820.id_est = '.$report['id_est'].' group by uslugi2017.pok3')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2017.id_pok,
                            uslugi2017.pok1,
                            uslugi2017.pok2,
                            uslugi2017.pok3,
                            uslugi2017.pok4,
                            uslugi2017.pok5,
                            uslugi2017.pok8,
                            uslugi2017.pok9,
                            uslugi2017.pok10,
                            usluga1820.col8 as col8,
                            usluga1820.col82 as col82,
                            usluga1820.col9 as col9,
                            usluga1820.col92 as col92, 
                            usluga1820.col0 as col0,
                            usluga1820.col02 as col02                             
                            from uslugi2017, usluga1820 where
                            uslugi2017.id_pok = usluga1820.id_pok
                            and usluga1820.id_est = '.$report['id_est'].'
                            and uslugi2017.pok3 = "'.$pok.'"')->queryAll();
                            //$cols['col'] = (int)$cols['col'];
                            //$cols['col2'] = (int)$cols['col2'];
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok3'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

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
                foreach($bigdata as $list=>$itog) {
                    if($list) $pExcel->createSheet();

                    $aSheet = $pExcel->setActiveSheetIndex($list);

                    $aSheet->setTitle('у'.($list+1));
                    
                    $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                    $pExcel->getDefaultStyle()->getFont()->setSize(11);                  

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
                    $aSheet->setCellValue('B1','порядковый номер '.$por_num[$list]);
                    $aSheet->mergeCells('A2:K2');
                    $aSheet->getStyle('A2:K2')->getAlignment()->setWrapText(true);
                    $aSheet->setCellValue('A2',$mun.'. '.$nazv[$list].'. '.$nv);
                    $aSheet->getStyle('A2')->applyFromArray($left);
                    $aSheet->getStyle('A2')->getFont()->setBold(true);
                    $aSheet->getRowDimension(2)->setRowHeight(30);

                    //рисуем заголовок таблицы
                    $aSheet->getColumnDimension('A')->setWidth(5);
                    $aSheet->getColumnDimension('B')->setWidth(20);
                    $aSheet->getColumnDimension('C')->setWidth(25);
                    $aSheet->getColumnDimension('D')->setWidth(10);
                    $aSheet->getColumnDimension('E')->setWidth(10);
                    $aSheet->getColumnDimension('F')->setWidth(12);
                    $aSheet->getColumnDimension('G')->setWidth(15);
                    $aSheet->getColumnDimension('H')->setWidth(20);

                    $aSheet->getRowDimension(4)->setRowHeight(40);
                    $aSheet->getRowDimension(5)->setRowHeight(40);                               

                    $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                    $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:P4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:F4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:H4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border);                 

                    $aSheet->setCellValue('D5','Код услуги'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);  

                    $aSheet->setCellValue('E5','Тип'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Платность'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->mergeCells('G4:G5');
                    $aSheet->setCellValue('G4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('G4:G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Объем услуги'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);                               

                    $aSheet->mergeCells('J4:O4');
                    $aSheet->setCellValue('J4','Объем услуги (работы)'); 
                    $aSheet->getStyle('J4:O4')->applyFromArray($border);  

                    $aSheet->setCellValue('J5','на 01.01.18'); 
                    $aSheet->getStyle('J5')->applyFromArray($border);                 

                    $aSheet->setCellValue('K5','на 01.09.18'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);
                    
                    $aSheet->setCellValue('L5','на 01.01.19'); 
                    $aSheet->getStyle('L5')->applyFromArray($border);                 

                    $aSheet->setCellValue('M5','на 01.09.19'); 
                    $aSheet->getStyle('M5')->applyFromArray($border);  
                    
                    $aSheet->setCellValue('N5','на 01.01.20'); 
                    $aSheet->getStyle('N5')->applyFromArray($border);                 

                    $aSheet->setCellValue('O5','на 01.09.20'); 
                    $aSheet->getStyle('O5')->applyFromArray($border);                     
                    $i = 0;                
                    foreach($itog as $itl) {
                        $n = 1; 
                        $sum1 = 0;
                        $sum2 = 0;
                        $sum3 = 0;
                        $sum4 = 0;
                        $sum5 = 0;
                        $sum6 = 0;                        
                        foreach($itl['data'] as $it) {
                            $k = 0;
                            $sum1 = $sum1 + $it['col8'];
                            $sum2 = $sum2 + $it['col82'];
                            $sum3 = $sum3 + $it['col9'];
                            $sum4 = $sum4 + $it['col92'];
                            $sum5 = $sum5 + $it['col0'];
                            $sum6 = $sum6 + $it['col02'];                            
                            foreach ($it as $f=>$value) {
                                //if($f == 'pok14' || $f == 'pok15') continue;
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                                //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k > 8 && $k < 15) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                
                                /*if($k == 6 || $k == 7) {
                                    $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                    if($k == 6) {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok14'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    else {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok15'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($left);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getAlignment()->setWrapText(true);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                }
                                //else {
                                    $aSheet->mergeCellsByColumnAndRow($k,$i*2+6,$k,$i*2+7);
                                    if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    elseif($k == 10 || $k == 11) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                //}*/
                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        for($k = 0; $k < 15; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,8,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok3'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(9, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        //$aSheet->mergeCellsByColumnAndRow(11,$i*2+6,11,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(11, ($i + 6), $sum3, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     //$aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(12, ($i + 6), $sum4, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(13, ($i + 6), $sum5, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(14, ($i + 6), $sum6, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi1820-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionExcel_mun23_2($id_mun) {
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select est.est_name, est.id_est from usluga1820_2, est where usluga1820_2.id_est = est.id_est and est.id_raion = '.$id_mun.' group by est.id_est')->queryAll();                
                $nv = 'Объемы государственного задания на 2018-2020 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2017.pok3 from uslugi2017, usluga1820_2 where uslugi2017.id_pok = usluga1820_2.id_pok and usluga1820_2.id_est = '.$report['id_est'].' group by uslugi2017.pok3')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2017.id_pok,
                            uslugi2017.pok1,
                            uslugi2017.pok2,
                            uslugi2017.pok3,
                            uslugi2017.pok4,
                            uslugi2017.pok5,
                            uslugi2017.pok8,
                            uslugi2017.pok9,
                            uslugi2017.pok10,
                            usluga1820_2.col8 as col8,
                            usluga1820_2.col82 as col82,
                            usluga1820_2.col9 as col9,
                            usluga1820_2.col92 as col92, 
                            usluga1820_2.col0 as col0,
                            usluga1820_2.col02 as col02                             
                            from uslugi2017, usluga1820_2 where
                            uslugi2017.id_pok = usluga1820_2.id_pok
                            and usluga1820_2.id_est = '.$report['id_est'].'
                            and uslugi2017.pok3 = "'.$pok.'"')->queryAll();
                            //$cols['col'] = (int)$cols['col'];
                            //$cols['col2'] = (int)$cols['col2'];
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok3'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

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
                foreach($bigdata as $list=>$itog) {
                    if($list) $pExcel->createSheet();

                    $aSheet = $pExcel->setActiveSheetIndex($list);

                    $aSheet->setTitle('у'.($list+1));
                    
                    $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                    $pExcel->getDefaultStyle()->getFont()->setSize(11);                  

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
                    $aSheet->setCellValue('B1','порядковый номер '.$por_num[$list]);
                    $aSheet->mergeCells('A2:K2');
                    $aSheet->getStyle('A2:K2')->getAlignment()->setWrapText(true);
                    $aSheet->setCellValue('A2',$mun.'. '.$nazv[$list].'. '.$nv);
                    $aSheet->getStyle('A2')->applyFromArray($left);
                    $aSheet->getStyle('A2')->getFont()->setBold(true);
                    $aSheet->getRowDimension(2)->setRowHeight(30);

                    //рисуем заголовок таблицы
                    $aSheet->getColumnDimension('A')->setWidth(5);
                    $aSheet->getColumnDimension('B')->setWidth(20);
                    $aSheet->getColumnDimension('C')->setWidth(25);
                    $aSheet->getColumnDimension('D')->setWidth(10);
                    $aSheet->getColumnDimension('E')->setWidth(10);
                    $aSheet->getColumnDimension('F')->setWidth(12);
                    $aSheet->getColumnDimension('G')->setWidth(15);
                    $aSheet->getColumnDimension('H')->setWidth(20);

                    $aSheet->getRowDimension(4)->setRowHeight(40);
                    $aSheet->getRowDimension(5)->setRowHeight(40);                               

                    $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                    $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:P4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:F4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:H4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border);                 

                    $aSheet->setCellValue('D5','Код услуги'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);  

                    $aSheet->setCellValue('E5','Тип'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Платность'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->mergeCells('G4:G5');
                    $aSheet->setCellValue('G4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('G4:G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Объем услуги'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);                               

                    $aSheet->mergeCells('J4:O4');
                    $aSheet->setCellValue('J4','Объем услуги (работы)'); 
                    $aSheet->getStyle('J4:O4')->applyFromArray($border);  

                    $aSheet->setCellValue('J5','на 01.01.18'); 
                    $aSheet->getStyle('J5')->applyFromArray($border);                 

                    $aSheet->setCellValue('K5','на 01.09.18'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);
                    
                    $aSheet->setCellValue('L5','на 01.01.19'); 
                    $aSheet->getStyle('L5')->applyFromArray($border);                 

                    $aSheet->setCellValue('M5','на 01.09.19'); 
                    $aSheet->getStyle('M5')->applyFromArray($border);  
                    
                    $aSheet->setCellValue('N5','на 01.01.20'); 
                    $aSheet->getStyle('N5')->applyFromArray($border);                 

                    $aSheet->setCellValue('O5','на 01.09.20'); 
                    $aSheet->getStyle('O5')->applyFromArray($border);                     
                    $i = 0;                
                    foreach($itog as $itl) {
                        $n = 1; 
                        $sum1 = 0;
                        $sum2 = 0;
                        $sum3 = 0;
                        $sum4 = 0;
                        $sum5 = 0;
                        $sum6 = 0;                        
                        foreach($itl['data'] as $it) {
                            $k = 0;
                            $sum1 = $sum1 + $it['col8'];
                            $sum2 = $sum2 + $it['col82'];
                            $sum3 = $sum3 + $it['col9'];
                            $sum4 = $sum4 + $it['col92'];
                            $sum5 = $sum5 + $it['col0'];
                            $sum6 = $sum6 + $it['col02'];                            
                            foreach ($it as $f=>$value) {
                                //if($f == 'pok14' || $f == 'pok15') continue;
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                                //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k > 8 && $k < 15) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                
                                /*if($k == 6 || $k == 7) {
                                    $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                    if($k == 6) {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok14'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    else {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok15'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($left);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getAlignment()->setWrapText(true);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                }
                                //else {
                                    $aSheet->mergeCellsByColumnAndRow($k,$i*2+6,$k,$i*2+7);
                                    if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    elseif($k == 10 || $k == 11) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                //}*/
                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        for($k = 0; $k < 15; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,8,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok3'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(9, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        //$aSheet->mergeCellsByColumnAndRow(11,$i*2+6,11,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(11, ($i + 6), $sum3, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     //$aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(12, ($i + 6), $sum4, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(13, ($i + 6), $sum5, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(14, ($i + 6), $sum6, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi1820-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));            
        }

        public function actionExcel_mun23_3($id_mun) {
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select est.est_name, est.id_est from usluga1820_3, est where usluga1820_3.id_est = est.id_est and est.id_raion = '.$id_mun.' group by est.id_est')->queryAll();                
                $nv = 'Объемы государственного задания на 2018-2020 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2017.pok3 from uslugi2017, usluga1820_3 where uslugi2017.id_pok = usluga1820_3.id_pok and usluga1820_3.id_est = '.$report['id_est'].' group by uslugi2017.pok3')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2017.id_pok,
                            uslugi2017.pok1,
                            uslugi2017.pok2,
                            uslugi2017.pok3,
                            uslugi2017.pok4,
                            uslugi2017.pok5,
                            uslugi2017.pok8,
                            uslugi2017.pok9,
                            uslugi2017.pok10,
                            usluga1820_3.col8 as col8,
                            usluga1820_3.col82 as col82,
                            usluga1820_3.col9 as col9,
                            usluga1820_3.col92 as col92, 
                            usluga1820_3.col0 as col0,
                            usluga1820_3.col02 as col02                             
                            from uslugi2017, usluga1820_3 where
                            uslugi2017.id_pok = usluga1820_3.id_pok
                            and usluga1820_3.id_est = '.$report['id_est'].'
                            and uslugi2017.pok3 = "'.$pok.'"')->queryAll();
                            //$cols['col'] = (int)$cols['col'];
                            //$cols['col2'] = (int)$cols['col2'];
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok3'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

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
                foreach($bigdata as $list=>$itog) {
                    if($list) $pExcel->createSheet();

                    $aSheet = $pExcel->setActiveSheetIndex($list);

                    $aSheet->setTitle('у'.($list+1));
                    
                    $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                    $pExcel->getDefaultStyle()->getFont()->setSize(11);                  

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
                    $aSheet->setCellValue('B1','порядковый номер '.$por_num[$list]);
                    $aSheet->mergeCells('A2:K2');
                    $aSheet->getStyle('A2:K2')->getAlignment()->setWrapText(true);
                    $aSheet->setCellValue('A2',$mun.'. '.$nazv[$list].'. '.$nv);
                    $aSheet->getStyle('A2')->applyFromArray($left);
                    $aSheet->getStyle('A2')->getFont()->setBold(true);
                    $aSheet->getRowDimension(2)->setRowHeight(30);

                    //рисуем заголовок таблицы
                    $aSheet->getColumnDimension('A')->setWidth(5);
                    $aSheet->getColumnDimension('B')->setWidth(20);
                    $aSheet->getColumnDimension('C')->setWidth(25);
                    $aSheet->getColumnDimension('D')->setWidth(10);
                    $aSheet->getColumnDimension('E')->setWidth(10);
                    $aSheet->getColumnDimension('F')->setWidth(12);
                    $aSheet->getColumnDimension('G')->setWidth(15);
                    $aSheet->getColumnDimension('H')->setWidth(20);

                    $aSheet->getRowDimension(4)->setRowHeight(40);
                    $aSheet->getRowDimension(5)->setRowHeight(40);                               

                    $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                    $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:P4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:F4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:H4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border);                 

                    $aSheet->setCellValue('D5','Код услуги'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);  

                    $aSheet->setCellValue('E5','Тип'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Платность'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->mergeCells('G4:G5');
                    $aSheet->setCellValue('G4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('G4:G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Объем услуги'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);                               

                    $aSheet->mergeCells('J4:O4');
                    $aSheet->setCellValue('J4','Объем услуги (работы)'); 
                    $aSheet->getStyle('J4:O4')->applyFromArray($border);  

                    $aSheet->setCellValue('J5','на 01.01.18'); 
                    $aSheet->getStyle('J5')->applyFromArray($border);                 

                    $aSheet->setCellValue('K5','на 01.09.18'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);
                    
                    $aSheet->setCellValue('L5','на 01.01.19'); 
                    $aSheet->getStyle('L5')->applyFromArray($border);                 

                    $aSheet->setCellValue('M5','на 01.09.19'); 
                    $aSheet->getStyle('M5')->applyFromArray($border);  
                    
                    $aSheet->setCellValue('N5','на 01.01.20'); 
                    $aSheet->getStyle('N5')->applyFromArray($border);                 

                    $aSheet->setCellValue('O5','на 01.09.20'); 
                    $aSheet->getStyle('O5')->applyFromArray($border);                     
                    $i = 0;                
                    foreach($itog as $itl) {
                        $n = 1; 
                        $sum1 = 0;
                        $sum2 = 0;
                        $sum3 = 0;
                        $sum4 = 0;
                        $sum5 = 0;
                        $sum6 = 0;                        
                        foreach($itl['data'] as $it) {
                            $k = 0;
                            $sum1 = $sum1 + $it['col8'];
                            $sum2 = $sum2 + $it['col82'];
                            $sum3 = $sum3 + $it['col9'];
                            $sum4 = $sum4 + $it['col92'];
                            $sum5 = $sum5 + $it['col0'];
                            $sum6 = $sum6 + $it['col02'];                            
                            foreach ($it as $f=>$value) {
                                //if($f == 'pok14' || $f == 'pok15') continue;
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                                //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k > 8 && $k < 15) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                
                                /*if($k == 6 || $k == 7) {
                                    $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                    if($k == 6) {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok14'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    else {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok15'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($left);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getAlignment()->setWrapText(true);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                }
                                //else {
                                    $aSheet->mergeCellsByColumnAndRow($k,$i*2+6,$k,$i*2+7);
                                    if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    elseif($k == 10 || $k == 11) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                //}*/
                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        for($k = 0; $k < 15; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,8,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok3'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(9, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        //$aSheet->mergeCellsByColumnAndRow(11,$i*2+6,11,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(11, ($i + 6), $sum3, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     //$aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(12, ($i + 6), $sum4, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(13, ($i + 6), $sum5, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $aSheet->setCellValueExplicitByColumnAndRow(14, ($i + 6), $sum6, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi1820-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));            
        }         
        
        public function actionExcel_mun($id_rep_type, $id_mun) {
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $otchet = Yii::app()->db->createCommand('select rep_type from rep_name where rep_type = 47 and id_rep_type ='.$id_rep_type)->queryScalar();                           
                if(!$otchet) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав');
                $reports = Yii::app()->db->createCommand('select est.est_name, report.id_report, est.id_est from report, est where report.status <> 6 and report.id_est = est.id_est and est.id_raion = '.$id_mun.' and report.id_rep_type = '.$id_rep_type)->queryAll();                
                $nv = 'Объемы государственного задания на 2020 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2017.pok3 from uslugi2017, usluga20_res where uslugi2017.id_pok = usluga20_res.id_pok and usluga20_res.id_report = '.$report['id_report'].' group by uslugi2017.pok3')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2017.id_pok,
                            uslugi2017.pok1,
                            uslugi2017.pok2,
                            uslugi2017.pok3,
                            uslugi2017.pok4,
                            uslugi2017.pok5,
                            uslugi2017.pok8,
                            uslugi2017.pok9,
                            uslugi2017.pok10,
                            usluga20_res.col as col,
                            usluga20_res.col2 as col2                            
                            from uslugi2017, usluga20_res where
                            uslugi2017.id_pok = usluga20_res.id_pok
                            and usluga20_res.id_report = '.$report['id_report'].'
                            and uslugi2017.pok3 = "'.$pok.'"')->queryAll();
                            //$cols['col'] = (int)$cols['col'];
                            //$cols['col2'] = (int)$cols['col2'];
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok3'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

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
                foreach($bigdata as $list=>$itog) {
                    if($list) $pExcel->createSheet();

                    $aSheet = $pExcel->setActiveSheetIndex($list);

                    $aSheet->setTitle('у'.($list+1));
                    
                    $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                    $pExcel->getDefaultStyle()->getFont()->setSize(11);                  

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
                    $aSheet->setCellValue('B1','порядковый номер '.$por_num[$list]);
                    $aSheet->mergeCells('A2:K2');
                    $aSheet->getStyle('A2:K2')->getAlignment()->setWrapText(true);
                    $aSheet->setCellValue('A2',$mun.'. '.$nazv[$list].'. '.$nv);
                    $aSheet->getStyle('A2')->applyFromArray($left);
                    $aSheet->getStyle('A2')->getFont()->setBold(true);
                    $aSheet->getRowDimension(2)->setRowHeight(30);

                    //рисуем заголовок таблицы
                    $aSheet->getColumnDimension('A')->setWidth(5);
                    $aSheet->getColumnDimension('B')->setWidth(20);
                    $aSheet->getColumnDimension('C')->setWidth(25);
                    $aSheet->getColumnDimension('D')->setWidth(10);
                    $aSheet->getColumnDimension('E')->setWidth(10);
                    $aSheet->getColumnDimension('F')->setWidth(12);
                    $aSheet->getColumnDimension('G')->setWidth(15);
                    $aSheet->getColumnDimension('H')->setWidth(20);

                    $aSheet->getRowDimension(4)->setRowHeight(40);
                    $aSheet->getRowDimension(5)->setRowHeight(40);                               

                    $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                    $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:P4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:F4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:H4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border);                 

                    $aSheet->setCellValue('D5','Код услуги'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);  

                    $aSheet->setCellValue('E5','Тип'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Платность'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->mergeCells('G4:G5');
                    $aSheet->setCellValue('G4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('G4:G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Объем услуги'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);                               

                    $aSheet->mergeCells('J4:K4');
                    $aSheet->setCellValue('J4','Объем услуги (работы)'); 
                    $aSheet->getStyle('J4:K4')->applyFromArray($border);  

                    $aSheet->setCellValue('J5','на 01.01.20'); 
                    $aSheet->getStyle('J5')->applyFromArray($border);                 

                    $aSheet->setCellValue('K5','на 01.09.20'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);
                    $i = 0;                
                    foreach($itog as $itl) {
                        $n = 1; 
                        $sum1 = 0;
                        $sum2 = 0;
                        foreach($itl['data'] as $it) {
                            $k = 0;
                            $sum1 = $sum1 + $it['col'];
                            $sum2 = $sum2 + $it['col2'];
                            foreach ($it as $f=>$value) {
                                //if($f == 'pok14' || $f == 'pok15') continue;
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                                //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k == 9 || $k == 10) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                
                                /*if($k == 6 || $k == 7) {
                                    $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                    if($k == 6) {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok14'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    else {
                                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 7), $it['pok15'], PHPExcel_Cell_DataType::TYPE_STRING);
                                    }
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($left);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getAlignment()->setWrapText(true);
                                    $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                }
                                //else {
                                    $aSheet->mergeCellsByColumnAndRow($k,$i*2+6,$k,$i*2+7);
                                    if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    elseif($k == 10 || $k == 11) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                    else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                                //}*/
                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        for($k = 0; $k < 11; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,8,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok3'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(9, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        //$aSheet->mergeCellsByColumnAndRow(11,$i*2+6,11,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);                     
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi2020-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));              
        }        
               
}





