<?php
namespace App\Services;

use App\Model\EmailTemplate;

class EmailTemplateService extends Service
{
    public function __construct(EmailTemplate $emailTemplate){
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
}