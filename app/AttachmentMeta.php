<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentMeta extends Model
{
    protected $fillable = ['attachment_id', 'metadata'];

    protected $casts = [
        'metadata' => 'json'
    ];

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
}
