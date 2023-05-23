<?php
//echo($_SERVER['SCRIPT_FILENAME']);
session_start();


//untuk date mula hingga akhir


/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2010 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.4, 2010-08-26
 */

/** Error reporting */
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

date_default_timezone_set('Europe/London');

/** PHPExcel */
//require_once '../report/laporan_invoice_detail.php';
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory */
require_once 'Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator($nama_masjid)
->setLastModifiedBy($nama_masjid)
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("SistemPengurusanMasjid")
->setKeywords("office 2007 openxml php")
->setCategory("Documents");

// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B1', $nama_masjid);
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Senarai Ahli Mempunyai OKU');
//setting Font Style
$styleFont = array(
      'font' => array(
            'bold'      => true,
            'name'		=> 'arial',
            'size'		=> '10'
      ),
);

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleFont);
$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($styleFont);


//style font for desc
$styleFont2 = array(
      'font' => array(
            'name'		=> 'arial',
            'size'		=> '10'
      ),
);


//table list
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'No');
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Nama');
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'No.IC');
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'No.Telefon');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Jenis OKU');
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Keterangan');



// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);


//alignment header
$objPHPExcel->getActiveSheet()->getStyle("B5:H5")->applyFromArray(
      array(
            'font'    => array(
                  'bold'      => true,
                  'name'		=> 'arial',
                  'size'		=> '8'
            ),
            'alignment' => array(
                  'wraptext' => true,
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                  'allborders'     => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
            ),
            'fill' => array(
                  'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                  'startcolor' => array(
                        'argb' => 'CCCCCC'
                  )
            )
      )
      );

//row height
$objPHPExcel->getActiveSheet()->getRowDimension("5")->setRowHeight(62);
$objPHPExcel->getActiveSheet()->getStyle('B5:H5')->getAlignment()->setWrapText(true);

//table list
//$view_tblb4 = view_award("$_GET[form]",'1',$codes);
//$currentYear= get_setting();


$sqll="select a.id_oku,b.id_data,b.nama_penuh,b.no_ic,b.no_hp,a.jenis_oku,a.keterangan,a.id_masjid from sej6x_data_oku a
      inner join sej6x_data_peribadi b on a.no_kp=b.no_ic
      where a.id_masjid='$id_masjid'
      union ALL
      select c.id_oku,c.id_data,d.nama_penuh,d.no_ic,d.no_tel as no_hp,c.jenis_oku,c.keterangan,c.id_masjid from sej6x_data_oku c
      inner join sej6x_data_anakqariah d on c.no_kp=d.no_ic
      where c.id_masjid='$id_masjid'";

$sqlqueryl = mysql_query($sqll, $bd) or die ("Error :".mysql_error($bd));

$cnt=0;
$noindex = 5;
while($listl = mysql_fetch_assoc($sqlqueryl)){
   $cnt++;
   $noindex++;
   $objPHPExcel->getActiveSheet()->setCellValue("B$noindex", $cnt);
   $objPHPExcel->getActiveSheet()->setCellValue("C$noindex", $listl['nama_penuh']);
   $objPHPExcel->getActiveSheet()->setCellValue("D$noindex", $listl['no_ic']);
   $objPHPExcel->getActiveSheet()->setCellValue("E$noindex", $listl['no_hp']);
   $objPHPExcel->getActiveSheet()->setCellValue("F$noindex", $listl['jenis_oku']);
   $objPHPExcel->getActiveSheet()->setCellValue("G$noindex", $listl['keterangan']);
   
}


//alignment list
$tindex = $cnt + 5;
$objPHPExcel->getActiveSheet()->getStyle("B6:H$tindex")->applyFromArray(
      array(
            'font'    => array(
                  'name'		=> 'arial',
                  'size'		=> '8'
            ),
            'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                  'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
            ),
            'borders' => array(
                  'allborders'     => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
            )
      )
      );
$objPHPExcel->getActiveSheet()->getStyle("B6:H$tindex")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("D6:D$tindex")->getNumberFormat()->setFormatCode()->setFormatCode('#');


//horinzontal/vetical
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(75);

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Document');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

file_exists('output/'.$kod_masjid);
if(file_exists==0)
{
   mkdir('output/'.$kod_masjid);
}
// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('output/'.$kod_masjid.'/LaporanSenaraiOku.xlsx');

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
//echo'save';
?>