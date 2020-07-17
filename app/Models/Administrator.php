<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Administrator extends Model
{
    const PASSWORD_REGEX = '^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8}$';

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function getFirstnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function getLastnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNicknameAttribute($value)
    {
        $this->attributes['nickname'] = mb_strtolower($value);
    }

    public function getNicknameAttribute($value)
    {
        return mb_strtolower($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value);
    }

    public function getEmailAttribute($value)
    {
        return mb_strtolower($value);
    }

    public static function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|min:2|max:255',
            'lastname' => 'required|min:2|max:255',
            'nickname' => 'required|min:2|max:255|unique:administrators',
            'email' => 'required|unique:administrators',
            'password' => 'required|confirmed|regex:/'.self::PASSWORD_REGEX.'/i',
            'lang' => 'required',
            'isActivated' => 'nullable',
        ]);
    }

    public function storeValues(array $values)
    {
        $this->firstname = $values['firstname'];
        $this->lastname = $values['lastname'];
        $this->nickname = $values['nickname'];
        $this->email = $values['email'];
        $this->password = $values['password'];
        $this->lang = $values['lang'];
        $this->isActivated = $values['isActivated'];

        $this->save();
    }

    public static function check(\Illuminate\Http\Request $request): bool
    {
        if (! $request->session()->has('admin_id')) {
            return false;
        }

        if (! $request->session()->has('admin_token')) {
            return false;
        } 

        $id = $request->session()->get('admin_id');
        $token = $request->session()->get('admin_token');
        // $currentIpAddress = $request->ip(); // Maybe not a good idea

        if (null === $admin = Administrator::where('id', $id)->first()) {
            return false;
        } 

        if (! Hash::check($token, $admin->sessionToken)) {
            return false;
        }
        
        return true;
    }

    public function generateSessionToken(): string
    {
        $sessionToken = bin2hex(random_bytes(5));
        $this->sessionToken = Hash::make($sessionToken);
        $this->save();

        return $sessionToken;
    }
}
