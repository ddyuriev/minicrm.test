<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const STATUS_NEW = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_PROCESSED = 3;

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_PROCESSED => 'Обработан',
        ];
    }

    protected $fillable = [
        'customer_id', 'topic', 'text', 'status', 'date_of_response'
    ];

    protected $casts = [
        'date_of_response' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getFiles()
    {
        return $this->media;
    }

    public function getFileDownloadUrl(Media $file): string
    {
        return route('tickets.files.download', [$this, $file]);
    }

}
