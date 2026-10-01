# Dokumentasi 5 Query Tinker

Jalankan `php artisan tinker`, lalu eksekusi query di bawah ini dan **ambil screenshot terminalnya**
(simpan ke `docs/screenshots/tinker-1.png` … `tinker-5.png`). Output di bawah berasal dari eksekusi nyata
setelah `php artisan migrate:fresh --seed`; angka acak (harga, stok, tag) bisa berbeda di mesin Anda.

## 1. Eager loading relasi `belongsTo` + `belongsToMany`
```php
Product::with(['category', 'tags'])->find(1);
```
Hasil: *Wireless Earbuds Bluetooth 5.3* → kategori **Elektronik**, tag **Garansi Resmi**, **Ramah Lingkungan**.
Total hanya 3 query (produk, kategori, tag) — tanpa N+1.

## 2. Local scope `lowStock()`
```php
Product::lowStock()->count();   // stok <= 10
```
Hasil contoh: `15`.

## 3. Local scope dengan parameter `priceAbove()`
```php
Product::priceAbove(500000)->orderByDesc('price')->take(3)->get(['id', 'name', 'price']);
```
Hasil contoh: Smartwatch Fitness Tracker AMOLED (Rp 1.449.000), Mechanical Keyboard 75% Hot-swap (Rp 1.371.000), Air Fryer 4 Liter Low Oil (Rp 1.006.000).

## 4. Agregasi relasi `withCount`
```php
Category::withCount('products')->orderByDesc('products_count')->take(3)->get();
```
Hasil contoh: Elektronik 8, Fashion Pria 7, Fashion Wanita 7.

## 5. Relasi bertingkat (User → Order → OrderItem → Product) + agregasi
```php
User::where('email', 'user@example.com')->first()
    ->orders()->with('orderItems.product')->latest()->first();

Order::with('user')->where('status', 'completed')->get()
    ->groupBy('user.name')->map->sum('total_amount');
```
Hasil contoh: `{"Admin E-Commerce":4283000,"Editor Kedua":3079000,"User E-Commerce":1259000}`.

---

### Bonus — demo eager loading
Halaman **/demo/eager-loading** (login sebagai admin/editor) membandingkan jumlah query secara langsung:
tanpa `with()` ≈ **129 query**, dengan `with(['category','tags'])` hanya **3 query**.
Bisa juga dibuktikan di Tinker:
```php
DB::enableQueryLog();
Product::all()->each(fn ($p) => $p->category->name);
count(DB::getQueryLog());                       // 65 (N+1)
DB::flushQueryLog();
Product::with('category')->get()->each(fn ($p) => $p->category->name);
count(DB::getQueryLog());                       // 2
```
