<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    use HasUuids;
    // * guarded pour éviter de devoir citer tout les champs fillables on lui donne ceux qui ne le sont pas c'est à dire aucun ici
    protected $guarded = [];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function oders(): BelongsToMany{
        return $this->belongsToMany(Order::class,'oder_id');
    }
    public function categories(): HasOne{
        return $this->hasOne(Category::class,'category_id');
    }
    public function materials(): HasOne{
        return $this->hasOne(Material::class,'material_id');
    }
    public function pmodels(): HasOne{
        return $this->hasOne(Pmodel::class,'pmodel_id');
    }
}
