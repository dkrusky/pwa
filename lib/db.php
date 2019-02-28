<?php
class DB {
	private $stmt;
	private $dbh;
	public $error;
	private $options;


	public function __construct() {
		$this->options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		$this->connect();
	}

	public function disconnect() {
        $this->error = null;
        $this->stmt = null;
        $this->dbh = null;
	}

	public function connect() {
        $this->disconnect();
		try {
		    $mode = (LIVE === false) ? 'test' : 'live';
  			$settings = parse_ini_file(realpath( __DIR__ . '/../settings/') . '/database-' . $mode . '.ini');

			$this->stmt = null;
			$this->dbh = null;

			$this->dbh = new PDO(
				$settings['dsn'],
				$settings['user'],
				$settings['pass'],
				$this->options
			);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query, ?string $prefix) {
        $sql = '';
        if(!empty($prefix)) {
    	    $sql = str_replace('`#', '`' . $prefix . '_', $query);
        } else {
    	    $sql = str_replace('`#', '`' . APPNAME . '_', $query);
        }
		$this->stmt = $this->dbh->prepare($sql);
	}

	public function bind($param, $value, $type = null) {
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute() {
		return $this->stmt->execute();
	}

    public function bindColumnFetch(int $name) {
		$this->execute();
        $this->stmt->bindColumn($name, $blob, PDO::PARAM_LOB);
		$result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $blob;
    }

	public function resultset() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function single() {
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowCount() {
		return $this->stmt->rowCount();
	}

	public function lastInsertId() {
		return $this->dbh->lastInsertId();
	}

	public function beginTransaction() {
		return $this->dbh->beginTransaction();
	}

	public function endTransaction() {
		return $this->dbh->commit();
	}

	public function cancelTransaction() {
		return $this->dbh->rollBack();
	}

	public function debugDumpParams() {
		return $this->stmt->debugDumpParams();
	}

}
