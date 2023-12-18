<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class YourModel extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Buat slug menggunakan judul atau kolom lain yang ingin Anda gunakan
            $slug = Str::slug($model->judul);

            // Pastikan slug unik
            $uniqueSlug = $slug;
            $counter = 1;
            while (static::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $counter;
                $counter++;
            }

            $model->slug = $uniqueSlug;
        });
    }
}


class Learn extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['title', 'video', 'description'];

    // method
    public function Video(): Attribute
    {
        return Attribute::make(
            get: fn ($video) => asset('/storage/video-learn/' . $video)
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Buat slug menggunakan judul atau kolom lain yang ingin Anda gunakan
            $slug = Str::slug($model->title);

            // Pastikan slug unik
            $uniqueSlug = $slug;
            $counter = 1;
            while (static::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $counter;
                $counter++;
            }

            $model->slug = $uniqueSlug;
        });
    }
}
