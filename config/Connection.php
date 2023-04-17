<?php

require_once '../vendor/autoload.php';

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ . "/../db.sqlite";
        $this->pdo = new PDO("sqlite:{$dbPath}");
    }

	/**
	 * @return PDO
	 */
	public function getPdo(): PDO 
    {
		return $this->pdo;
	}
}