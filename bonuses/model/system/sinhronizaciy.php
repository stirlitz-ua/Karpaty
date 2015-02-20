<?php


if (isset($_FILES['uploadfile']['tmp_name']) && $_FILES['uploadfile']['tmp_name']!=='') {
	if (isset($_POST['xml_download']) && $_POST['xml_download']=="Загрузить"  ) {
		//$uploaddir = "./xml/";
		$uploaddir = "../1c/";
		$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
		copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
	}
 } elseif (isset($_POST['xml_download']) && $_POST['xml_download']=="Загрузить"  && isset($_FILES['uploadfile']['tmp_name']) && $_FILES['uploadfile']['tmp_name']=='') {
	?>
		<script type="text/javascript">
			alert( "Файл не выбран!");
		</script> 
	<?
 }
	
$dir = $_SERVER['DOCUMENT_ROOT']."/1c/";
$files = scandir($dir);
if (is_dir($dir)) {
	
	for ($j= 0; $j < count($files); $j++) {
		if (($files[$j] == '.') || ($files[$j] == '..')) continue;
	
		$db=new mysql_conns ();	
		
		$array = explode('.', $files[$j]);
		$files_xmls = end($array);
		
		if ($files_xmls=='XML'  || $files_xmls=='xml') {
			$xml=simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/1c/'.$files[$j]);
			if ($files[$j]{0}=='F') {
				for ($i = 0; $i < count($xml); $i++) {
					
					// Зробити перевірку чи існує в базі documents.DocumentNumber документ з таким $xml->Document[$i]->DocumentHeader->DocumentNumber
					//Додавати лише якщо такого документу немає
					// В наступних двох інсертах - теж
					
					$db->my_mysql_select ('INSERT INTO documents (DocumentType, DocumentNumber, DocumentPeriod, 
					DocumentPeriodClose, Zayavka, ZayavkaPeriod, CustomerCode, 	CustomerName, Recommendations, VIN, Brand, Model,
					RegistrationNumber, CardNumber, TypeOfBonus, SumDocument, NumberOfPoints, Status, Probeg 
						) VALUES (
					"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentType).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentNumber).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentPeriod).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentPeriodClose).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Zayavka).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->ZayavkaPeriod).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->CustomerCode).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->CustomerName).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Recommendations).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->VIN).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Brand).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Model).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->RegistrationNumber).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->CardNumber).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->TypeOfBonus).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->SumDocument).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->NumberOfPoints).'" , 
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Status).'"  
					"'.htmlentities($xml->Document[$i]->DocumentHeader->Probeg).'"  
					)  '); 			



					for ($g= 0; $g < count($xml->Document[$i]->TableGoods->RowGoods); $g++) {
						$db->my_mysql_select (' INSERT INTO TableGoods ( DocumentNumber , RowNumber , TransactionType , 
						Code ,  Name , OriginalCipher , 	UnitOfMeasurement , Amount , PriceWithouTax , PriceWithTax , SumWithouTax ,
						SumWithTax , 	SumTax , Discount , AmoutOfDiscount , PriceWithouTaxWithouDiscount , PriceWithTaxWithouDiscount

							) VALUES (
						"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentNumber).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->RowNumber).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->TransactionType).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->Code).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->Name).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->OriginalCipher).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->UnitOfMeasurement).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->Amount).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->PriceWithouTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->PriceWithTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->SumWithouTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->SumWithTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->SumTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->Discount).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->AmoutOfDiscount).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->PriceWithouTaxWithouDiscount).'" , 
						"'.htmlentities($xml->Document[$i]->TableGoods->RowGoods[$g]->PriceWithTaxWithouDiscount).'"  )  '); 		

					}

					for ($p= 0; $p < count($xml->Document[$i]->TableWork->RowWork); $p++) {
						$db->my_mysql_select (' INSERT INTO TableWork ( DocumentNumber , RowNumber , TransactionType , 
						Code ,  Name , OriginalCipher , 	UnitOfMeasurement , Amount , PriceWithouTax , PriceWithTax , SumWithouTax ,
						SumWithTax , 	SumTax , Discount , AmoutOfDiscount , PriceWithouTaxWithouDiscount , PriceWithTaxWithouDiscount

							) VALUES (
						"'.htmlentities($xml->Document[$i]->DocumentHeader->DocumentNumber).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->RowNumber).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->TransactionType).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->Code).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->Name).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->OriginalCipher).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->UnitOfMeasurement).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->Amount).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->PriceWithouTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->PriceWithTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->SumWithouTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->SumWithTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->SumTax).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->Discount).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->AmoutOfDiscount).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->PriceWithouTaxWithouDiscount).'" , 
						"'.htmlentities($xml->Document[$i]->TableWork->RowWork[$p]->PriceWithTaxWithouDiscount).'"  )  '); 		

					}
				}
	?>
				<script type="text/javascript">
					console.log( "Файл "+<?=$files[$j]?>+" синхронизирован!");
				</script> <?
				unlink($_SERVER['DOCUMENT_ROOT'].'/1c/'.$files[$j]);
			} else {
	?>
				<script type="text/javascript">
					console.log( "Имя файла не подходит!");
				</script> <?									

			} 
  
		} else {					
			?> <script type="text/javascript">
				console.log( "Файл не .xml");
			</script> <?  
		}

	}
}



?>