<?php

namespace App\Controllers;

use App\Libraries\Eloquent;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Psr\Log\LoggerInterface;
use Throwable;
use CodeIgniter\Shield\Entities\User;

class Migrate extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        if (ENVIRONMENT !== 'development') {
            return throw new PageNotFoundException('Halaman tidak ditemukan');
        }
    }
    
    public function index()
    {
        if (file_exists(WRITEPATH . 'storage/store.json')) {
            unlink(WRITEPATH . 'storage/store.json');
        }

        $dbname = env('database.default.database');

        try {
            $forge = \Config\Database::forge();
            $migrate = \Config\Services::migrations();
            $seeder = \Config\Database::seeder();
            $db = \Config\Database::connect();

            $tables = $db->listTables();

            foreach ($tables as $table) {
                $forge->dropTable($table, true);
            }

            $migrate->setNamespace('CodeIgniter\Settings')->latest();
            // $migrate->setNamespace('Mrfrost\GoogleApi')->latest();
            // $migrate->setNamespace('CodeIgniter\Shield')->latest();
            $migrate->setNamespace('App')->latest();

            $seeder->call('InitSeeder');

            // $users = auth()->getProvider();

            // $user = new User([
            //     'username' => 'admin',
            //     'email'    => 'admin@gmail.com',
            //     'password' => 'admin',
            // ]);
            // $users->save($user);

            // // To get the complete user object with ID, we need to get from the database
            // $user = $users->findById($users->getInsertID());

            // // Add to default group
            // $users->addToDefaultGroup($user);

        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }

        return 'berhasil migrate database, <a href="' . base_url() . '">Kembali</a>';
    }
}
