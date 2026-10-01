<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    public const NAMES = [
        'Terlaris', 'Baru', 'Diskon', 'Original', 'Garansi Resmi',
        'Gratis Ongkir', 'Ramah Lingkungan', 'Limited Edition',
        'Pilihan Editor', 'Best Value',
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        $name = self::NAMES[static::$index % count(self::NAMES)];
        $suffix = intdiv(static::$index, count(self::NAMES));
        static::$index++;

        return ['name' => $suffix > 0 ? "{$name} {$suffix}" : $name];
    }
}
