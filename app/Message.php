<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";

    protected $guarded = [];

    public $timestamps = true;

    protected $casts = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the messages.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatDateAttribute(){

        return $this->created_at->format('H:m  F d');
    }
}
