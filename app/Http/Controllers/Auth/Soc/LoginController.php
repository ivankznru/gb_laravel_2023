<?php

namespace App\Http\Controllers\Auth\Soc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Contracts\User as UserOAuth;

class LoginController extends Controller
{
    const supportedDrivers = ["github"];
    public static function isSupported(string $socialiteDriver)
    {
        return in_array($socialiteDriver, self::supportedDrivers);
    }
    /**
     * Redirects to error page if driver not supported
     *
     * @param string $socialiteDriver
     * @return void
     */
    public static function returnNotSupported(string $socialiteDriver)
    {
        //NOTE: No need htmlspecialchars()
        return redirect()->route('home')->with('error', 'Authorization via "' . $socialiteDriver . '" is not supported!');
    }
    public static function returnAuthError(string $socialiteDriver)
    {
        return redirect()->route('home')->with('error', 'Authorization via "' . $socialiteDriver . '" failed!');
    }
    public function login(string $socialiteDriver)
    {
        if (!self::isSupported($socialiteDriver)) {
            return self::returnNotSupported($socialiteDriver);
        }
        return Socialite::driver($socialiteDriver)->redirect();
    }


    public function response(string $socialiteDriver)
    {
        if (!self::isSupported($socialiteDriver)) {
            return self::returnNotSupported($socialiteDriver);
        }

        try {
            $socUser = Socialite::driver($socialiteDriver)->user();

            //Check external ID existence
            if (empty(trim($socUser->getId()))) {
                return self::returnAuthError($socialiteDriver);
            }
            $user = User::updateOrCreate([
                'id_in_soc' => $socUser->id,
            ], [
                'name' => !empty($socUser->getName()) ? $socUser->getName() : (!empty($socUser->nickname) ? $socUser->nickname : 'Noname user'),
                'email' => !empty($socUser->email) ? $socUser->email : '',
                'password' => '',
                'id_in_soc' => $socUser->getId(),
                'type_auth' => $socialiteDriver,
                'avatar' => !empty($socUser->avatar) ? $socUser->avatar : '',

            ]);
            Auth::login($user);
            return redirect()->route('home')->with('success', 'Authorization "' . $socialiteDriver . '" successful!'
                . ' Wellcome, ' . $user->name . '!');
        } catch (\Exception $e) {

            return self::returnAuthError($socialiteDriver);
        }
    }
}
