<?php
require_once('/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpspreadsheet/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();

$spreadsheet->getActiveSheet()->setTitle('ДОО_0_3');

$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $zag);
$spreadsheet->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);

$aSheet = $spreadsheet->getActiveSheet();

$aSheet->getColumnDimension('A')->setWidth(40);
$aSheet->getColumnDimension('B')->setWidth(40);
$aSheet->getColumnDimension('C')->setWidth(25);
$aSheet->getColumnDimension('D')->setWidth(25);
$aSheet->getColumnDimension('E')->setWidth(25);
$aSheet->getColumnDimension('F')->setWidth(25);
$aSheet->getColumnDimension('G')->setWidth(25);
$aSheet->getColumnDimension('H')->setWidth(25);
$aSheet->getColumnDimension('I')->setWidth(25);
$aSheet->getColumnDimension('J')->setWidth(25);
$aSheet->getColumnDimension('T')->setWidth(50);


$left = array(
    'alignment'=>array(
        'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        'vertical'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP
    ),                    
);                
$aSheet->getStyle('A2:T2')->getFont()->setBold(true);
$aSheet->getStyle('A2:T2')->getAlignment()->setWrapText(true);
$aSheet->getStyle('A2:T2')->applyFromArray($left);

$aSheet->getRowDimension('2')->setRowHeight(140);

$i = 1;
foreach ($pokaz as $value) {                
    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
    $i = $i + 1;
}
foreach ($data as $m=>$values) { 
    $k = 1;
    foreach ($values as $value) {
        $aSheet->setCellValueByColumnAndRow($k, ($m + 3), $value);
        $k = $k + 1;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="excel_mun.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
