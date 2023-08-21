<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int $id
 * @property  int $user_id
 * @property string $name
 * @property string $message
 * @property Carbon $notify_at
 *
 */
class Goal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'notify_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
