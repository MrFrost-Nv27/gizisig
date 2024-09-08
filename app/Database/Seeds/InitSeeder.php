<?php

namespace App\Database\Seeds;

use App\Models\Gizisig\Pasien;
use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $path = APPPATH . 'Database/Seeds/json/';
        PenggunaModel::create([
            'username' => 'admin',
            'name' => 'Admin',
        ])->setEmailIdentity([
            'email' => 'admin@gmail.com',
            'password' => "password",
        ])->addGroup('admin')->activate();

        $data = [
            [
                'nama' => 'Puskesmas Bumiayu',
                'alamat' => 'Jl. Kawedanan No.1, Kampungbaru Munggang, Kalierang, Kec. Bumiayu, Kabupaten Brebes, Jawa Tengah 52273',
                'latitude' => '-7.255168324548402',
                'longitude' => '109.00677815040129',
            ],
            [
                'nama' => 'Puskesmas Kaliwadas',
                'alamat' => 'Jl. Dukuhtempel No.6, Sawah, Kaliwadas, Kec. Bumiayu, Kabupaten Brebes, Jawa Tengah 52273',
                'latitude' => '-7.265924213459043',
                'longitude' => '108.98146212022397',
            ],
        ];

        // Using Query Builder
        $this->db->table('sig_puskesmas')->insertBatch($data);

        foreach (array_chunk(json_decode(file_get_contents($path . 'pasien.json'), true), 1000) as $t) {
            Pasien::upsert($t, ['id'], [
                "id_puskesmas",
                "nama",
                "ortu",
                "alamat",
                "latitude",
                "longitude",
                "jk",
                "tgl_lahir",
                "usia",
                "bb",
                "tb",
                "bb_u",
                "tb_u",
                "bb_tb",
            ], );
        }
    }
}
