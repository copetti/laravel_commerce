<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = [
        'name'
    ];

    //uma tag pertence a varios produtos N - N
	public function products(){

        return $this->belongsToMany('CodeCommerce\Product');

	}

}
