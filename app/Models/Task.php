<?php

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public string $description;
    public bool $completed;
    private DateTimeImmutable $creationDate;
    protected $fillable = ['description', 'completed'];
}
