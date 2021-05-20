<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected   $table = "categories";

    /**
     * Return cateogry cover path
     */
    public function getCoverAttribute(){
        return $this->attributes["image"] ? Storage::url($this->attributes["image"]) : "/images/category.jpg";
    }

    /**
     * Relationship with the products
     */
    public function posts(){
        return $this->hasMany("App\Post", "category_id", "id");
    }

    /**
     * Relatioship with types
     */
    public function types(){
        return $this->hasMany("App\Type", "category_id", "id");
    }


}
