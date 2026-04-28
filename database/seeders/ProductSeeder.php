<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name'=>'Samsung Galaxy S23','description'=>'Smartphone de alta gama con excelente cámara','price'=>650000,'brand'=>'Samsung','ram'=>'8GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://maycsuministros.com/producto/samsung-s23-128gb-violeta/','category_id'=>1],
            ['name'=>'iPhone 13','description'=>'Teléfono Apple con gran rendimiento','price'=>700000,'brand'=>'Apple','ram'=>'4GB','storage'=>'128GB','operating_system'=>'iOS','image'=>'https://istuffcr.com/wp-content/uploads/2023/06/113-2-scaled.jpg','category_id'=>1],
            ['name'=>'Xiaomi Redmi Note 12','description'=>'Teléfono económico con buen rendimiento','price'=>250000,'brand'=>'Xiaomi','ram'=>'6GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://atekcr.com/cdn/shop/files/1366_2000_2_1050x700.webp','category_id'=>2],
            ['name'=>'Samsung Galaxy A34','description'=>'Teléfono gama media con buena batería','price'=>300000,'brand'=>'Samsung','ram'=>'6GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://extremetechcr.com/wp-content/uploads/2024/11/31795.jpg','category_id'=>2],
            ['name'=>'Motorola Edge 30','description'=>'Smartphone con diseño moderno','price'=>450000,'brand'=>'Motorola','ram'=>'8GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://img.pacifiko.com/PROD/resize/1500x500/ZjdiMDUwYm.jpg','category_id'=>1],
            ['name'=>'iPhone 14 Pro','description'=>'Teléfono premium con cámara avanzada','price'=>950000,'brand'=>'Apple','ram'=>'6GB','storage'=>'256GB','operating_system'=>'iOS','image'=>'https://istuffcr.com/wp-content/uploads/2023/06/I14P-2-scaled.jpg','category_id'=>1],
            ['name'=>'Samsung Galaxy S22','description'=>'Smartphone potente con diseño elegante','price'=>600000,'brand'=>'Samsung','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://img.pacifiko.com/PROD/resize/1500x500/YmQyZDEzZT.jpg','category_id'=>1],
            ['name'=>'Xiaomi Poco X5','description'=>'Teléfono con alto rendimiento para juegos','price'=>280000,'brand'=>'Xiaomi','ram'=>'8GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://extremetechcr.com/wp-content/uploads/2024/11/29393.jpg','category_id'=>2],
            ['name'=>'Realme 10','description'=>'Teléfono económico con buen diseño','price'=>180000,'brand'=>'Realme','ram'=>'4GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://business.shoppable.ph/_next/image?url=https%3A%2F%2Fshoppable-dev.s3.ap-southeast-1.amazonaws.com','category_id'=>3],
            ['name'=>'Huawei P50','description'=>'Smartphone con cámara profesional','price'=>550000,'brand'=>'Huawei','ram'=>'8GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://consumer.huawei.com/dam/content/dam/huawei-cbg-site/common/mkt/pdp/phones/p50/list/black.png','category_id'=>1],

            ['name'=>'Motorola G60','description'=>'Teléfono accesible con gran batería','price'=>220000,'brand'=>'Motorola','ram'=>'6GB','storage'=>'64GB','operating_system'=>'Android','image'=>'https://m.media-amazon.com/images/I/61udx1uZbgL._AC_UF1000,1000_QL80_.jpg','category_id'=>2],
            ['name'=>'Samsung Galaxy A14','description'=>'Teléfono básico para uso diario','price'=>150000,'brand'=>'Samsung','ram'=>'4GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://shop.samsung.com/latin/cac/pub/media/catalog/product/cache/a69107b4a4f0666a52473c2224ba9220/s/m/sm-a145_galaxy_a14.jpg','category_id'=>3],
            ['name'=>'iPhone SE','description'=>'Teléfono compacto y potente','price'=>500000,'brand'=>'Apple','ram'=>'4GB','storage'=>'128GB','operating_system'=>'iOS','image'=>'https://icon.co.cr/cdn/shop/files/IMG-4623880.jpg','category_id'=>1],
            ['name'=>'Xiaomi Mi 11 Lite','description'=>'Teléfono ligero y moderno','price'=>300000,'brand'=>'Xiaomi','ram'=>'6GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://i5.walmartimages.com/asr/e925ba33-0da3-40ac-b02e-4fbf27d75f9d.jpg','category_id'=>2],
            ['name'=>'Oppo Reno 8','description'=>'Smartphone con buen diseño y cámara','price'=>320000,'brand'=>'Oppo','ram'=>'8GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://m.media-amazon.com/images/I/41LaJcFj05L._AC_SR70.jpg','category_id'=>2],
            ['name'=>'Samsung Galaxy Z Flip','description'=>'Teléfono plegable innovador','price'=>1000000,'brand'=>'Samsung','ram'=>'8GB','storage'=>'64GB','operating_system'=>'Android','image'=>'https://images.samsung.com/es/smartphones/galaxy-z-flip6/images/galaxy-z-flip6-features-kv.jpg','category_id'=>1],
            ['name'=>'Xiaomi Redmi 10','description'=>'Teléfono económico y funcional','price'=>160000,'brand'=>'Xiaomi','ram'=>'4GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://holacompras.com/wp-content/uploads/2024/10/22041219NY-1.png','category_id'=>3],
            ['name'=>'Motorola Edge 20','description'=>'Smartphone con pantalla fluida','price'=>480000,'brand'=>'Motorola','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://cdn.shopify.com/s/files/1/1161/3498/products/Canvasfotosconguías.jpg','category_id'=>1],
            ['name'=>'Huawei Nova 9','description'=>'Teléfono con diseño elegante','price'=>350000,'brand'=>'Huawei','ram'=>'8GB','storage'=>'64GB','operating_system'=>'Android','image'=>'https://d1rlzxa98cyc61.cloudfront.net/catalog/product/cache/1801c418208f9607a371e61f8d9184d9.jpg','category_id'=>2],
            ['name'=>'Realme C25','description'=>'Teléfono básico con buena batería','price'=>140000,'brand'=>'Realme','ram'=>'4GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://www.celulares.com/fotos/realme-c25-1-90441-g.jpg','category_id'=>3],

            ['name'=>'Samsung Galaxy S21','description'=>'Teléfono potente con gran rendimiento','price'=>580000,'brand'=>'Samsung','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://www.celulares.com/fotos/samsung-galaxy-s21-5g-89040-g-alt.jpg','category_id'=>1],
            ['name'=>'iPhone 12','description'=>'Teléfono confiable con buen rendimiento','price'=>650000,'brand'=>'Apple','ram'=>'4GB','storage'=>'256GB','operating_system'=>'iOS','image'=>'https://www.apple.com/newsroom/images/product/iphone/geo/apple_iphone-12_2-up_geo_10132020_inline.jpg','category_id'=>1],
            ['name'=>'Xiaomi Poco F4','description'=>'Teléfono rápido para gaming','price'=>400000,'brand'=>'Xiaomi','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://extremetechcr.com/wp-content/uploads/2024/11/21481.jpg','category_id'=>1],
            ['name'=>'Oppo A57','description'=>'Teléfono económico con buen diseño','price'=>170000,'brand'=>'Oppo','ram'=>'4GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://www.oppo.com/content/dam/oppo/product-asset-library/specs/a57/a57-v1.png','category_id'=>3],
            ['name'=>'Motorola G32','description'=>'Teléfono funcional con buena pantalla','price'=>230000,'brand'=>'Motorola','ram'=>'4GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://holacompras.com/wp-content/uploads/2023/02/PAUT0028CR-1.jpg','category_id'=>2],
            ['name'=>'Huawei Mate 40','description'=>'Teléfono premium con gran potencia','price'=>700000,'brand'=>'Huawei','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://consumer.huawei.com/dam/content/dam/huawei-cbg-site/common/mkt/pdp/phones/mate40-pro/list-img/silver.png','category_id'=>1],
            ['name'=>'Realme Narzo 50','description'=>'Teléfono económico para uso diario','price'=>160000,'brand'=>'Realme','ram'=>'4GB','storage'=>'256GB','operating_system'=>'Android','image'=>'https://i.ebayimg.com/images/g/2t0AAOSwrIVjbphe/s-l1600.jpg','category_id'=>3],
            ['name'=>'iPhone 11','description'=>'Teléfono equilibrado en rendimiento','price'=>320000,'brand'=>'Apple','ram'=>'4GB','storage'=>'256GB','operating_system'=>'iOS','image'=>'https://www.apple.com/newsroom/images/tile-images/Apple_iphone-11-rosette-family-lineup-091019.jpg','category_id'=>2],
            ['name'=>'Samsung Galaxy A52','description'=>'Teléfono aún vigente con buen rendimiento','price'=>550000,'brand'=>'Samsung','ram'=>'8GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://img.pacifiko.com/PROD/resize/1500x500/OGU2ZGMzMW.jpg','category_id'=>1],
            ['name'=>'Xiaomi Redmi Note 11','description'=>'Teléfono popular y económico','price'=>260000,'brand'=>'Xiaomi','ram'=>'6GB','storage'=>'128GB','operating_system'=>'Android','image'=>'https://i5.walmartimages.com/asr/db5f3c12-da90-4eb3-a401-959f13be4a85.jpg','category_id'=>2],

        ];
        
        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }  
}