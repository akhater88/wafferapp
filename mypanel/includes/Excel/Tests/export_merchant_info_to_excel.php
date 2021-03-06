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
//$objPHPExcel->setActiveSheetIndex(0)
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'A1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Company Name');
foreach($_SESSION['Merchant_Company_Name'] as $value)
	{
			$Cell_Number = 'A'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'B1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Country');
foreach($_SESSION['Merchant_Country_Name'] as $value)
	{
			$Cell_Number = 'B'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'C1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Full Name');
foreach($_SESSION['Merchant_Name'] as $value)
	{
			$Cell_Number = 'C'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'D1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Phone Number');
foreach($_SESSION['Merchant_Phone_Number'] as $value)
	{
			$Cell_Number = 'D'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'E1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Mobile Number');
foreach($_SESSION['Merchant_Cell_Number'] as $value)
	{
			$Cell_Number = 'E'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
$Counter = 2;
$Title_Counter = 1;
$Cell_Number = 'F1';
			$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue($Cell_Number,'Contact Email');
foreach($_SESSION['Merchant_Contact_Email'] as $value)
	{
			$Cell_Number = 'F'.$Counter;
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($Cell_Number,$value);
			$Counter++;
			$Title_Counter++;
	}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Mobile');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
$File_Name = date('Ymd').time().'.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$File_Name.'"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
