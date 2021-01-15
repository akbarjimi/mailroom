<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Stringable;

class Letter extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'letters';

    protected $fillable = [
        'id',
        'lettertype_id',
        'project_id',
        'user_id',
        'row',
        'title',
        'date',
    ];

    protected $casts = [
        'id' => 'string',
        'row' => 'integer',
        'title' => Stringable::class,
        'date' => 'date',
    ];

    public function lettertype()
    {
        return $this->belongsTo(LetterType::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id',__FUNCTION__);
    }
}
