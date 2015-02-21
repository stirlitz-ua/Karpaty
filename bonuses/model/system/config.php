<?php 
             // подключение к базе данных черед PDO
	class mysql_conns { 
		var  $query_number = 0;  //количество запросов
		var  $query_time = 0;  //  время затраченое на обращение в БД
		var  $colmns = 0;
		
		private function conn() {
			$conn = array();
			$conn['1'] = 'mysql:host=localhost;dbname=karpatya_bonuses';
			$conn['2'] = 'karpatya_bonuses';
			$conn['3']= 'R+;yyJR@6Nr+';
			return $conn;
		}
		
		public function my_mysql_select ($sql){
			$conn = $this->conn();
			$result = array();
			try {
				$start = microtime(true);  //  текущее время перед  выполнением скрипта 
				$dbh = new PDO($conn['1'] , $conn['2'], $conn['3']);   // подключение к базе 
				$dbh->query('set names utf8');  // установка кодировки 
				$query_array = $dbh->prepare($sql); // соединение с базой
				$query_array ->execute(); // 
				$this->colmns = $query_array->rowCount(); // вывод количества строк
				$result = $query_array->fetchAll(); // получаем результат (асоциативный масив)
				$dbh = null;                                // убиваем объект
				$this->query_time += microtime(true) - $start;    // конечно время 
				$this->query_number++;   // количество запросов в базу 
			} 
			catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
			return $result;
		}

	}
	
?>