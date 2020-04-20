<?php

namespace Tests\Unit;

use App\Core\Db\Mysql\MysqlDriver;
use App\Domain\User;
use Tests\AbstractTestCase;

/**
 * Class ModelTestCase
 *
 * @package Tests\Unit
 */
abstract class ModelTestCase extends AbstractTestCase
{
    /**
     * @var
     */
    protected $db;

    /**
     * @var array
     */
    protected $tables = [];

    /**
     * @setUp
     */
    public function setUp(): void
    {
        $dbConfig = [
            'db_connection' => 'mysql',
            'db_host'       => '192.168.10.10',
            'db_name'       => 's-board',
            'user'          => 'homestead',
            'password'      => 'secret',
        ];

        /*
        .env is not loaded, so Config can't access it's parameters
        so, this is a temporary solution

        $config = (Container::getInstance()->get(Config::class));
        $dbConfig = $config->get('db');
        */

        $this->db = new MysqlDriver();
        $this->db->init($dbConfig);

        $this->db->beginTransaction();
        $this->cleanAllTables();
    }

    /**
     * @tearDown
     */
    public function tearDown(): void
    {
        $this->db->rollBack();
    }

    /**
     * Clean specified tables
     */
    protected function cleanAllTables()
    {
        foreach ($this->tables as $table) {
            $this->db->exec("DELETE FROM $table");
        }
    }

    /**
     * @return User
     */
    protected function buildUser(): User
    {
        $user = new User();

        return $user->create(
            'Dallas',
            'dallas',
            'dallas@example.com',
            'dallas123'
        );
    }

    /**
     * @param User $user
     *
     * @return int
     */
    protected function insertUser(User $user): int
    {
        $params = [
            ':name'     => $user->getName(),
            ':slug'     => $user->getSlug(),
            ':email'    => $user->getEmail(),
            ':password' => $user->getPassword(),
        ];

        $query = 'INSERT INTO users (name, slug, email, password, created_at)
			VALUES (:name, :slug, :email, :password, NOW())';

        $this->db->execute($query, $params);

        return $this->db->lastInsertId();
    }
}
