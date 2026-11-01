<?php

class Uslugi2015Controller extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                $id_est = Report::model()->findByPk($id_rep)->id_est;
                $naim_est = Est::model()->findByPk($id_est)->est_name;
                $uslugi = Yii::app()->db->createCommand('select * from usluga_res where id_report = '.$id_rep)->queryAll();
                foreach($uslugi as $k=>$usluga) {
                    $uslugi[$k]['ras'] = Yii::app()->db->createCommand('select * from uslugi2015 where id_pok = '.$usluga['id_pok'])->queryRow();
                }
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'uslugi'=>$uslugi,
                ));
            }
        }
        
        public function actionDel($id_rep, $id_usluga) {
            if($this->check_prava($id_rep)) {
                $c_t = Yii::app()->db->createCommand('select count(id_usluga) from usluga_res where id_usluga = '.(int)$id_usluga)->queryScalar();
                if(!$c_t) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $res = Yii::app()->db->createCommand('delete from usluga_res where id_usluga = '.$id_usluga)->execute();
                Yii::app()->user->setFlash('success', "Услуга удалена");
                $this->redirect(array('edit','id_rep'=>$id_rep));
            }
        }

        public function actionStep1($id_rep) {
            if ($this->check_prava($id_rep)) {
                $types = Yii::app()->db->createCommand('select * from uslugi_type')->queryAll();
                $this->render('step1', array(
                    'types'=> $types,
                    'id_rep'=> $id_rep,
                ));                
            }
        }
        
        public function actionStep2($id_rep, $type) {
            if ($this->check_prava($id_rep)) {
                $type = (int)$type;
                $c_t = Yii::app()->db->createCommand('select count(id_type) from uslugi_type where id_type = '.$type)->queryScalar();
                if(!$c_t) throw new CHttpException(403,'У Вас нет необходимых прав');
                $formas = Yii::app()->db->createCommand('select uslugi_forma.id_forma as id_forma, uslugi_forma.naim_forma as naim_forma from uslugi2015, uslugi_forma where uslugi2015.forma=uslugi_forma.id_forma and uslugi2015.type = '.$type.' group by uslugi_forma.naim_forma order by uslugi_forma.id_forma')->queryAll();
                $this->render('step2', array(
                    'formas'=> $formas,
                    'id_rep'=> $id_rep,
                    'type'=> $type,
                ));                
            }
        }
        
        
        public function actionStep3($id_rep, $type, $forma) {
            if ($this->check_prava($id_rep)) {
                $type = (int)$type;
                $forma = (int)$forma;
                $uslugi = Yii::app()->db->createCommand('select * from uslugi2015 where type = '.$type.' and forma = '.$forma)->queryAll();
                if(!sizeof($uslugi)) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $this->render('step3', array(
                    'uslugi'=> $uslugi,
                    'id_rep'=> $id_rep,
                ));                
            }
        }
        
        public function actionAdd($id_rep, $id_pok) {
            if ($this->check_prava($id_rep)) {
                $id_pok = (int)$id_pok;
                $usluga = Yii::app()->db->createCommand('select * from uslugi2015 where id_pok = '.$id_pok)->queryAll();
                if(!sizeof($usluga)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $model = new Usluga_res;
                if(isset($_POST['Usluga_res']))
                {
                    $model->attributes=$_POST['Usluga_res'];
                    $model->id_report = $id_rep;
                    $model->id_pok = $id_pok;
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->status = 2;
                        $report->save();                        
                        Yii::app()->user->setFlash('success', "Услуга добавлена");
                        $this->redirect(array('edit','id_rep'=>$id_rep));
                    }    
                }                
                $this->render('add', array(
                    'usluga'=> $usluga,
                    'id_rep'=> $id_rep,
                    'model'=>$model,
                ));                
            }            
        }
        
        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        

        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type, rep_name.id_rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
            $reader = $command->queryRow();
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }
        
        public function actionExcel($id_rep) {
                $this->check_prava($id_rep);
                $otchet = Yii::app()->db->createCommand('select rep_name.rep_name, DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();                            
                if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'].'. Сформирован по состоянию на '.date('d.m.Y H:i');
                $nazv = 'Перечень государственных услуг и работ';
                
                $poks = Yii::app()->db->createCommand('select id_pok from usluga_res where id_report='.$id_rep)->queryColumn(); 
                foreach($poks as $m=>$pok) {
                    $cols = Yii::app()->db->createCommand('select
                        uslugi2015.id_pok,
                        uslugi2015.pok1,
                        uslugi2015.pok2,
                        uslugi2015.pok3,
                        uslugi2015.pok4,
                        uslugi2015.pok5,
                        uslugi2015.pok6,
                        uslugi2015.pok7,
                        uslugi2015.pok8,
                        uslugi2015.pok9,
                        uslugi2015.pok10,
                        uslugi2015.pok11,
                        uslugi2015.pok12,
                        uslugi2015.pok13,
                        uslugi2015.pok14,
                        uslugi2015.pok15,
                        sum(usluga_res.col) as col,
                        sum(usluga_res.col2) as col2                            
                        from uslugi2015, usluga_res where
                        uslugi2015.id_pok = usluga_res.id_pok
                        and usluga_res.id_report = '.$id_rep.'
                        and uslugi2015.id_pok = '.$pok)->queryAll();
                        $itog[$m] = $cols[0];
                }                    
                               
                
                //print_r($itog);
                
                $phpExcelPath = '/var/www/mon/public_html/www/protected/vendors/phpexcel';
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
                
                $aSheet->mergeCells('I4:J4');
                $aSheet->setCellValue('I4','Содержание услуги (работы)'); 
                $aSheet->getStyle('I4:J4')->applyFromArray($border);  
                
                $aSheet->setCellValue('I5','Наименование показателя'); 
                $aSheet->getStyle('I5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('J5','Значение показателя'); 
                $aSheet->getStyle('J5')->applyFromArray($border);
                
                $aSheet->mergeCells('K4:K5');
                $aSheet->setCellValue('K4','Условия оказания услуги (работы)'); 
                $aSheet->getStyle('K4:K5')->applyFromArray($border);
                
                $aSheet->mergeCells('L4:L5');
                $aSheet->setCellValue('L4','Объем услуги'); 
                $aSheet->getStyle('L4:L5')->applyFromArray($border);                
                
                $aSheet->mergeCells('M4:N4');
                $aSheet->setCellValue('M4','Качество услуги'); 
                $aSheet->getStyle('M4:N4')->applyFromArray($border);  
                
                $aSheet->setCellValue('M5','Наименование показателя'); 
                $aSheet->getStyle('M5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('N5','Единицы измерения'); 
                $aSheet->getStyle('N5')->applyFromArray($border); 
                
                $aSheet->mergeCells('O4:P4');
                $aSheet->setCellValue('O4','Объем услуги (работы)'); 
                $aSheet->getStyle('O4:P4')->applyFromArray($border);  
                
                $aSheet->setCellValue('O5','на 01.01.16'); 
                $aSheet->getStyle('O5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('P5','на 01.09.16'); 
                $aSheet->getStyle('P5')->applyFromArray($border);                
                
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $f=>$value) {
                        if($f == 'pok14' || $f == 'pok15') continue;
                        $aSheet->getStyleByColumnAndRow($k, $i*2 + 6)->applyFromArray($border);
                        $aSheet->getStyleByColumnAndRow($k, $i*2 + 7)->applyFromArray($border);
                        $aSheet->getStyleByColumnAndRow($k, $i*2 + 6)->applyFromArray($left);
                        $aSheet->getStyleByColumnAndRow($k, $i*2 + 6)->getAlignment()->setWrapText(true);
                        $aSheet->getStyleByColumnAndRow($k, $i*2 + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        if($k == 8 || $k == 9) {
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
                            $aSheet->setCellValueExplicitByColumnAndRow($k, ($i*2 + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                        }
                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi2016.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));                
        }        
}

