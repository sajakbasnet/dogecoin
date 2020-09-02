<?php

namespace App\Model;

use Carbon\Carbon;
use Spatie\TranslationLoader\LanguageLine;
use Spatie\Activitylog\Traits\LogsActivity;

class Locale extends LanguageLine
{
    use LogsActivity;

    protected $table = 'language_lines';

    /** @var array */
    public $translatable = ['text'];

    /** @var array */
    public $guarded = ['id'];

    /** @var array */
    protected $casts = ['text' => 'array'];

    protected static $logAttributes = ['text'];

    protected static $logName = 'Translation';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $authUser = authUser();
        $now = Carbon::now()->format('yy-m-d H:i:s');
        return "Locale of id {$this->id} was <strong>{$eventName}</strong> by {$authUser->name} at {$now}.";
    }
}
