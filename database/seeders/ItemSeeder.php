<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keamanan = Category::where('name', 'Keamanan')->first();
        $kualitas  = Category::where('name', 'Kualitas')->first();
        $kinerja   = Category::where('name', 'Kinerja')->first();

        // Contoh item untuk kategori Keamanan
        if ($keamanan) {
            $keamanan->items()->updateOrCreate(
                ['name' => 'Enkripsi Data'],
                [
                    'standard'       => 'Semua data sensitif harus dienkripsi AES-256 saat disimpan.',
                    'recommendation' => 'Gunakan Laravel Encryption untuk transparansi.',
                ]
            );
        }

        // Contoh item untuk kategori Kualitas
        if ($kualitas) {
            $kualitas->items()->updateOrCreate(
                ['name' => 'Uji Otomatis'],
                [
                    'standard'       => 'Setiap fitur baru harus disertai minimal 3 unit test.',
                    'recommendation' => 'Integrasikan Pest untuk kemudahan penulisan test.',
                ]
            );
        }

        // Contoh item untuk kategori Kinerja
        if ($kinerja) {
            $kinerja->items()->updateOrCreate(
                ['name' => 'Caching'],
                [
                    'standard'       => 'Hasil query yang berat harus di-cache minimal 5 menit.',
                    'recommendation' => 'Gunakan Redis cache store untuk performa optimal.',
                ]
            );
        }
    }
}
