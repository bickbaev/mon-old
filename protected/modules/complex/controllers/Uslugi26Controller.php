<?php

class Uslugi26Controller extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                $report = $this->loadModel($id_rep);
                $report->status = 2;
                $report->save();                 
                //$id_est = Report::model()->findByPk($id_rep)->id_est;
                //$naim_est = Est::model()->findByPk($id_est)->est_name;
                $uslugi = Yii::app()->db->createCommand('select * from us19_res where id_report = '.$id_rep)->queryAll();
                foreach($uslugi as $k=>$usluga) {
                    $uslugi[$k]['ras'] = Yii::app()->db->createCommand('select * from uslugi2019 where id_pok = '.$usluga['id_pok'])->queryRow();
                }                
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$report->est->est_name,
                    'uslugi'=>$uslugi,
                    'god'=>$report->rep_name->dop,
                ));
            }
        }
        
        public function actionDel($id_rep, $id_usluga) {
            if($this->check_prava($id_rep)) {
                $c_t = Yii::app()->db->createCommand('select count(id_usluga) from us19_res where id_usluga = '.(int)$id_usluga)->queryScalar();
                if(!$c_t) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $res = Yii::app()->db->createCommand('delete from us19_res where id_usluga = '.$id_usluga)->execute();
                Yii::app()->user->setFlash('success', "Услуга удалена");
                $this->redirect(array('edit','id_rep'=>$id_rep));
            }
        }
        
        public function actionUpdate($id_rep, $id_usluga) {
            if($this->check_prava($id_rep)) {
                $c_t = Yii::app()->db->createCommand('select count(id_usluga) from us19_res where id_usluga = '.(int)$id_usluga)->queryScalar();
                if(!$c_t) throw new CHttpException(403,'У Вас нет необходимых прав'); 
                $model = $this->loadUsluga($id_usluga);
                $usluga = Yii::app()->db->createCommand('select * from uslugi2019 where id_pok = '.$model->id_pok)->queryRow();
                if(!sizeof($usluga)) throw new CHttpException(403,'У Вас нет необходимых прав');                
                if(isset($_POST['Us19_res']))
                {
                    $model->attributes=$_POST['Us19_res'];
                    if($model->save()) {                       
                        Yii::app()->user->setFlash('success', "Услуга обновлена");
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

        public function actionStep1($id_rep) {
            if ($this->check_prava($id_rep)) {
                $types = Yii::app()->db->createCommand('select * from uslugi19_type')->queryAll();
                $this->render('step1', array(
                    'types'=> $types,
                    'id_rep'=> $id_rep,
                ));                
            }
        }
        
        public function actionStep2($id_rep, $type) {
            if ($this->check_prava($id_rep)) {
                $type = (int)$type;
                $c_t = Yii::app()->db->createCommand('select count(id_type) from uslugi19_type where id_type = '.$type)->queryScalar();
                if(!$c_t) throw new CHttpException(403,'У Вас нет необходимых прав');
                $formas = Yii::app()->db->createCommand('select uslugi19_forma.id_forma as id_forma, uslugi19_forma.naim_forma as naim_forma from uslugi2019, uslugi19_forma where uslugi2019.forma=uslugi19_forma.id_forma and uslugi2019.type = '.$type.' group by uslugi19_forma.naim_forma order by uslugi19_forma.id_forma')->queryAll();
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
                $uslugi = Yii::app()->db->createCommand('select * from uslugi2019 where type = '.$type.' and forma = '.$forma)->queryAll();
                if(!sizeof($uslugi)) throw new CHttpException(403,'У Вас нет необходимых прав');                
                $this->render('step3', array(
                    'uslugi'=> $uslugi,
                    'id_rep'=> $id_rep,
                ));                
            }
        }
        
        public function actionAdd($id_rep, $id_pok) {
            if ($this->check_prava($id_rep)) {
                $report = $this->loadModel($id_rep);
                $id_pok = (int)$id_pok;
                $usluga = Yii::app()->db->createCommand('select * from uslugi2019 where id_pok = '.$id_pok)->queryRow();
                if(!sizeof($usluga)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $model = new Us19_res;
                if(isset($_POST['Us19_res']))
                {
                    $model->attributes=$_POST['Us19_res'];
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
                    'god'=>$report->rep_name->dop,
                ));                
            }            
        }
        
        public function actionExcel($id_rep) {
                $this->check_prava($id_rep);
                $god = $this->loadModel($id_rep)->rep_name->dop;
                $otchet = Yii::app()->db->createCommand('select rep_name.rep_name, DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();                            
                if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'].'. Сформирован по состоянию на '.date('d.m.Y H:i');
                $nazv = 'Перечень государственных услуг и работ';
                
                $poks = Yii::app()->db->createCommand('select id_pok from us19_res where id_report='.$id_rep)->queryColumn(); 
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
                        from uslugi2019, us19_res where
                        uslugi2019.id_pok = us19_res.id_pok
                        and us19_res.id_report = '.$id_rep.'
                        and uslugi2019.id_pok = '.$pok)->queryAll();
                        $itog[$m] = $cols[0];
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
                                
                //рисуем заголовок таблицы
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
                
                $aSheet->setCellValue('M5','на 01.01.'.$god); 
                $aSheet->getStyle('M5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('N5','на 01.09.'.$god); 
                $aSheet->getStyle('N5')->applyFromArray($border);  
                
                $aSheet->setCellValue('O5','на 01.01.'.($god+1)); 
                $aSheet->getStyle('O5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('P5','на 01.09.'.($god+1)); 
                $aSheet->getStyle('P5')->applyFromArray($border); 

                $aSheet->setCellValue('Q5','на 01.01.'.($god+2)); 
                $aSheet->getStyle('Q5')->applyFromArray($border);                 
                
                $aSheet->setCellValue('R5','на 01.09.'.($god+2)); 
                $aSheet->getStyle('R5')->applyFromArray($border);                 
                
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $f=>$value) {

                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($border);

                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->applyFromArray($left);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getAlignment()->setWrapText(true);
                        $aSheet->getStyleByColumnAndRow($k, $i + 6)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                        $aSheet->setCellValueExplicitByColumnAndRow($k, ($i + 6), $value, PHPExcel_Cell_DataType::TYPE_STRING);

                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="uslugi.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));               
        }         
        
        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        } 

        protected function loadUsluga($id_usluga)
        {
            $model= Us19_res::model()->findByPk((int)$id_usluga);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }         
        
        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type, rep_name.id_rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }
}        




