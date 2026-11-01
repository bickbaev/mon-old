<?php

class Dou_inetController extends Controller
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
                'accessControl + index, dou_inet_excel'
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
                $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionDou_inet_excel() {
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
                            dou_inet.naim_ur as naim_ur,
                            dou_inet.adrress_ur as adrress_ur,
                            dou_inet.inet_ur as inet_ur,
                            dou_inet.naim_fil as naim_fil,
                            dou_inet.address_fil as address_fil,
                            dou_inet.inet_fil as inet_fil,
                            dou_inet.inet_fact as inet_fact,
                            dou_inet.prov as prov,
                            dou_inet.tech as tech,
                            dou_inet.tariff as tariff,
                            dou_inet.speed as speed,
                            dou_inet.cost_obor as cost_obor,
                            dou_inet.cost_rab as cost_rab,
                            dou_inet.cost_all as cost_all,
                            dou_inet.cost_month as cost_month,
                            dou_inet.itog_year as itog_year
                            from dou_inet, report, est where
                            dou_inet.id_report = report.id_report
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
                            dou_inet.naim_ur as naim_ur,
                            dou_inet.adrress_ur as adrress_ur,
                            dou_inet.inet_ur as inet_ur,
                            dou_inet.naim_fil as naim_fil,
                            dou_inet.address_fil as address_fil,
                            dou_inet.inet_fil as inet_fil,
                            dou_inet.inet_fact as inet_fact,
                            dou_inet.prov as prov,
                            dou_inet.tech as tech,
                            dou_inet.tariff as tariff,
                            dou_inet.speed as speed,
                            dou_inet.cost_obor as cost_obor,
                            dou_inet.cost_rab as cost_rab,
                            dou_inet.cost_all as cost_all,
                            dou_inet.cost_month as cost_month,
                            dou_inet.itog_year as itog_year
                            from dou_inet, report, est where
                            dou_inet.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                $pokaz = Dou_inet::model()->attributeLabels();
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
                $aSheet->setTitle('ДОУ-интернет');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(75);
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $aSheet->getStyle('A2:S2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="dou_internet.xls"');
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