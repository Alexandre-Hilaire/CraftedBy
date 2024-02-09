<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;
    use HasUuids;
    // * guarded pour éviter de devoir citer tout les champs fillables on lui donne ceux qui ne le sont pas c'est à dire aucun ici
    protected $guarded = [];

        /*
     * Si je veux ne pas envoyer certaines choses via la requète api
     */
     protected $hidden = ['id','created_at','updated_at', 'pmodel_id', 'user_id','status','customizable','is_active'];

    // * Sinon je peux juste dire ce que je veux transmettre
    // ? protected $visible = ['name', 'unit_price', 'description','color'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function oders(): BelongsToMany{
        return $this->belongsToMany(Order::class);
    }
    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class);
    }
    public function materials(): BelongsToMany{
        return $this->belongsToMany(Material::class);
    }
    public function pmodel(): BelongsTo{
        return $this->belongsTo(Pmodel::class,'pmodel_id');
    }
    public function images(): MorphMany{
        return $this->morphMany(Image::class, 'imagable');
    }
}
