<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueClassRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $modelInstance;

    public function __construct($modelInstance)
    {
        $this->modelInstance = $modelInstance;
    }

    public function passes($attribute, $value)
    {
        $query = User::where('class', $value);
      
        if ($this->modelInstance) {
            $query->where('id', '<>', $this->modelInstance);
        }

        return !$query->exists();
    }

    public function message()
    {
        return 'The selected class is already taken.';
    }
}
