<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];
        $password = password_hash('Passw0rd', PASSWORD_DEFAULT);

        for ($i = 0; $i <= 10; $i++) {
            $data[] = [
                'login' => 'stan' . $i,
                'password' => $password
            ];
        }

        $this->table('users')->insert($data)->save();
    }
}
