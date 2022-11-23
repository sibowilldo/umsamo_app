<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentMeta extends Model
{
    use HasFactory;
    protected $fillable = ['attachment_id', 'metadata'];

    protected $casts = [
        'metadata' => 'json'
    ];

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
}
