<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteContent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Team Admin Account
        User::updateOrCreate(
            ['email' => 'admin@severus.com'],
            [
                'name' => 'Severus Admin',
                'role' => 'admin',
                'password' => Hash::make('severus123'),
            ]
        );

        // 2. Create Categories
        $cuesCat = Category::updateOrCreate(
            ['slug' => 'cues'],
            [
                'name_en' => 'Pool Cues',
                'name_id' => 'Stik Billiard',
                'description_en' => 'High-precision carbon shaft pool cues designed for zero deflection and power transfer.',
                'description_id' => 'Stik billiard berbahan karbon presisi tinggi dengan keakurasian maksimal dan defleksi minimal.',
                'icon' => 'sparkles',
                'sort_order' => 1,
            ]
        );

        $chalkCat = Category::updateOrCreate(
            ['slug' => 'chalk'],
            [
                'name_en' => 'Cues Chalk',
                'name_id' => 'Kapur Billiard',
                'description_en' => 'Engineered nano-friction chalk formulation for maximum tip grip and zero miscues.',
                'description_id' => 'Formulasi kapur nano-friksi berperforma tinggi untuk cengkeraman maksimal tanpa miscue.',
                'icon' => 'square-3-stack-3d',
                'sort_order' => 2,
            ]
        );

        $accessoriesCat = Category::updateOrCreate(
            ['slug' => 'accessories'],
            [
                'name_en' => 'Billiard Accessories',
                'name_id' => 'Aksesoris Billiard',
                'description_en' => 'Pro gloves, tip shapers, cue cases, and maintenance tools engineered for champions.',
                'description_id' => 'Sarung tangan pro, pencetak tip, tas stik, dan alat perawatan billiard kualitas juara.',
                'icon' => 'swatch',
                'sort_order' => 3,
            ]
        );

        $extensionsCat = Category::updateOrCreate(
            ['slug' => 'extensions'],
            [
                'name_en' => 'Shafts & Extensions',
                'name_id' => 'Shaft & Ekstensi',
                'description_en' => 'Aircraft-grade aluminum cue extensions and low-deflection carbon shafts.',
                'description_id' => 'Ekstensi stik berbahan alumunium pesawat dan shaft karbon tingkat keakurasian tinggi.',
                'icon' => 'bolt',
                'sort_order' => 4,
            ]
        );

        // 3. Create Seed Products
        $products = [
            [
                'category_id' => $cuesCat->id,
                'name_en' => 'Severus Snakebite Pro Carbon Cue',
                'name_id' => 'Stik Karbon Severus Snakebite Pro',
                'slug' => Str::slug('Severus Snakebite Pro Carbon Cue'),
                'description_en' => 'Forged with aerospace-grade 3K carbon fiber technology. Features custom Venom Green emerald inlay, Radial Joint, and Japanese Moori Tip for extreme accuracy and spin control.',
                'description_id' => 'Dibuat dengan teknologi serat karbon 3K tingkat kedirgantaraan. Dilengkapi inlay hijau venom khas Severus, Radial Joint, dan Tip Moori Jepang untuk akurasi serta kontrol efek ekstrem.',
                'price_idr' => 8500000.00,
                'price_usd' => 550.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=800&q=80',
                'tip_size' => '12.5mm Pro Taper',
                'joint_type' => 'Precision Radial Joint',
                'weight_oz' => '19.0 oz (Adjustable)',
                'tip' => 'Japanese Moori 12.5mm',
                'ferrule' => 'Ivorine-X Laminated',
                'is_featured' => true,
            ],
            [
                'category_id' => $chalkCat->id,
                'name_en' => 'Severus Venom Toxic Chalk (Box of 2)',
                'name_id' => 'Kapur Severus Venom Toxic (Isi 2)',
                'slug' => Str::slug('Severus Venom Toxic Chalk Box of 2'),
                'description_en' => 'The ultimate chalk for professional cueists. Hydrophobic nano-particles ensure zero miscues, clean cue balls, and unmatched friction coefficient.',
                'description_id' => 'Kapur paling mutakhir untuk pemain profesional. Nano-partikel hidrofobik mencegah miscue, menjaga bola putih tetap bersih, dan memberikan daya rekat luar biasa.',
                'price_idr' => 350000.00,
                'price_usd' => 24.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=800&q=80',
                'tip_size' => 'Universal Fit',
                'joint_type' => 'N/A',
                'weight_oz' => '0.8 oz per piece',
                'tip' => 'Universal Fit',
                'ferrule' => 'N/A',
                'is_featured' => true,
            ],
            [
                'category_id' => $accessoriesCat->id,
                'name_en' => 'Severus Viper Precision Glove',
                'name_id' => 'Sarung Tangan Severus Viper Precision',
                'slug' => Str::slug('Severus Viper Precision Glove'),
                'description_en' => 'Silky-smooth breathable lycra mesh with anti-slip palm grip. Ensures friction-free shaft glides under humid pool hall conditions.',
                'description_id' => 'Bahan mesh lycra halus dan halus dengan grip telapak anti-slip. Menjamin laju stik yang sangat lancar dalam kondisi arena billiard yang lembab.',
                'price_idr' => 280000.00,
                'price_usd' => 19.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1589487391730-58f20eb2c308?auto=format&fit=crop&w=800&q=80',
                'tip_size' => 'S, M, L, XL Available',
                'joint_type' => 'N/A',
                'weight_oz' => '1.2 oz',
                'tip' => 'S, M, L, XL Available',
                'ferrule' => 'N/A',
                'is_featured' => true,
            ],
            [
                'category_id' => $extensionsCat->id,
                'name_en' => 'Severus Cobra Quick-Lock Extension 8"',
                'name_id' => 'Ekstensi Stik Severus Cobra Quick-Lock 8 Inci',
                'slug' => Str::slug('Severus Cobra Quick Lock Extension 8 Inch'),
                'description_en' => 'Aircraft-grade anodized aluminum extension with venom green ring accent. Connects seamlessly to Severus cue butts in under 2 seconds.',
                'description_id' => 'Ekstensi alumunium anodized kelas penerbangan dengan aksen cincin hijau venom. Terpasang kuat dan presisi pada stik Severus kurang dari 2 detik.',
                'price_idr' => 1250000.00,
                'price_usd' => 85.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1511193311914-0346f16efe90?auto=format&fit=crop&w=800&q=80',
                'tip_size' => 'N/A',
                'joint_type' => 'Severus Quick-Release Lock',
                'weight_oz' => '4.2 oz',
                'tip' => 'N/A',
                'ferrule' => 'N/A',
                'is_featured' => false,
            ],
            [
                'category_id' => $accessoriesCat->id,
                'name_en' => 'Severus Toxic 3-in-1 Tip Shaper & Scuffer',
                'name_id' => 'Pencetak & Pengasah Tip Severus Toxic 3-in-1',
                'slug' => Str::slug('Severus Toxic 3 in 1 Tip Shaper Scuffer'),
                'description_en' => 'Precision CNC machined aluminum body with nickel-plated diamond scuffers. Shapes cue tip to dime or nickel radius and aerates leather for maximum chalk retention.',
                'description_id' => 'Alat aluminium CNC presisi dengan pengasah intan berlapis nikel. Membentuk kelengkungan tip dan mengaerasi kulit tip agar kapur menempel sempurna.',
                'price_idr' => 420000.00,
                'price_usd' => 28.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?auto=format&fit=crop&w=800&q=80',
                'tip_size' => 'Dime & Nickel Curvatures',
                'joint_type' => 'N/A',
                'weight_oz' => '2.5 oz',
                'tip' => 'Dime & Nickel Curvatures',
                'ferrule' => 'N/A',
                'is_featured' => false,
            ],
            [
                'category_id' => $accessoriesCat->id,
                'name_en' => 'Severus Hard Shell Venom 3x4 Cue Case',
                'name_id' => 'Tas Stik Hard Shell Severus Venom 3x4',
                'slug' => Str::slug('Severus Hard Shell Venom 3x4 Cue Case'),
                'description_en' => 'Waterproof viper-pattern synthetic leather with molded interior foam inserts. Accommodates 3 butts and 4 shafts plus jump cue extensions and chalk pockets.',
                'description_id' => 'Tas stik tahan air kulit sintetis motif viper dengan lapisan busa cetak presisi. Muat 3 butt dan 4 shaft plus ekstensi stik jump dan kantong kapur.',
                'price_idr' => 3200000.00,
                'price_usd' => 210.00,
                'tokopedia_url' => 'https://www.tokopedia.com/severus',
                'image_path' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=800&q=80',
                'tip_size' => 'Holds shafts up to 31"',
                'joint_type' => 'N/A',
                'weight_oz' => '4.8 lbs',
                'tip' => 'Holds shafts up to 31"',
                'ferrule' => 'N/A',
                'is_featured' => true,
            ],
        ];

        foreach ($products as $pData) {
            Product::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );
        }

        // 4. Create Site Content (Bilingual Copy)
        $contents = [
            [
                'key_name' => 'hero_title',
                'value_en' => 'BASED FROM INDONESIA',
                'value_id' => 'BERBASIS DARI INDONESIA',
                'section' => 'hero',
            ],
            [
                'key_name' => 'hero_subtitle',
                'value_en' => 'Billiard Carbon Shafts, Cues, Et Cetera',
                'value_id' => 'Shaft & Stik Karbon Billiard, dan Lainnya',
                'section' => 'hero',
            ],
            [
                'key_name' => 'tokopedia_banner',
                'value_en' => 'Official Severus Store on Tokopedia. Fast delivery across Indonesia.',
                'value_id' => 'Toko Resmi Severus di Tokopedia. Pengiriman cepat ke seluruh Indonesia.',
                'section' => 'banner',
            ],
        ];

        foreach ($contents as $cData) {
            SiteContent::updateOrCreate(
                ['key_name' => $cData['key_name']],
                $cData
            );
        }
    }
}
