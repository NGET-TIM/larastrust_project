<?php

namespace App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    // protected $table = 'products';
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'weight',
        'cost',
        'price',
        'quantity_alert',
        'quantity',
        'image',
        'details',
        'created_by',
    ];
    protected $dates = ['created_at', 'updated_at'];

    # delete product photos
    public function delete_product_images($galleries_images, $single_image) {
        if(! empty($galleries_images)) {
            foreach($galleries_images as $id) {
                $product = $this::findOrfail($id);
                # single image
                if($product->image != 'upload/images/product/ ') {
                    unlink($product->image);
                }
                # gallery image
                $galleries = DB::table('product_photos')->where('product_id', $product->id)->get();
                foreach($galleries as $gallery) {
                    if($gallery) {
                        unlink($gallery->image);
                        DB::table('product_photos')->where('product_id', $id)->delete();
                    }
                }
            }
        }
        if(! empty($single_image)) {
            $product = $this::findOrfail($single_image);
            # single image
            if($product->image != 'upload/images/product/ ') {
                unlink($product->image);
            }
            # gallery image
            $galleries = DB::table('product_photos')->where('product_id', $product->id)->get();
            foreach($galleries as $gallery) {
                if($gallery) {
                    unlink($gallery->image);
                    DB::table('product_photos')->where('product_id', $single_image)->delete();
                }
            }
        }
    }
}
