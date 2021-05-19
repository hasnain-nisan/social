<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Socialite;
Use App\Models\User;
use App\Models\SocialIdentity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToTwitter()
   {
       return Socialite::driver('twitter')->redirect();
   }

   public function handleTwitterCallback()
   {
       try {
           $user = Socialite::driver('twitter')->user();
        //    dd($user);
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->findOrCreateUser($user, 'twitter');
       Auth::login($authUser, true);
       return redirect($this->redirectTo);
   }

   public function redirectToFacebook()
   {
       return Socialite::driver('facebook')->redirect();
   }

   public function handleFacebookCallback()
   {
       try {
           $user = Socialite::driver('facebook')->user();
        //    dd($user);
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->findOrCreateUser($user, 'facebook');
       Auth::login($authUser, true);
       return redirect($this->redirectTo);
   }


   public function findOrCreateUser($providerUser, $provider)
   {
       $account = SocialIdentity::whereProviderName($provider)
                  ->whereProviderId($providerUser->getId())
                  ->first();

       if ($account) {
           return $account->user;
       } else {
           $user = User::whereEmail($providerUser->getEmail())->first();

           if (! $user) {
               $user = User::create([
                   'email' => $providerUser->email,
                   'name'  => $providerUser->name,
                   'user_name'  => $providerUser->nickname,
                   'profile_picture' => $providerUser->avatar_original,
                   'cover_photo' => $providerUser->user['profile_banner_url'],

                //    'password' => $providerUser->getPassword(),
               ]);
           }

           $user->identities()->create([
               'provider_id'   => $providerUser->getId(),
               'provider_name' => 'twitter',
           ]);

           return $user;
       }
   }

    
}
