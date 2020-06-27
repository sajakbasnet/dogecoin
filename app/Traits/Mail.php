<?php

namespace App\Traits;

use App\Model\EmailTemplate;
use Config;

trait Mail
{
    public function parseEmailTemplate($data, $emailCode)
    {
        $replace = [];
        $with = [];

        if (isset($data)) {
            $message = EmailTemplate::where('code', $emailCode)->first();
            $translation = $message->emailTranslations->where('language_code', 'en')->first();
            foreach ($data as $key => $value) {
                array_push($replace, $key);
                array_push($with, $value);
            }
            $message_body = $translation->template;
            $this->subject($translation->subject);
            $this->from($message->from ?? Config::get('constants.FROM_MAIL'));
            $content = str_replace($replace, $with, $message_body);
            return $content;
        }
    }
}
