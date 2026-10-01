<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->randomElement([
                'Tips memilih earbuds nirkabel yang tepat',
                'Panduan merawat sepatu sneakers agar awet',
                '5 camilan sehat untuk teman kerja dari rumah',
                'Cara menata dapur kecil agar terasa lega',
                'Rekomendasi skincare untuk pemula',
                'Promo akhir bulan: apa saja yang layak dibeli?',
            ]),
            'content' => fake()->randomElement([
                'Sebelum membeli, perhatikan kebutuhan utama, garansi, dan ulasan pembeli lain. Bandingkan minimal tiga pilihan agar keputusan lebih tepat.',
                'Perawatan rutin yang sederhana sering kali lebih efektif daripada membeli produk baru. Simpan di tempat kering dan hindari paparan panas.',
                'Mulailah dari produk yang paling sering dipakai. Investasi kecil di awal biasanya menghemat biaya jangka panjang.',
            ]),
        ];
    }
}
