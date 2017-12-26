<?php

include "PHPExcel.php";

include "PHPExcel/Writer/Excel2007.php";

$excel = new PHPExcel;

$excel->getProperties()->setCreator('Jan Polzer');

$excel->getProperties()->setLastModifiedBy('Jan Polzer');

$excel->getProperties()->setTitle('Registered users list');

$excel->removeSheetByIndex(0);

$cols = array('user' => 'A', 'e-mail' => 'B');

$list = $excel->createSheet();

$list->setTitle('Users');

$list->getColumnDimension('A')->setWidth(30);

$list->getColumnDimension('B')->setWidth(20);

$list->setCellValue('A1', 'User');

$list->setCellValue('B1', 'E-mail');

/*if (!$conn = mysql_connect('localhost', 'username', 'password')):

  print 'Database connection has failed';

  exit;

endif;

if (!mysql_select_db('database_name', $conn)):

  print 'Database selection has failed';

  exit;

endif;

$sql = 'SELECT * FROM users';

$data = mysql_query($sql, $conn);

if (!$data):

  print 'SQL syntax error.\n' . mysql_error();

  exit;

endif;

$rowcounter = 2;

while ($row = mysql_fetch_assoc($data)){

  $list->setCellValue('A'.$rowcounter, $row['name']);

  $list->setCellValue('B'.$rowcounter, $row['mail']);

  $rowcounter++;

}
*/
$writer = new PHPExcel_Writer_Excel2007($excel);

$writer->save('./users.xlsx');

print 'Users list has been exported.';

?>