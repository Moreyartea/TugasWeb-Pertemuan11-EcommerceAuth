<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /** Kategori realistis: nama => deskripsi. */
    public const CATALOG = [
        'Elektronik' => 'Gadget, audio, dan perangkat pintar untuk kebutuhan harian.',
        'Fashion Pria' => 'Pakaian, sepatu, dan aksesori pria yang nyaman dipakai.',
        'Fashion Wanita' => 'Busana dan aksesori wanita dengan model terkini.',
        'Rumah Tangga' => 'Peralatan dapur dan perlengkapan rumah agar hunian lebih rapi.',
        'Olahraga' => 'Perlengkapan olahraga dan outdoor untuk gaya hidup aktif.',
        'Kecantikan' => 'Perawatan kulit, rambut, dan tubuh dari merek terpercaya.',
        'Buku & Alat Tulis' => 'Buku, alat tulis, dan perlengkapan belajar atau bekerja.',
        'Makanan & Minuman' => 'Kopi, teh, camilan, dan bahan makanan pilihan.',
        'Mainan & Hobi' => 'Mainan edukatif, koleksi, dan perlengkapan hobi.',
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $names = array_keys(self::CATALOG);
        $name = $names[static::$index % count($names)];
        $suffix = intdiv(static::$index, count($names));
        static::$index++;

        return [
            'name' => $suffix > 0 ? "{$name} {$suffix}" : $name,
            'description' => self::CATALOG[$name],
        ];
    }
}
