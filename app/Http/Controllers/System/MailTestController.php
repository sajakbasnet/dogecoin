<?php

namespace App\Http\Controllers\System;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Services\System\MailService;
use Illuminate\Http\Request;

class MailTestController extends ResourceController
{
    public function __construct(MailService $mailService)
    {
        parent::__construct($mailService);
    }
    public function moduleName()
    {
        return 'mail-test';
    }
    public function viewFolder()
    {
        return 'system.mailtest';
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'fromemail' => 'email|required|max:255',
            'fromname' => 'string|required|max:255',
            'toemail' => 'email|required|max:255',
            'toname' => 'string|required|max:255',
            'subject' => 'string|required|max:255',
            'body' => 'required|string',
        ]);
        try {
            $response = $this->service->sendMail($request);
            return redirect()->back()->withErrors(['success' => 'Mail Sent successfully .']);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
