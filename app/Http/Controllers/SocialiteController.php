<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use App\Models\Apis\User;
use Session;
use Validator;
use Laravel\Socialite\Facades\Socialite;
class SocialiteController extends Controller
{
    const DRIVER_LINKEDIN = 'linkedin';
    const DRIVER_TWITTER = 'twitter';
    public function redirectToLinkedin()
    {
        return Socialite::driver(self::DRIVER_LINKEDIN)->scopes(['r_liteprofile', 'r_emailaddress'])->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver(self::DRIVER_LINKEDIN)->user();

            $verifiedUser = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->token,
                'RefreshToken' => $user->refreshToken,
                'isConnected' => true,
            ];

            User::where('google_id', Auth::user()->google_id)->update([
                'linkedin_account' => json_encode($verifiedUser)
            ]);

            return redirect()->route('user-profile')->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Your LinkedIn profile has been connected successfully.']);
        } catch (Exception $e) {
            return redirect()->route('user-profile')->with(['status' => 'Error', 'class' => 'warning', 'msg' => 'Something went wrong!']);
        }
    }

    public function redirectToTwitter()
    {
        return Socialite::driver(self::DRIVER_TWITTER)->redirect();
    }

    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver(self::DRIVER_TWITTER)->user();
            $verifiedUser = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->token,
                'isConnected' => true,
            ];

            User::where('google_id', Auth::user()->google_id)->update([
                'twitter_account' => json_encode($verifiedUser)
            ]);

            return redirect()->route('user-profile')->with(['status' => 'Success', 'class' => 'success', 'msg' => 'Your Twitter profile has been connected successfully.']);
        } catch (Exception $e) {
            return redirect()->route('user-profile')->with(['status' => 'Error', 'class' => 'warning', 'msg' => 'Something went wrong!']);
        }
    }
}
