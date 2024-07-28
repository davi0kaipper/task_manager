<?php

namespace App\Models;

use App\Models\Scopes\LoggedUserScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory, HasUuids;

    public string $description;
    public bool $completed;
    protected $fillable = ['description', 'completed', 'user_id'];

    protected static function booted(): void
    {
        static::addGlobalScope(new LoggedUserScope());
    }

    protected function completed(): Attribute
    {
        return Attribute::make(
            get: fn (int $completed) => (bool) $completed
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
