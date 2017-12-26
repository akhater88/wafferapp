<?php
session_start();
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', "الـبـريـد الإلـكـتـرونــي")
			->setCellValue('B1', "رقـم الـجـوال")
			->setCellValue('C1', "رقـم الـهـاتف")
			->setCellValue('D1', "الإســم");

// Add data
$i = 2;
$Counter = 0;
foreach($_SESSION['Name'] as $Value) {
$Phone = $_SESSION['Phone'][$Counter];
$Mobile = $_SESSION['Mobile'][$Counter];
$Email = $_SESSION['Email'][$Counter];
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A' . $i, $Email)
	->setCellValue('B' . $i, $Mobile)
	->setCellValue('C' . $i, $Phone)
	->setCellValue('D' . $i, $Value);

	$Counter++;
	$i++;
}
// Rename sheet
$Sheet_Name = date('d-m-Y').'_'.time();
$objPHPExcel->getActiveSheet()->setTitle($Sheet_Name);
$File_Name = $Sheet_Name.'.xls';

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$File_Name.'"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>