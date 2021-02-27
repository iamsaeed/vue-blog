<?php

namespace App;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Search;

    protected $fillable = ['name', 'description'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
