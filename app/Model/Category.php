<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'attributes'
    ];

    protected static $logAttributes = ['name', 'attributes'];
    
    protected static $logName = 'Category';

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Model has been {$eventName}";
    }

    public function getAllData($data){
        $query = $this->query();
        if($data->keyword !== null || isset($data->keyword)){
            $query->where('name', 'LIKE', '%'.$data->keyword.'%');
        }
        return $query->paginate(PAGINATE);
    }
}
