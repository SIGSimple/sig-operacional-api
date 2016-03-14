<?php
class Conexao{
	private static $pdo ;

	public static function getInstance() {
		if (!isset(self::$pdo)) {
			$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
			$limit = 10;
			$counter = 0;

			while (true) {
				try {
					self::$pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD, $opcoes);
					self::$pdo->exec( "SET CHARACTER SET utf8" );
					self::$pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
					self::$pdo->setAttribute( PDO::ATTR_PERSISTENT, true );
					break;
				}
				catch (PDOException $e) {
					$db = null;
					$counter++;
					if ($counter == $limit)
						throw new PDOException($e);
				}
			}
		}

		return self::$pdo;
	}

}
?>
