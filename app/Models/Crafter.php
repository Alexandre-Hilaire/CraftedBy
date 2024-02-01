<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crafter extends Model
{
    use HasFactory;
    use HasUuids;
    // * guarded pour éviter de devoir citer tout les champs fillables on lui donne ceux qui ne le sont pas c'est à dire aucun ici
    protected $guarded = [];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
