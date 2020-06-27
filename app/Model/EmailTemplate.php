<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'title', 'code', 'from'
    ];

    public function emailTranslations(){
        return $this->hasMany(EmailTemplateTranslation::class, 'email_template_id', 'id');
    }
}
