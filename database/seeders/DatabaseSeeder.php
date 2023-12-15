<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Role;
use App\Models\Satuan;
use App\Models\StatusPersetujuan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Gilang Abdul',
            'nip' => '123456789012345678',
            'email' => 'girdagilang@gmail.com',
            'email_verified_at'=> '2023/11/16',
            'password' => Hash::make('password'),
            'role_id'=> 4,
            'divisi_id'=>3
        ]);

        User::create([
            'name' => 'Suryana',
            'nip' => '123456789012345876',
            'email' => '222112076@stis.ac.id',
            'email_verified_at'=> '2023/10/09',
            'password' => Hash::make('password'),
            'role_id'=>5,
            'divisi_id'=>2
        ]);

        User::create([
            'name' => 'Khuzaimah Putri',
            'nip' => '123456789012345223',
            'email' => 'khuzaimahputri@gmail.com',
            'email_verified_at'=> '2023/09/05',
            'password' => Hash::make('password'),
            'role_id'=>3, // PJ Gudang
            'divisi_id'=>1
        ]);



        StatusPersetujuan::create([
            'jenis_status_persetujuan' => 'pending'
        ]);
        StatusPersetujuan::create([
            'jenis_status_persetujuan' => 'disetujui'
        ]);
        StatusPersetujuan::create([
            'jenis_status_persetujuan' => 'ditolak'
        ]);
        StatusPersetujuan::create([
            'jenis_status_persetujuan' => 'selesai'
        ]);

        Satuan::insert([
            ["jenis_satuan"=> 'Botol'],
            ["jenis_satuan"=> 'Box'],
            ["jenis_satuan"=> 'Boxes'],
            ["jenis_satuan"=> 'Buah'],
            ["jenis_satuan"=> 'Buku'],
            ["jenis_satuan"=> 'Dirigen'],
            ["jenis_satuan"=> 'Dus'],
            ["jenis_satuan"=> 'Eksemplar'],
            ["jenis_satuan"=> 'Eks'],
            ["jenis_satuan"=> 'Galon'],
            ["jenis_satuan"=> 'Gulungan'],
            ["jenis_satuan"=> 'Keping'],
            ["jenis_satuan"=> 'Kotak'],
            ["jenis_satuan"=> 'Lembar'],
            ["jenis_satuan"=> 'Liter'],
            ["jenis_satuan"=> 'Meter'],
            ["jenis_satuan"=> 'Ons'],
            ["jenis_satuan"=> 'Pack'],
            ["jenis_satuan"=> 'Pcs'],
            ["jenis_satuan"=> 'Pouch'],
            ["jenis_satuan"=> 'Rim'],
            ["jenis_satuan"=> 'Roll'],
            ["jenis_satuan"=> 'Set'],
            ["jenis_satuan"=> 'Tube'],
            ["jenis_satuan"=> 'Unit'],
        ]);

        Divisi::create([
            "nama_divisi" => "Bagian Distribusi"
        ]);

        Divisi::create([
            "nama_divisi" => "Bagian Nerwilis"
        ]);
        Divisi::create([
            "nama_divisi" => "Bagian Sosial"
        ]);
        Divisi::create([
            "nama_divisi" => "Bagian Umum"
        ]);
        Divisi::create([
            "nama_divisi" => "Bagian IPDS"
        ]);
        Divisi::create([
            "nama_divisi" => "Bagian Produksi"
        ]);


        Role::create([
            "id"=>1,
            "jenis_role" => "pegawai"
        ]);

        Role::create([
            "id"=>2,
            "jenis_role" => "petugas"
        ]);
        Role::create([
            "id"=>3,
            "jenis_role" => "PJ Gudang"
        ]);
        Role::create([
            "id"=>4,
            "jenis_role" => "Atasan"
        ]);
        Role::create([
            "id"=>5,
            "jenis_role" => "Kepala Bagian Umum"
        ]);
    }
}
