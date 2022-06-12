<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;

class Product extends Model
{
    use Rateable;
    use Commentable;
    use SoftDeletes;

    // protected $casts=[
    //     'product_attributes'=>'array'
    // ];

    protected $appends = [
        'images',
        'images_data',
        'has_variants',
        'featured_image',
        'product_ratings_avg',
    ];

    protected static function booted()
    {
        static::saving(function ($product) {
            $product->product_attributes = json_encode(request('product_attributes'));
        });
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function shopModel()
    {
        return $this->belongsTo(ShopModel::class, 'shop_id', 'id');
        
    }
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'id', 'product_id');
    }

    public function prod_attribute(){
        return $this->belongsTo(ProductAttribute::class, 'id', 'product_id');
    }

    public function prod_variation(){
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function images() {
        return $this->hasMany( ProductImage::class, 'product_id' );
    }

    /**
     * Custom attributes
     */
    public function getHasVariantsAttribute() {
        $variants = ProductVariation::where( 'product_id', $this->id )->first();
        if ( ! $variants ) return false;
        
        $bool = ( $variants->variation_name == 'Regular' ) ? false : true;

        return $bool;
    }

    public function getImagesAttribute() {
        $images[] = ProductImage::where( [ 'product_id' => $this->id, 'is_featured' => true ] )->first()->image;
        $productImages = ProductImage::where( 'product_id', $this->id )->where( 'is_featured', false )->get()->pluck( 'image' )->toArray();
        $finalImages = array_merge( $images, $productImages );

        return $finalImages;
    }

    public function getImagesDataAttribute() {
        $productImages = ProductImage::where( 'product_id', $this->id )->get();
        return $productImages;
    }

    public function getFeaturedImageAttribute() {
        $image = ProductImage::where( [ 'product_id' => $this->id, 'is_featured' => true ] )->first();
        return $image->image ?? '';
    }

    public function getProductRatingsAvgAttribute() {
        $ratings = ProductRating::where( 'product_id', $this->id )->avg( 'rating' );

        return ( $ratings > 0 ) ? round( $ratings ) : 0;
    }

    /**
     * Scopes
     */
    public function scopeGetVariants( $query ) {
        $query->whereHas( 'prod_variation' );
        return $query;
    }
}
