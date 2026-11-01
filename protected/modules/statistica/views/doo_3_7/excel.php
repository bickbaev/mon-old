<?php
require_once('/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpspreadsheet/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$spreadsheet = new Spreadsheet();

$tmpl = \PhpOffice\PhpSpreadsheet\IOFactory::load('/var/www/cposo/data/www/mon.cposo.ru/protected/modules/statistica/views/doo_3_7/obl2.xlsx');
$sheet = clone $tmpl->getActiveSheet();
$spreadsheet->addExternalSheet($sheet);
$spreadsheet->removeSheetByIndex(0);
unset($tmpl);

$aSheet = $spreadsheet->setActiveSheetIndex(0);
if(!$okr) {
    $spreadsheet->getActiveSheet()->setTitle('Область');
    $name = 'Область';
}
else {
    $spreadsheet->getActiveSheet()->setTitle($okr);
    $name = $okr;
}
$k = 0;
foreach($data as $item) {
    if(in_array($k, array(1, 4))) {
        $k = $k + 1;
        $aSheet->setCellValueByColumnAndRow(4, $k + 4, $item);
    }
    $aSheet->setCellValueByColumnAndRow(4, $k + 4, $item);
    $k = $k + 1;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.date('m', strtotime($f_date)).'-'.$name.'.xlsx"');
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