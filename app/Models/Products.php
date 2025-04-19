<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
   
     
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'category',
        'stock',
        'brand',
        'color',
        'size', 
        'material',
        'warranty',
        'return_policy',
        'shipping_info',
        'tags',
        'is_featured',
        'is_new',
        'is_on_sale',
        'sale_price',
        'sku',
        // Add other fields as necessary
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
        'is_deleted',
        'category_id',
        
        
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function generateSKU($productName, $category) {
        $prefix = strtoupper(substr($productName, 0, 3) . substr($category, 0, 3)); // First 3 letters from both
        $uniqueCode = strtoupper(bin2hex(random_bytes(3))); // 6-character alphanumeric code
        return "$prefix-$uniqueCode";
    }
    
    // Generate a unique 13-digit barcode number
    public static function generateBarcode() {
        $barcode = "";
        for ($i = 0; $i < 13; $i++) {
            $barcode .= mt_rand(0, 9); // Generate random digits
        }
        return $barcode;
    }


}
