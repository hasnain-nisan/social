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

   public function redirectToGithub()
   {
       return Socialite::driver('github')->redirect();
   }

   public function handleGithubCallback()
   {
       try {
           $user = Socialite::driver('github')->user();
        //    dd($user);
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->findOrCreateUser($user, 'github');
       Auth::login($authUser, true);
       return redirect($this->redirectTo);
   }

   public function redirectToGmail()
   {
       return Socialite::driver('google')->redirect();
   }

   public function handleGmailCallback()
   {
       try {
           $user = Socialite::driver('google')->user();
        //    dd($user);
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->findOrCreateUser($user, 'google');
       Auth::login($authUser, true);
       return redirect($this->redirectTo);
   }

   public function redirectToReddit()
   {
    return Socialite::driver('reddit')->redirect();
   }

   public function handleRedditCallback()
   {
       try {
           $user = Socialite::driver('reddit')->user();
           dd($user);
       } catch (Exception $e) {
           return redirect('/login');
       }

       $authUser = $this->findOrCreateUser($user, 'reddit');
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
               if($provider == 'twitter')
               {
                   //save profile_picture
                    $profileurl = $providerUser->avatar_original;
                    $image = file_get_contents($profileurl);
                    $profile = 'pro_pic' . rand() . '.jpg';
                    file_put_contents(public_path('img/'.$profile), $image);

                    //save cover photo
                    $coverurl = $providerUser->user['profile_banner_url'];
                    $cover = file_get_contents($coverurl);
                    $cover_name = 'cov_pic' . rand() . '.jpg';
                    file_put_contents(public_path('img/'.$cover_name), $cover);

                    $user = User::create([
                    'email' => $providerUser->email,
                    'name'  => $providerUser->name,
                    'user_name'  => $providerUser->nickname,
                    'profile_picture' => $profile,
                    'cover_photo' => $cover_name,

                    //    'password' => $providerUser->getPassword(),
                   ]);

                   $user->identities()->create([
                    'provider_id'   => $providerUser->getId(),
                   'provider_name' => 'twitter',
                  ]);
               }
               
               if($provider == 'facebook')
               {
                    // $url = $providerUser->avatar_original.'&access_token='.$providerUser->token;
                    
                    // $image = file_get_contents($url);
                    // $n = $user->name;
                    // file_put_contents(public_path('img/'.$n), $image);
                    
                   $user = User::create([
                   'email' => $providerUser->email,
                   'name'  => $providerUser->name,
                   'user_name'  => $providerUser->nickname,
                  'profile_picture' => 'ttt',
                   'cover_photo' => 'ccc',

                //    'password' => $providerUser->getPassword(),
               ]);

               $user->identities()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => 'facebook',
               ]);
               }

               if($provider == 'github')
               {
                  
                   //save profile_picture
                   $profileurl = $providerUser->avatar;
                   $image = file_get_contents($profileurl);
                   $profile = 'pro_pic' . rand() . '.jpg';
                   file_put_contents(public_path('img/'.$profile), $image);

                //    //save cover photo
                //    $coverurl = $providerUser->user['profile_banner_url'];
                //    $cover = file_get_contents($coverurl);
                //    $cover_name = 'cov_pic' . rand() . '.jpg';
                //    file_put_contents(public_path('img/'.$cover_name), $cover);

                   $user = User::create([
                        'email' => $providerUser->email,
                        'name'  => $providerUser->name,
                        'user_name'  => $providerUser->nickname,
                        'profile_picture' => $profile,
                        'cover_photo' => '',

                        //    'password' => $providerUser->getPassword(),
                    ]);

                    $user->identities()->create([
                        'provider_id'   => $providerUser->getId(),
                        'provider_name' => 'github',
                    ]);
               }

               if($provider == 'google')
               {
                   //save profile_picture
                   $profileurl = $providerUser->avatar_original;
                   $image = file_get_contents($profileurl);
                   $profile = 'pro_pic' . rand() . '.jpg';
                   file_put_contents(public_path('img/'.$profile), $image);

                   $user = User::create([
                        'email' => $providerUser->email,
                        'name'  => $providerUser->name,
                        'user_name'  => $providerUser->nickname,
                        'profile_picture' => $profile,
                        'cover_photo' => '',

                        //    'password' => $providerUser->getPassword(),
                    ]);

                    $user->identities()->create([
                        'provider_id'   => $providerUser->getId(),
                        'provider_name' => 'google',
                    ]);
               }
           }

           return $user;
       }
   }

    
}
