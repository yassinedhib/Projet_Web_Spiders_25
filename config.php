<?php
class Config {
    private static $dbHost = 'localhost';
    private static $dbName = 'report';
    private static $dbUser = 'root';
    private static $dbPass = '';

    public static function getConnexion() {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                self::$dbUser,
                self::$dbPass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
?>