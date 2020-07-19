<?php
namespace App\Services;

use App\Exceptions\UnauthorizedException;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileService extends Service
{
    public function __construct(User $user){
        parent::__construct($user);
    }

    public function indexPageData($data)
    {
        return [
            'item' =>$this->itemByIdentifier(authUser()->id)
        ];
    }

    public function update($id, $request)
    {
       if(authUser()->id != $id) throw new UnauthorizedException();
       $data = $request->only('password');
       $user = $this->itemByIdentifier($id);
       return $user->update([
            'password' => Hash::make($data['password'])
       ]);
    }
}