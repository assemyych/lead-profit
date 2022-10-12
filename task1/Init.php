<?php
declare(strict_types=1);

/**
 * Class Init
 */
final class Init
{
    const RESULT_NORMAL  = 1;
    const RESULT_SUCCESS = 2;
    const RESULT_FAILED  = 3;

    /**
     * @var string[]
     */
    protected static $result = [
        self::RESULT_NORMAL  => 'normal',
        self::RESULT_SUCCESS => 'success',
        self::RESULT_FAILED  => 'failed',
    ];

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->create();
        $this->fill();
    }

    /**
     * @return void
     */
    private function create()
    {
        $sql = "CREATE TABLE test (
           id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
           title VARCHAR(30) NOT NULL,
           description VARCHAR(255),
           created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
           result ENUM('normal', 'success', 'failed') NOT NULL 
        )";

        $this->pdo->exec($sql);
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function fill()
    {
        $sql = 'INSERT INTO test(`title`, `description`, `result`) VALUES (:title, :description, :result)';

        for ($i = 0; $i < 10; $i++) {
            $pdo = $this->pdo->prepare($sql);
            $pdo->bindValue(':title', uniqid());
            $pdo->bindValue(':description', bin2hex(random_bytes(10)));
            $pdo->bindValue(':result', array_rand(self::$result));

            $pdo->execute();
        }
    }

    /**
     * @return array
     */
    public function get() : array
    {
        $sql = 'SELECT * FROM `test` WHERE `result` IN ("normal", "success")';

        return $this->pdo->query($sql)->fetchAll();
    }
}