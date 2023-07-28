<?php namespace Dealix\Register\Classes;

use Dealix\Register\Models\User_Auth as User;
use Auth;
use Session;
use File;
use Storage;
use Str;
use Db;
use Lang;
use Mail;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Controller;
use RainLab\User\Models\User as UserModel;
use Dealix\Register\Models\User_Auth;

class Password
{
    /**
     * Trigger the password reset email
     */
    public static function onRestorePassword()
    {
        $user = UserModel::findByEmail(post('email'));
        if (!$user || $user->is_guest) {
            throw new ApplicationException(Lang::get(/*A user was not found with the given credentials.*/'rainlab.user::lang.account.invalid_user'));
        }

        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);

        $link = self::makeResetUrl($code);

        $data = [
            'name' => $user->name,
            'username' => $user->username,
            'link' => $link,
            'code' => $code
        ];

        Mail::send('rainlab.user::mail.restore', $data, function($message) use ($user) {
            $message->to($user->email, $user->full_name);
        });
    }

    /**
     * Returns a link used to reset the user account.
     * @return string
     */
    private static function makeResetUrl($code)
    {
        return url('/') . '/login?reset=' . $code;
    }

    public static function changePasswordOnSystem($email, $password)
    {
        $user = User_Auth::findByEmail($email)->first();
        $user->password = $password;
        $user->save();

        \Session::put('user_email', $email);
    }
}