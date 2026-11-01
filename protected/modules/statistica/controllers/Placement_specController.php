<?php

class Placement_specController extends Controller
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
                'accessControl + index'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($id_rep_type)
	{
            $otchet = $this->otchet((int)$id_rep_type);
            $this->render('index2', array('otchet' => $otchet));
        }
        
        public function actionExcel($id_rep_type) {
                $otchet = $this->otchet((int)$id_rep_type);
                if(Yii::app()->session['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');            
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();;
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select '
                        . 'placement_spec.id_spec, est.id_okr, est.id_raion, est.est_name, placement_spec.id_po, po_new.naim_po, placement_spec.p_in, placement_spec.p_out '
                        . 'from placement_spec, report, est, po_new '
                        . 'where placement_spec.id_report = report.id_report and report.id_est = est.id_est and placement_spec.id_po = po_new.id_po and report.id_rep_type ='.$id_rep_type
                        . ' order by est.id_okr, est.id_raion, est.est_name');
                $data = $command->queryAll(); 
                $rab = array(
                    '1' => 'АО "РКЦ "Прогресс"', 
                    '2' => 'ОАО "Кузнецов"', 
                    '3' => 'ОАО "Салют"',
                    '4' => 'ОАО "Авиакор – авиационный завод"',
                    '5' => 'ОАО "Агрегат"',
                    '6' => 'ОАО "АвтоВАЗ"',
                    '7' => 'другой работодатель',
                );                
                $m = 0;
                for($i = 0; $i < sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $orgs = Yii::app()->db->createCommand('select p_out, id_est, est, prik from placement_org where id_spec = '.$data[$i]['id_spec'])->queryAll();
                    //print_r($orgs);
                    foreach($orgs as $k => $org) {
                        $itog[$m]['id_okr'] = $data[$i]['id_okr'];
                        $itog[$m]['id_raion'] = $data[$i]['id_raion'];
                        $itog[$m]['est_name'] = $data[$i]['est_name'];
                        $itog[$m]['id_po'] = $data[$i]['id_po'];
                        $itog[$m]['naim_po'] = $data[$i]['naim_po'];
                        $itog[$m]['p_in'] = $data[$i]['p_in'];
                        $itog[$m]['p_out'] = $data[$i]['p_out'];
                        $itog[$m]['p_out_org'] = $org['p_out'];
                        $itog[$m]['id_est'] = $rab[$org['id_est']];
                        $itog[$m]['est'] = $org['est'];
                        $itog[$m]['prik'] = $org['prik'];                           
                        $m = $m + 1;
                    }
                }
                $pokaz = array('id_okr' => 'Управление',
                        'id_raion' => 'Муниципалитет',
                        'est_name' => 'Учреждение',
                        'id_po' => 'Код профессии/специальности',
                        'naim_po' => 'Наименование профессии/специальности',
                        'p_in' => 'Принято на обучение',
                        'p_out' => 'Выпущено',
                        'p_out_org' => 'Принято на работу в организацию',
                        'id_est' => 'Работодатель',
                        'est' => 'Наименование иного работодателя',
                        'prik' => 'Подтверждение о приеме на работу',); 
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                //print_r($itog);
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
                $aSheet->setTitle('Трудоустройство выпускников УПО');
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
                $aSheet->getColumnDimension('E')->setWidth(25);
                $aSheet->getColumnDimension('I')->setWidth(25);
                $aSheet->getColumnDimension('J')->setWidth(25);
                $aSheet->getColumnDimension('K')->setWidth(25);  
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $value) {
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="placement.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        } 
        
        protected function otchet($id_rep_type) {
                $command = Yii::app()->db->createCommand('select id_rep_type, rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.(int)$id_rep_type);
                $otchet = $command->queryRow();
                if(!$otchet['rep_name']) throw new CHttpException(403,'У Вас нет необходимых прав');
                return $otchet;
        }        
        
}        
