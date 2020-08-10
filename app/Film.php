<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
        public function categories()
    {
        return $this->belongsToMany('App\Category', 'films_categories', 'film_id', 'category_id');
    }
    
        public function countries()
    {
        return $this->belongsToMany('App\Country', 'films_countries', 'film_id', 'country_id');
    }
}
