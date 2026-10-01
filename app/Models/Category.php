<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /** Emoji ikon kategori untuk thumbnail produk. */
    public function getEmojiAttribute(): string
    {
        return match ($this->name) {
            'Elektronik' => '🎧',
            'Fashion Pria' => '👕',
            'Fashion Wanita' => '👗',
            'Rumah Tangga' => '🏠',
            'Olahraga' => '🏀',
            'Kecantikan' => '💄',
            'Buku & Alat Tulis' => '📚',
            'Makanan & Minuman' => '☕',
            'Mainan & Hobi' => '🧩',
            default => '🛍️',
        };
    }

    /** Hue (0-360) stabil per kategori untuk warna latar thumbnail. */
    public function getHueAttribute(): int
    {
        return ($this->id * 47 + 200) % 360;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}