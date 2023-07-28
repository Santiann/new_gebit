<?php namespace Dealix\Register\Classes;

use Auth;
use Mail;
use RainLab\User\Models\User as UserModel;

class Invite
{
    public static function registerAndInvite($name, $email, $user_host)
    {
        try {
            $data['name'] = $name;
            $data['email'] = $email;
            $data['password'] = $data['password_confirmation'] = 'tmp123456';
            $data['reset_password_code'] = $resetCode = \Str::random(42);
            $user = Auth::register($data);
            
            $code = implode('!', [$user['id'], $data['reset_password_code'] ]);
            $link = url('/').'/login/?reset='.$code;
            $data = [
                'name' => $name,
                'link' => $link,
                'code' => $code,
                'user_host' => $user_host,
            ];
    
            Mail::send('rainlab.user::mail.invite_system', $data, function($message) use ($user) {
                $message->to($user['email'], $user['name']);
            });

            return ['success' => 1];
        }
        catch(\Exception $e) {
            return ['success' => 0, 'exception' => $e->getMessage()];
        }
    }
}