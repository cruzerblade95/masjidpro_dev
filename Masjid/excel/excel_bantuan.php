<?php
//echo($_SERVER['SCRIPT_FILENAME']);
include('../connection/connection.php');


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
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Rekod Bantuan');
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
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'No K/P | No Passport');
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Kariah Masjid');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'No Telefon');
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Status Perkahwinan');
$objPHPExcel->getActiveSheet()->setCellValue('H5', 'Alamat');
$objPHPExcel->getActiveSheet()->setCellValue('I5', 'Jumlah Tanggungan');
$objPHPExcel->getActiveSheet()->setCellValue('J5', 'Jenis Bantuan');
$objPHPExcel->getActiveSheet()->setCellValue('K5', 'Tarikh Bantuan');
$objPHPExcel->getActiveSheet()->setCellValue('L5', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('M5', 'Status Pekerjaan');
$objPHPExcel->getActiveSheet()->setCellValue('N5', 'Tujuan Permohonan');
$objPHPExcel->getActiveSheet()->setCellValue('O5', 'Status Ambil');
$objPHPExcel->getActiveSheet()->setCellValue('P5', 'Tarikh Ambil');
$objPHPExcel->getActiveSheet()->setCellValue('Q5', 'Kaedah Pembayaran');
$objPHPExcel->getActiveSheet()->setCellValue('R5', 'Amaun(RM)/Item Bantuan');


// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);


//alignment header
$objPHPExcel->getActiveSheet()->getStyle("B5:R5")->applyFromArray(
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
$objPHPExcel->getActiveSheet()->getStyle('B5:R5')->getAlignment()->setWrapText(true);

//table list
//$view_tblb4 = view_award("$_GET[form]",'1',$codes);
//$currentYear= get_setting();

						  
$sql_excel = "SELECT * FROM bantuan_zakat WHERE id_masjid='$id_masjid' AND status_bantuan=1 ORDER BY id_bantuan ASC";
$query_excel = mysqli_query($bd2,$sql_excel) or die ("Error :".mysqli_error($bd2));

$cnt=0;
$noindex = 5;
while($list = mysqli_fetch_assoc($query_excel)){
	
		if($list['id_data']==NULL){
			
			//Check IC @ Passport
			if($list['no_ic']!=NULL)
			{
				$ic_passport = $list['no_ic'];
			}
			else if($list['no_passport']!=NULL)
			{
				$ic_passport = $list['no_passport'];
			}
			
			//Diplay Masjid
			$idkariah_masjid = $list['kariah_masjid'];
			
			$sqlkariah = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$idkariah_masjid'";
			$querykariah = mysqli_query($bd2,$sqlkariah);
			$datakariah = mysqli_fetch_array($querykariah);
			
			//Status Perkahwinan
			if($list['status_perkahwinan']==1)
			{
				$status_perkahwinan = "BUJANG";
			}
			else if($list['status_perkahwinan']==2)
			{
				$status_perkahwinan = "BERKAHWIN";
			}
			else if($list['status_perkahwinan']==3)
			{
				$status_perkahwinan = "DUDA";
			}
			else if($list['status_perkahwinan']==4)
			{
				$status_perkahwinan = "JANDA";
			}
			
			//Display Negeri
			$idnegeri = $list['id_negeri'];
			$sqlnegeri = "SELECT * FROM negeri WHERE id_negeri='$idnegeri'";
			$querynegeri = mysqli_query($bd2,$sqlnegeri);
			$negeri = mysqli_fetch_array($querynegeri);
			
			//Display Daerah
			$iddaerah = $list['id_daerah'];
			$sqldaerah = "SELECT * FROM daerah WHERE id_daerah='$iddaerah'";
			$querydaerah = mysqli_query($bd2,$sqldaerah);
			$daerah = mysqli_fetch_array($querydaerah);
			
			$alamat = $list['alamat_terkini'].",".$list['poskod']." ".$daerah['nama_daerah'].",".$negeri['name'];
			
			//Status Bantuan
			$status = "BANTUAN LULUS";
			
			$cnt++;
			$noindex++;
			$objPHPExcel->getActiveSheet()->setCellValue("B$noindex", $cnt);
			$objPHPExcel->getActiveSheet()->setCellValue("C$noindex", $list['nama_penuh']);
			$objPHPExcel->getActiveSheet()->setCellValue("D$noindex", $ic_passport);
			$objPHPExcel->getActiveSheet()->setCellValue("E$noindex", $datakariah['nama_masjid']);
			$objPHPExcel->getActiveSheet()->setCellValue("F$noindex", $list['no_tel']);
			$objPHPExcel->getActiveSheet()->setCellValue("G$noindex", $status_perkahwinan);
			$objPHPExcel->getActiveSheet()->setCellValue("H$noindex", $alamat);
			$objPHPExcel->getActiveSheet()->setCellValue("I$noindex", $list['jumlah_tanggungan']);
			$objPHPExcel->getActiveSheet()->setCellValue("J$noindex", $list['jenis_bantuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("K$noindex", $list['tarikh_bantuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("L$noindex", $status);
			$objPHPExcel->getActiveSheet()->setCellValue("M$noindex", $list['status_kerja']);
			$objPHPExcel->getActiveSheet()->setCellValue("N$noindex", $list['tujuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("O$noindex", $list['status_ambil']);
			$objPHPExcel->getActiveSheet()->setCellValue("P$noindex", $list['tarikh_ambil']);
			$objPHPExcel->getActiveSheet()->setCellValue("Q$noindex", $list['kaedah_bayar']);
			$objPHPExcel->getActiveSheet()->setCellValue("R$noindex", $list['amaun']);
		}
		else if($list['id_data']!=NULL)
		{
			$iddata = $list['id_data'];
			
			$sql_id = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$iddata'";
			$query_id = mysqli_query($bd2,$sql_id);
			$data_id = mysqli_fetch_array($query_id);
			
			//Diplay Masjid
			$idkariah_masjid = $data_id['id_masjid'];
			
			$sqlkariah = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$idkariah_masjid'";
			$querykariah = mysqli_query($bd2,$sqlkariah);
			$datakariah = mysqli_fetch_array($querykariah);
			
			//Status Perkahwinan
			if($data_id['status_perkahwinan']==1)
			{
				$status_perkahwinan = "BUJANG";
			}
			else if($data_id['status_perkahwinan']==2)
			{
				$status_perkahwinan = "BERKAHWIN";
			}
			else if($data_id['status_perkahwinan']==3)
			{
				$status_perkahwinan = "DUDA";
			}
			else if($data_id['status_perkahwinan']==4)
			{
				$status_perkahwinan = "JANDA";
			}
			
			//Display Negeri
			$idnegeri = $data_id['id_negeri'];
			$sqlnegeri = "SELECT * FROM negeri WHERE id_negeri='$idnegeri'";
			$querynegeri = mysqli_query($bd2,$sqlnegeri);
			$negeri = mysqli_fetch_array($querynegeri);
			
			//Display Daerah
			$iddaerah = $data_id['id_daerah'];
			$sqldaerah = "SELECT * FROM daerah WHERE id_daerah='$iddaerah'";
			$querydaerah = mysqli_query($bd2,$sqldaerah);
			$daerah = mysqli_fetch_array($querydaerah);
			
			$alamat = $data_id['alamat_terkini'].",".$data_id['poskod']." ".$daerah['nama_daerah'].",".$negeri['name'];
			
			//Display Jumlah Tanggungan
			$sqljumlah = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$iddata'";
			$queryjumlah = mysqli_query($bd2,$sqljumlah);
			$jumlah_tanggungan = mysqli_num_rows($queryjumlah);
			
			//Status Bantuan
			$status = "BANTUAN LULUS";
			
			$cnt++;
			$noindex++;
			$objPHPExcel->getActiveSheet()->setCellValue("B$noindex", $cnt);
			$objPHPExcel->getActiveSheet()->setCellValue("C$noindex", $data_id['nama_penuh']);
			$objPHPExcel->getActiveSheet()->setCellValue("D$noindex", $data_id['no_ic']);
			$objPHPExcel->getActiveSheet()->setCellValue("E$noindex", $datakariah['nama_masjid']);
			$objPHPExcel->getActiveSheet()->setCellValue("F$noindex", $data_id['no_hp']);
			$objPHPExcel->getActiveSheet()->setCellValue("G$noindex", $status_perkahwinan);
			$objPHPExcel->getActiveSheet()->setCellValue("H$noindex", $alamat);
			$objPHPExcel->getActiveSheet()->setCellValue("I$noindex", $jumlah_tanggungan);
			$objPHPExcel->getActiveSheet()->setCellValue("J$noindex", $list['jenis_bantuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("K$noindex", $list['tarikh_bantuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("L$noindex", $status);
			$objPHPExcel->getActiveSheet()->setCellValue("M$noindex", $list['status_kerja']);
			$objPHPExcel->getActiveSheet()->setCellValue("N$noindex", $list['tujuan']);
			$objPHPExcel->getActiveSheet()->setCellValue("O$noindex", $list['status_ambil']);
			$objPHPExcel->getActiveSheet()->setCellValue("P$noindex", $list['tarikh_ambil']);
			$objPHPExcel->getActiveSheet()->setCellValue("Q$noindex", $list['kaedah_bayar']);
			$objPHPExcel->getActiveSheet()->setCellValue("R$noindex", $list['amaun']);
		}
	}


//alignment list
$tindex = $cnt + 5;
$objPHPExcel->getActiveSheet()->getStyle("B6:R$tindex")->applyFromArray(
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
$objPHPExcel->getActiveSheet()->getStyle("B6:R$tindex")->getAlignment()->setWrapText(true);


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
$objWriter->save('output/'.$kod_masjid.'/RekodBantuan.xlsx');

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";	
//echo'save';
?>