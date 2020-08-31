<?php

namespace App\Model;

use Spatie\TranslationLoader\LanguageLine;
use Spatie\Activitylog\Traits\LogsActivity;

class Locale extends LanguageLine
{
    protected $table = 'language_lines';

    /** @var array */
    public $translatable = ['text'];

    /** @var array */
    public $guarded = ['id'];

    /** @var array */
    protected $casts = ['text' => 'array'];

    use LogsActivity;

    protected static $logAttributes = ['text'];

    protected static $logName = 'Translation';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Model has been {$eventName}";
    }
}
