<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Menghasilkan produk e-commerce yang realistis (72 produk unik dari 9 kategori).
 *
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /** kategori => [[nama produk, harga min, harga maks, deskripsi], ...] */
    public const CATALOG = [
        'Elektronik' => [
            ['Wireless Earbuds Bluetooth 5.3', 250000, 650000, 'Earbuds nirkabel dengan noise cancelling dan baterai hingga 24 jam bersama case.'],
            ['Power Bank 20.000 mAh Fast Charging', 220000, 450000, 'Power bank kapasitas besar dengan dua port USB dan USB-C PD 22,5W.'],
            ['Smartwatch Fitness Tracker AMOLED', 450000, 1500000, 'Pantau detak jantung, tidur, dan langkah harian dengan layar AMOLED 1,7 inci.'],
            ['Mechanical Keyboard 75% Hot-swap', 550000, 1400000, 'Keyboard mekanikal kompak dengan switch hot-swap dan lampu RGB per tombol.'],
            ['Speaker Bluetooth Portable Waterproof', 300000, 900000, 'Speaker tahan air IPX7 dengan bass mendalam dan daya tahan 12 jam.'],
            ['Webcam Full HD 1080p Autofocus', 350000, 850000, 'Webcam dengan mikrofon ganda, cocok untuk meeting dan streaming.'],
            ['Mouse Wireless Ergonomis Silent Click', 120000, 380000, 'Mouse ergonomis dengan klik senyap dan konektivitas dual-mode.'],
            ['Lampu Meja LED Pintar Dimmable', 150000, 420000, 'Lampu belajar LED dengan 3 mode warna dan pengaturan kecerahan sentuh.'],
        ],
        'Fashion Pria' => [
            ['Kemeja Flannel Lengan Panjang', 149000, 289000, 'Kemeja flannel katun lembut, potongan regular fit untuk gaya kasual.'],
            ['Kaos Polos Cotton Combed 30s', 65000, 129000, 'Kaos berbahan cotton combed yang adem, jahitan rapi dan tidak mudah melar.'],
            ['Celana Chino Slim Fit', 179000, 349000, 'Celana chino stretch yang nyaman untuk kerja maupun santai.'],
            ['Jaket Bomber Water Resistant', 250000, 550000, 'Jaket bomber ringan dengan lapisan water resistant dan saku dalam.'],
            ['Sepatu Sneakers Casual Canvas', 199000, 450000, 'Sneakers kanvas dengan sol karet anti-slip untuk pemakaian harian.'],
            ['Dompet Kulit Sapi Bifold', 129000, 299000, 'Dompet kulit asli dengan 8 slot kartu dan kompartemen uang.'],
            ['Ikat Pinggang Kulit Klasik', 89000, 219000, 'Ikat pinggang kulit dengan gesper stainless tahan karat.'],
            ['Topi Baseball Cap Bordir', 49000, 119000, 'Topi baseball dengan tali belakang adjustable dan bordir rapi.'],
        ],
        'Fashion Wanita' => [
            ['Dress Midi Floral Rayon', 169000, 349000, 'Dress midi motif bunga berbahan rayon jatuh dan adem.'],
            ['Blouse Satin Lengan Balon', 129000, 259000, 'Blouse satin dengan detail lengan balon, elegan untuk acara semi formal.'],
            ['Rok Plisket Panjang Premium', 99000, 229000, 'Rok plisket tidak mudah kusut dengan karet pinggang nyaman.'],
            ['Hijab Pashmina Ceruty Babydoll', 39000, 99000, 'Pashmina ceruty lembut, jatuh dan mudah dibentuk.'],
            ['Tas Selempang Wanita Mini Sling Bag', 149000, 379000, 'Sling bag mini berbahan kulit sintetis dengan tali rantai bisa dilepas.'],
            ['Sepatu Flat Shoes Suede', 139000, 299000, 'Flat shoes suede empuk dengan insole lembut untuk seharian.'],
            ['Cardigan Rajut Oversize', 119000, 249000, 'Cardigan rajut tebal hangat, cocok untuk ruangan ber-AC.'],
            ['Kacamata Fashion Anti Radiasi', 79000, 189000, 'Kacamata fashion dengan lensa anti radiasi layar dan frame ringan.'],
        ],
        'Rumah Tangga' => [
            ['Rice Cooker Digital 1,8 Liter', 399000, 799000, 'Rice cooker digital dengan 8 menu masak dan fungsi keep warm 12 jam.'],
            ['Air Fryer 4 Liter Low Oil', 550000, 1200000, 'Air fryer kapasitas keluarga untuk menggoreng dengan sedikit minyak.'],
            ['Set Panci Anti Lengket 5 Pcs', 299000, 650000, 'Set panci berlapis granit anti lengket, aman untuk semua jenis kompor.'],
            ['Blender Portable Rechargeable', 129000, 299000, 'Blender mini USB untuk smoothie dan jus, mudah dibawa bepergian.'],
            ['Set Sprei Katun Queen Size', 219000, 499000, 'Sprei katun lembut ukuran queen lengkap dengan dua sarung bantal.'],
            ['Rak Sepatu Susun 4 Tingkat', 99000, 249000, 'Rak sepatu dari rangka besi dengan pelat kokoh dan mudah dirakit.'],
            ['Diffuser Aromaterapi Ultrasonic', 119000, 299000, 'Diffuser ultrasonik dengan lampu malam dan mati otomatis saat kosong.'],
            ['Vacuum Cleaner Handheld Cordless', 350000, 950000, 'Penyedot debu genggam tanpa kabel dengan daya hisap kuat.'],
        ],
        'Olahraga' => [
            ['Matras Yoga TPE Anti Slip 6mm', 99000, 249000, 'Matras yoga ramah lingkungan, permukaan anti slip dan nyaman untuk sendi.'],
            ['Dumbbell Set Adjustable 20 Kg', 350000, 850000, 'Dumbbell set dengan beban yang bisa diatur untuk latihan di rumah.'],
            ['Sepatu Lari Running Breathable', 299000, 899000, 'Sepatu lari ringan dengan bantalan responsif dan upper mesh breathable.'],
            ['Tas Ransel Hiking 40L Waterproof', 249000, 699000, 'Ransel gunung 40 liter dengan rain cover dan sistem punggung ventilasi.'],
            ['Botol Minum Stainless 1 Liter', 69000, 179000, 'Botol minum vakum tahan panas dan dingin hingga 24 jam.'],
            ['Resistance Band Set 5 Level', 59000, 149000, 'Set karet latihan 5 tingkat beban lengkap dengan tas dan panduan.'],
            ['Jersey Sepeda Quick Dry', 99000, 249000, 'Jersey sepeda cepat kering dengan kantong belakang dan resleting penuh.'],
            ['Raket Badminton Carbon Lite', 149000, 549000, 'Raket badminton karbon ringan seimbang untuk permainan cepat.'],
        ],
        'Kecantikan' => [
            ['Serum Vitamin C 20% Brightening', 89000, 249000, 'Serum vitamin C untuk mencerahkan dan meratakan warna kulit.'],
            ['Sunscreen SPF 50 PA++++ Gel', 65000, 179000, 'Tabir surya gel ringan, tidak lengket dan tanpa white cast.'],
            ['Facial Wash Gentle Amino Acid', 45000, 129000, 'Pembersih wajah lembut berbahan amino acid, cocok untuk kulit sensitif.'],
            ['Moisturizer Ceramide Barrier Repair', 79000, 219000, 'Pelembap dengan ceramide untuk memperkuat skin barrier.'],
            ['Lipstik Matte Long Lasting', 49000, 149000, 'Lipstik matte tahan hingga 8 jam dengan tekstur ringan di bibir.'],
            ['Shampoo Anti Ketombe Herbal', 39000, 99000, 'Shampoo herbal untuk mengurangi ketombe dan menyegarkan kulit kepala.'],
            ['Masker Wajah Clay Purifying', 59000, 159000, 'Masker clay untuk mengangkat minyak berlebih dan membersihkan pori.'],
            ['Body Lotion Shea Butter 400ml', 55000, 139000, 'Body lotion dengan shea butter yang melembapkan hingga 24 jam.'],
        ],
        'Buku & Alat Tulis' => [
            ['Novel Fiksi Populer Best Seller', 69000, 119000, 'Novel fiksi laris dengan alur menegangkan, cetakan terbaru.'],
            ['Buku Panduan Laravel untuk Pemula', 89000, 179000, 'Panduan praktis membangun aplikasi web dengan Laravel langkah demi langkah.'],
            ['Notebook A5 Dotted Hardcover', 45000, 109000, 'Notebook hardcover kertas 100 gsm, cocok untuk bullet journal.'],
            ['Pulpen Gel Set 12 Warna', 29000, 79000, 'Set pulpen gel 12 warna dengan tinta cepat kering dan tidak luntur.'],
            ['Planner Mingguan 2026', 55000, 129000, 'Planner mingguan dengan habit tracker dan halaman goal bulanan.'],
            ['Tas Laptop Slim 15,6 Inch', 149000, 399000, 'Tas laptop tipis anti benturan dengan banyak kompartemen.'],
            ['Papan Tulis Magnetik Kecil', 59000, 149000, 'Papan tulis magnetik ukuran meja lengkap spidol dan penghapus.'],
            ['Highlighter Pastel Set 6 Pcs', 25000, 65000, 'Highlighter warna pastel yang lembut di mata dan tidak tembus kertas.'],
        ],
        'Makanan & Minuman' => [
            ['Kopi Arabika Gayo 250g', 65000, 135000, 'Biji kopi arabika Gayo single origin, sangrai medium dengan aroma floral.'],
            ['Teh Hijau Matcha Premium 100g', 79000, 189000, 'Bubuk matcha kualitas ceremonial untuk latte dan minuman dingin.'],
            ['Madu Hutan Asli 500ml', 89000, 199000, 'Madu hutan murni tanpa campuran gula, dipanen langsung dari peternak lokal.'],
            ['Keripik Singkong Balado Pedas', 15000, 39000, 'Keripik singkong renyah dengan bumbu balado pedas manis.'],
            ['Granola Oat Almond Tanpa Gula', 55000, 119000, 'Granola panggang dengan oat dan almond, cocok untuk sarapan sehat.'],
            ['Sambal Bawang Botol 200g', 25000, 59000, 'Sambal bawang homemade tahan lama, pedas gurih untuk teman makan.'],
            ['Cokelat Dark 70% Batangan', 35000, 89000, 'Cokelat hitam 70% dari kakao Nusantara dengan rasa pahit yang seimbang.'],
            ['Minyak Zaitun Extra Virgin 500ml', 99000, 229000, 'Minyak zaitun extra virgin untuk salad dan menumis suhu rendah.'],
        ],
        'Mainan & Hobi' => [
            ['Lego Style Building Blocks 500 Pcs', 149000, 399000, 'Set balok susun 500 keping untuk melatih kreativitas anak.'],
            ['Puzzle Kayu Edukatif Anak', 45000, 129000, 'Puzzle kayu warna-warni yang aman dan melatih motorik halus.'],
            ['Papan Catur Magnetik Lipat', 69000, 189000, 'Papan catur magnet portabel yang bisa dilipat, lengkap dengan bidak.'],
            ['Rubik 3x3 Speed Cube', 35000, 99000, 'Rubik speed cube putaran halus dengan sistem pegas dapat diatur.'],
            ['Boneka Plush Kucing Lucu 40cm', 59000, 149000, 'Boneka plush lembut berbahan hypoallergenic, cocok sebagai hadiah.'],
            ['Set Cat Air 24 Warna + Kuas', 49000, 129000, 'Set cat air 24 warna lengkap dengan kuas dan palet mixing.'],
            ['Drone Mini Kamera HD', 350000, 999000, 'Drone lipat mini dengan kamera HD, mode headless, dan tahan angin ringan.'],
            ['Kartu UNO Edisi Standar', 25000, 69000, 'Permainan kartu klasik UNO seru dimainkan bersama keluarga.'],
        ],
    ];

    protected static int $index = 0;

    public function definition(): array
    {
        // Urutan selang-seling antar kategori agar etalase terlihat bervariasi.
        $flat = [];
        for ($i = 0; $i < 8; $i++) {
            foreach (self::CATALOG as $category => $items) {
                $flat[] = [$category, ...$items[$i]];
            }
        }

        [$category, $name, $min, $max, $description] = $flat[static::$index % count($flat)];
        $cycle = intdiv(static::$index, count($flat));
        static::$index++;

        return [
            'category_id' => Category::firstOrCreate(
                ['name' => $category],
                ['description' => CategoryFactory::CATALOG[$category]],
            )->id,
            'name' => $cycle > 0 ? "{$name} (Seri ".($cycle + 1).')' : $name,
            'description' => $description,
            'price' => (int) (round(fake()->numberBetween($min, $max) / 1000) * 1000),
            'stock' => fake()->randomElement([0, 4, 9, 15, 20, 25, 30, 40, 50, 60, 80, 100]),
            'image' => null,
        ];
    }
}
