<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory,HasUuids;
    // * guarded pour éviter de devoir citer tout les champs fillables on lui donne ceux qui ne le sont pas c'est à dire aucun ici
    protected $guarded = [];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class,'product_id');
    }
}
