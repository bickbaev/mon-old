<?php
require_once('/var/www/cposo/data/www/mon.cposo.ru/protected/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();

$spreadsheet->getActiveSheet()->setTitle('Проверка сайтов');

$aSheet = $spreadsheet->getActiveSheet();

$aSheet->getColumnDimension('A')->setWidth(25);
$aSheet->getColumnDimension('B')->setWidth(15);
$aSheet->getColumnDimension('C')->setWidth(20);
$aSheet->getColumnDimension('D')->setWidth(20);
$aSheet->getColumnDimension('E')->setWidth(20);
$aSheet->getColumnDimension('F')->setWidth(30);
$aSheet->getColumnDimension('G')->setWidth(15);
$aSheet->getColumnDimension('H')->setWidth(20);
$aSheet->getColumnDimension('I')->setWidth(10);
$aSheet->getColumnDimension('J')->setWidth(15);
$aSheet->getColumnDimension('K')->setWidth(20);
$aSheet->getColumnDimension('L')->setWidth(40);
$aSheet->getColumnDimension('M')->setWidth(20);
$aSheet->getColumnDimension('N')->setWidth(25);

$left = array(
    'alignment'=>array(
        'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        'vertical'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP
    ),                    
);                
$aSheet->getStyle('A2:AQ2')->getFont()->setBold(true);
$aSheet->getStyle('A2:AQ2')->getAlignment()->setWrapText(true);
$aSheet->getStyle('A2:AQ2')->applyFromArray($left);

$aSheet->getRowDimension('2')->setRowHeight(40);

$i = 1;
foreach ($pokaz as $value) {
    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
    $i = $i + 1;
}

foreach ($data as $m=>$values) { 
    $k = 1;
    foreach ($values as $value) {
        $aSheet->setCellValueByColumnAndRow($k, ($m + 3), $value);
        $aSheet->getStyleByColumnAndRow($k, ($m + 3))->getNumberFormat()->setFormatCode('@');        
        $k = $k + 1;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="site23.xlsx"');
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

