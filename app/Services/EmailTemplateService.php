<?php

namespace App\Services;

use App\Model\EmailTemplate;

class EmailTemplateService extends Service
{
    public function __construct(EmailTemplate $emailTemplate)
    {
        parent::__construct($emailTemplate);
    }
    public function getAllData($data, $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('title', 'LIKE', '%' . $data->keyword . '%');
        }
        if ($pagination) return $query->orderBy('id', 'DESC')->paginate(PAGINATE);
        return $query->orderBy('id', 'DESC')->get();
    }

    public function indexPageData($data)
    {
        return ['items' => $this->getAllData($data)];
    }
    public function store($request)
    {
        $emailTemplate = $this->model->create($this->parseRequest($request));
        $emailTemplate->emailTranslations()->createMany($request->get('multilingual'));
        return $emailTemplate;
    }
    public function editPageData($id)
    {
        $email = $this->itemByIdentifier($id);
        return [
            'item' => $email,
        ];
    }
    public function update($id, $request)
    {
        $emailTemplate = $this->itemByIdentifier($id);
        $emailTemplate->emailTranslations()->delete();
        $emailTemplate = $this->model->update($this->parseRequest($request));
        $emailTemplate = $this->itemByIdentifier($id);
        $emailTemplate->emailTranslations()->createMany($request->get('multilingual'));
        return $emailTemplate;
    }

    public function parseRequest($request)
    {
        return $request->only('title', 'code', 'from');
    }
}
