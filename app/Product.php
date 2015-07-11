<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommended'
    ];

    // um produto tem varias imagens
    public function images(){

        return $this->hasMany('CodeCommerce\ProductImage');

    }

    // um produto pertence a uma categoria
    public function category(){

        return $this->belongsTo('CodeCommerce\Category');

    }

    // um produto pertence a varias tags
    public function tags(){

        return $this->belongsToMany('CodeCommerce\Tag');

    }

    /**
     * sempre que tiver uma função com get no inicio e Attribute no final,
     * o laravel entendera como uma atributo
     * uso : $this->tagList ou $this->tag_list
     */
    public function getTagListAttribute(){

        $tags = $this->tags->lists('name');

        return implode(',', $tags);

    }

    public function scopeFeatured($query){

        return $query->where('featured','=',1);

    }

    public function scopeRecommended($query){

        return $query->where('recommended','=',1);

    }

    public function scopeOfCategory($query, $type){

        return $query->where('category_id','=',$type);

    }
}
