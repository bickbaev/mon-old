<?php

class Uslugi19Controller extends Controller
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
                    $okr = array();
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
        
	public function actionIndex_mun_f()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();                
                $mun = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                $this->render('index_mun_f', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'mun'=>$mun));
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
                        $poks = Yii::app()->db->createCommand('select id_pok from uslugi2019')->queryColumn();
                        foreach($poks as $m=>$pok) {
                            $cols = Yii::app()->db->createCommand('select
                                uslugi2019.id_pok,
                                uslugi2019.pok1,
                                uslugi2019.pok2,
                                uslugi2019.pok3,
                                uslugi2019.pok4,
                                uslugi2019.pok5,
                                uslugi2019.pok6,
                                uslugi2019.pok7,
                                uslugi2019.pok8,
                                uslugi2019.pok9,
                                uslugi2019.pok10,
                                uslugi2019.pok11,
                                sum(us19_res.col1) as col1,
                                sum(us19_res.col2) as col2,
                                sum(us19_res.col3) as col3,
                                sum(us19_res.col4) as col4,
                                sum(us19_res.col5) as col5,
                                sum(us19_res.col6) as col6                                
                                from uslugi2019, us19_res, report where
                                uslugi2019.id_pok = us19_res.id_pok
                                and us19_res.id_report = report.id_report
                                and report.id_rep_type = '.$id_rep_type.'
                                and uslugi2019.id_pok ='.$pok)->queryAll();
                                $itog[$m] = $cols[0];
                        }                        
                        
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else {
                    if(Yii::app()->session['type_adm'] == 3) {$id_okr = Yii::app()->session['est'];}
                    elseif(Yii::app()->session['type_adm'] == 4) {$id_okr = (int)$id_okr;}
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                    $poks = Yii::app()->db->createCommand('select uslugi2019.id_pok as id_pok from uslugi2019, us19_res, report, est where
                        uslugi2019.id_pok = us19_res.id_pok
                        and us19_res.id_report = report.id_report
                        and report.id_est = est.id_est
                        and est.id_okr = '.$id_okr.'
                        and report.id_rep_type = '.$id_rep_type.'
                        group by uslugi2019.id_pok
                        order by uslugi2019.id_pok')->queryColumn(); 
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2019.id_pok,
                            uslugi2019.pok1,
                            uslugi2019.pok2,
                            uslugi2019.pok3,
                            uslugi2019.pok4,
                            uslugi2019.pok5,
                            uslugi2019.pok6,
                            uslugi2019.pok7,
                            uslugi2019.pok8,
                            uslugi2019.pok9,
                            uslugi2019.pok10,
                            uslugi2019.pok11,
                            sum(us19_res.col1) as col1,
                            sum(us19_res.col2) as col2,
                            sum(us19_res.col3) as col3,
                            sum(us19_res.col4) as col4,
                            sum(us19_res.col5) as col5,
                            sum(us19_res.col6) as col6                           
                            from uslugi2019, us19_res, report, est where
                            uslugi2019.id_pok = us19_res.id_pok
                            and us19_res.id_report = report.id_report
                            and report.id_est = est.id_est
                            and est.id_okr = '.$id_okr.'
                            and report.id_rep_type = '.$id_rep_type.'
                            and uslugi2019.id_pok ='.$pok)->queryAll();
                            $itog[$m] = $cols[0];
                    }                    
                }
                               
                
                //print_r($itog);
                
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

                spl_autoload_unregister(array('YiiBase','autoload'));

                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

                $diap = 'A4:R5';
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
                

                $aSheet->getStyle($diap)->getAlignment()->setWrapText(true);
                $aSheet->getRowDimension(2)->setRowHeight(-1);
                
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);

                $aSheet->setCellValue('B2',$nazv);
                $aSheet->getStyle('B2')->getFont()->setBold(true);
                                

                $aSheet->getColumnDimension('A')->setWidth(5);
                $aSheet->getColumnDimension('B')->setWidth(20);
                $aSheet->getColumnDimension('C')->setWidth(27);
                $aSheet->getColumnDimension('D')->setWidth(10);
                $aSheet->getColumnDimension('E')->setWidth(10);
                $aSheet->getColumnDimension('F')->setWidth(10);
                $aSheet->getColumnDimension('G')->setWidth(12);
                $aSheet->getColumnDimension('H')->setWidth(20);
                $aSheet->getColumnDimension('I')->setWidth(15);
                $aSheet->getColumnDimension('J')->setWidth(20);
                $aSheet->getColumnDimension('K')->setWidth(10);
                $aSheet->getColumnDimension('L')->setWidth(15);
                
                $aSheet->getRowDimension(4)->setRowHeight(40);
                $aSheet->getRowDimension(5)->setRowHeight(90);                               
                
                $aSheet->getDefaultStyle('A4:R5')->applyFromArray($center);
                $aSheet->getStyle('A4:R5')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A4:R4')->getFont()->setBold(true);
                
                $aSheet->mergeCells('A4:A5');
                $aSheet->setCellValue('A4','№ п/п'); 
                $aSheet->getStyle('A4:A5')->applyFromArray($border);
                
                $aSheet->mergeCells('B4:B5');
                $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                
                $aSheet->mergeCells('C4:I4');
                $aSheet->setCellValue('C4','Общая информация'); 
                $aSheet->getStyle('C4:I4')->applyFromArray($border);  
                
                $aSheet->setCellValue('C5','Уникальный реестровый номер услуги'); 
                $aSheet->getStyle('C5')->applyFromArray($border);
                
                $aSheet->setCellValue('D5','Код работы, сформированный по новому алгоритму'); 
                $aSheet->getStyle('D5')->applyFromArray($border);                
                
                $aSheet->setCellValue('E5','Код услуги'); 
                $aSheet->getStyle('E5')->applyFromArray($border);  
                
                $aSheet->setCellValue('F5','Тип'); 
                $aSheet->getStyle('F5')->applyFromArray($border);  
                
                $aSheet->setCellValue('G5','Платность'); 
                $aSheet->getStyle('G5')->applyFromArray($border);  
                
                $aSheet->setCellValue('H5','Виды учреждений'); 
                $aSheet->getStyle('H5')->applyFromArray($border);  
                
                $aSheet->setCellValue('I5','Категории потребителей'); 
                $aSheet->getStyle('I5')->applyFromArray($border);  
                
                $aSheet->mergeCells('J4:J5');
                $aSheet->setCellValue('J4','Содержание услуги (работы)'); 
                $aSheet->getStyle('J4:J5')->applyFromArray($border);                 
                
                $aSheet->mergeCells('K4:K5');
                $aSheet->setCellValue('K4','Условия оказания услуги (работы)'); 
                $aSheet->getStyle('K4:K5')->applyFromArray($border);
                
                $aSheet->mergeCells('L4:L5');
                $aSheet->setCellValue('L4','Объем услуги'); 
                $aSheet->getStyle('L4:L5')->applyFromArray($border);
                
                $aSheet->mergeCells('M4:R4');
                $aSheet->setCellValue('M4','Объем услуги (работы)'); 
                $aSheet->getStyle('M4:R4')->applyFromArray($border);                
                
                $aSheet->setCellValue('M5','на 01.01.19'); 
                $aSheet->getStyle('M5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('N5','на 01.09.19'); 
                $aSheet->getStyle('N5')->applyFromArray($border);  
                
                $aSheet->setCellValue('O5','на 01.01.20'); 
                $aSheet->getStyle('O5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('P5','на 01.09.20'); 
                $aSheet->getStyle('P5')->applyFromArray($border); 

                $aSheet->setCellValue('Q5','на 01.01.21'); 
                $aSheet->getStyle('Q5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('R5','на 01.09.21'); 
                $aSheet->getStyle('R5')->applyFromArray($border);          
                
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $f=>$value) {

                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        
                        if($k > 11) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                        
                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi2019-2021.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));                
        }     
        
        
        public function actionExcel_mun($id_rep_type, $id_mun) {
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $otchet = Yii::app()->db->createCommand('select rep_type from rep_name where rep_type = 51 and id_rep_type ='.$id_rep_type)->queryScalar();                           
                if(!$otchet) throw new CHttpException(403,'У Вас нет необходимых прав1');
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав2');
                $reports = Yii::app()->db->createCommand('select est.est_name, report.id_report, est.id_est from report, est where report.status <> 6 and report.id_est = est.id_est and est.id_raion = '.$id_mun.' and report.id_rep_type = '.$id_rep_type)->queryAll();                
                $nv = 'Объемы государственного задания на 2019-2021 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2019.pok4 from uslugi2019, us19_res where uslugi2019.id_pok = us19_res.id_pok and us19_res.id_report = '.$report['id_report'].' group by uslugi2019.pok4')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2019.id_pok,
                            uslugi2019.pok1,
                            uslugi2019.pok2,
                            uslugi2019.pok3,
                            uslugi2019.pok4,
                            uslugi2019.pok5,
                            uslugi2019.pok6,
                            uslugi2019.pok9,
                            uslugi2019.pok10,
                            uslugi2019.pok11,
                            us19_res.col1 as col1,
                            us19_res.col2 as col2,
                            us19_res.col3 as col3,
                            us19_res.col4 as col4,
                            us19_res.col5 as col5,
                            us19_res.col6 as col6                             
                            from uslugi2019, us19_res where
                            uslugi2019.id_pok = us19_res.id_pok
                            and us19_res.id_report = '.$report['id_report'].'
                            and uslugi2019.pok4 = "'.$pok.'"')->queryAll();
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok4'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

                spl_autoload_unregister(array('YiiBase','autoload'));

                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

                
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
                    $aSheet->getRowDimension(5)->setRowHeight(90);                               

                    $aSheet->getDefaultStyle('A4:P5')->applyFromArray($center);
                    $aSheet->getStyle('A4:P5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:P4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:G4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:G4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Уникальный реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border); 
                    
                    $aSheet->setCellValue('D5','Код работы, сформированный по новому алгоритму'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);                      

                    $aSheet->setCellValue('E5','Код услуги'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Тип'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->setCellValue('G5','Платность'); 
                    $aSheet->getStyle('G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);  

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);

                    $aSheet->mergeCells('J4:J5');
                    $aSheet->setCellValue('J4','Объем услуги'); 
                    $aSheet->getStyle('J4:J5')->applyFromArray($border);                               

                    $aSheet->mergeCells('K4:P4');
                    $aSheet->setCellValue('K4','Объем услуги (работы)'); 
                    $aSheet->getStyle('K4:P4')->applyFromArray($border);  

                    $aSheet->setCellValue('K5','на 01.01.19'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);                 

                    $aSheet->setCellValue('L5','на 01.09.19'); 
                    $aSheet->getStyle('L5')->applyFromArray($border);
                    
                    $aSheet->setCellValue('M5','на 01.01.20'); 
                    $aSheet->getStyle('M5')->applyFromArray($border);                 

                    $aSheet->setCellValue('N5','на 01.09.20'); 
                    $aSheet->getStyle('N5')->applyFromArray($border);

                    $aSheet->setCellValue('O5','на 01.01.21'); 
                    $aSheet->getStyle('O5')->applyFromArray($border);                 

                    $aSheet->setCellValue('P5','на 01.09.21'); 
                    $aSheet->getStyle('P5')->applyFromArray($border);
                    
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
                            $sum1 = $sum1 + $it['col1'];
                            $sum2 = $sum2 + $it['col2'];
                            $sum3 = $sum3 + $it['col3'];
                            $sum4 = $sum4 + $it['col4'];
                            $sum5 = $sum5 + $it['col5'];
                            $sum6 = $sum6 + $it['col6'];                            
                            foreach ($it as $f=>$value) {

                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);

                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k > 9) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                

                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        for($k = 0; $k < 16; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,9,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok4'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(11, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC); 
                        $aSheet->setCellValueExplicitByColumnAndRow(12, ($i + 6), $sum3, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(13, ($i + 6), $sum4, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(14, ($i + 6), $sum5, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        $aSheet->setCellValueExplicitByColumnAndRow(15, ($i + 6), $sum6, PHPExcel_Cell_DataType::TYPE_NUMERIC);                        
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi19-21-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));              
        } 

        public function actionExcel_mun_f($id_rep_type, $id_mun) {
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int)$id_rep_type;
                $otchet = Yii::app()->db->createCommand('select rep_type from rep_name where rep_type = 51 and id_rep_type ='.$id_rep_type)->queryScalar();                           
                if(!$otchet) throw new CHttpException(403,'У Вас нет необходимых прав1');
                $id_mun = (int)$id_mun;
                $mun = Yii::app()->db->createCommand('select est_name from est where type_adm = 2 and id_raion ='.$id_mun)->queryScalar();
                if(!$mun) throw new CHttpException(403,'У Вас нет необходимых прав2');
                $reports = Yii::app()->db->createCommand('select est.est_name, report.id_report, est.id_est from report, est where report.status <> 6 and report.id_est = est.id_est and est.id_raion = '.$id_mun.' and report.id_rep_type = '.$id_rep_type)->queryAll();                
                $nv = 'Объемы государственного задания на 2019 год.';
                foreach($reports as $num_rep=>$report) {
                    $poks = array();
                    $itog = array();
                    $poks = Yii::app()->db->createCommand('select uslugi2019.pok4 from uslugi2019, us19_res where uslugi2019.id_pok = us19_res.id_pok and us19_res.id_report = '.$report['id_report'].' group by uslugi2019.pok4')->queryColumn();
                    foreach($poks as $m=>$pok) {
                        $cols = Yii::app()->db->createCommand('select
                            uslugi2019.id_pok,
                            uslugi2019.pok1,
                            uslugi2019.pok2,
                            uslugi2019.pok3,
                            uslugi2019.pok4,
                            uslugi2019.pok5,
                            uslugi2019.pok6,
                            uslugi2019.pok9,
                            uslugi2019.pok10,
                            uslugi2019.pok11,
                            us19_res.col1 as col1,
                            us19_res.col2 as col2                           
                            from uslugi2019, us19_res where
                            uslugi2019.id_pok = us19_res.id_pok
                            and us19_res.id_report = '.$report['id_report'].'
                            and uslugi2019.pok4 = "'.$pok.'"')->queryAll();
                            $itog[$m]['data'] = $cols;
                            $itog[$m]['pok4'] = $pok;
                    }
                    $bigdata[$num_rep] = $itog;
                    $nazv[$num_rep] = $report['est_name'];
                    $por_num[$num_rep] = Yii::app()->db->createCommand('select id_num from uslugi_num where id_est ='.$report['id_est'])->queryScalar();
                }
                //print_r($bigdata);
                

                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';

                spl_autoload_unregister(array('YiiBase','autoload'));

                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

                
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

                    $aSheet->getRowDimension(4)->setRowHeight(50);
                    $aSheet->getRowDimension(5)->setRowHeight(90);                               

                    $aSheet->getDefaultStyle('A4:L5')->applyFromArray($center);
                    $aSheet->getStyle('A4:L5')->getAlignment()->setWrapText(true);
                    $aSheet->getStyle('A4:L4')->getFont()->setBold(true);

                    $aSheet->mergeCells('A4:A5');
                    $aSheet->setCellValue('A4','№ п/п'); 
                    $aSheet->getStyle('A4:A5')->applyFromArray($border);

                    $aSheet->mergeCells('B4:B5');
                    $aSheet->setCellValue('B4','Наименование услуги (работы)'); 
                    $aSheet->getStyle('B4:B5')->applyFromArray($border);  

                    $aSheet->mergeCells('C4:G4');
                    $aSheet->setCellValue('C4','Общая информация'); 
                    $aSheet->getStyle('C4:G4')->applyFromArray($border);  

                    $aSheet->setCellValue('C5','Уникальный реестровый номер услуги'); 
                    $aSheet->getStyle('C5')->applyFromArray($border); 
                    
                    $aSheet->setCellValue('D5','Код работы, сформированный по новому алгоритму'); 
                    $aSheet->getStyle('D5')->applyFromArray($border);                      

                    $aSheet->setCellValue('E5','Код услуги'); 
                    $aSheet->getStyle('E5')->applyFromArray($border);  

                    $aSheet->setCellValue('F5','Тип'); 
                    $aSheet->getStyle('F5')->applyFromArray($border);  

                    $aSheet->setCellValue('G5','Платность'); 
                    $aSheet->getStyle('G5')->applyFromArray($border);  

                    $aSheet->mergeCells('H4:H5');
                    $aSheet->setCellValue('H4','Содержание услуги (работы)'); 
                    $aSheet->getStyle('H4:H5')->applyFromArray($border);  

                    $aSheet->mergeCells('I4:I5');
                    $aSheet->setCellValue('I4','Условия оказания услуги (работы)'); 
                    $aSheet->getStyle('I4:I5')->applyFromArray($border);

                    $aSheet->mergeCells('J4:J5');
                    $aSheet->setCellValue('J4','Объем услуги'); 
                    $aSheet->getStyle('J4:J5')->applyFromArray($border); 
                    

                    $aSheet->setCellValue('K4','Объем услуги (работы)');  //1
                    $aSheet->getStyle('K4')->applyFromArray($border);                     

                    /*$aSheet->mergeCells('K4:L4'); //1
                    $aSheet->setCellValue('K4','Объем услуги (работы)'); 
                    $aSheet->getStyle('K4:L4')->applyFromArray($border);*/  

                    $aSheet->setCellValue('K5','на 01.01.19'); 
                    $aSheet->getStyle('K5')->applyFromArray($border);                 

                    //$aSheet->setCellValue('L5','на 01.09.19');  //1
                    //$aSheet->getStyle('L5')->applyFromArray($border);
                    
                    
                    $i = 0;
                    
                    foreach($itog as $itl) {
                        $n = 1; 
                        $sum1 = 0;
                        $sum2 = 0;                      
                        foreach($itl['data'] as $it) {
                            $k = 0;
                            $sum1 = $sum1 + $it['col1'];
                            //$sum2 = $sum2 + $it['col2']; //1                        
                            foreach ($it as $f=>$value) {
                                
                                if($k == 11) continue; //1

                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);

                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                                $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                                
                                if($k == 0) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $n, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                elseif($k > 9) $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                                else $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);                                

                                $k = $k + 1;
                            }
                            $i = $i + 1;
                            $n = $n + 1;
                        }
                        /*for($k = 0; $k < 12; $k++) {*/
                        for($k = 0; $k < 11; $k++) {
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);
                            //$aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->getFont()->setBold(true);
                            $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);                        
                        }
                        $aSheet->mergeCellsByColumnAndRow(0,$i+6,9,$i+6);

                        $aSheet->setCellValueExplicitByColumnAndRow(0, ($i + 6), 'Итого по коду услуги '.$itl['pok4'], PHPExcel_Cell_DataType::TYPE_STRING);
                        //$aSheet->mergeCellsByColumnAndRow(10,$i*2+6,10,$i*2+7);

                        $aSheet->setCellValueExplicitByColumnAndRow(10, ($i + 6), $sum1, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        //$aSheet->setCellValueExplicitByColumnAndRow(11, ($i + 6), $sum2, PHPExcel_Cell_DataType::TYPE_NUMERIC);     //1                 
                        $i = $i + 1;
                    }
                }    
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi19-'.$id_mun.'.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));              
        }        
        
}        
