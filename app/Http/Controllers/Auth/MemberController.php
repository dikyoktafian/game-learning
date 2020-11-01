<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Auth;
use Route;
use Socialite;

use AppHelper;

use Illuminate\Support\Facades\Validator;
use App\Models\Member;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:members', ['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.member-login');
    }
    
    public function showRegisterForm()
    {
        if (AppHelper::isMobile()) {
            return view('auth.member_register');
        } else {
            return view('auth.desktop.member_register');
        }
    }
    
    public function showForgotForm()
    {
        if (AppHelper::isMobile()) {
            return view('auth.member_forgot');
        } else {
            return view('auth.desktop.member_forgot');
        }
    }
    
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
          'email'   => 'required|email',
          'password' => 'required|min:6'
      ]);
    
      $getData = Member::where('email', $request->email)->first();
      if($getData){
              if (Auth::guard('members')->attempt([
                  'email' => $request->email, 
                  'password' => $request->password
              ], $request->remember)) {
                  // if successful, then redirect to their intended location
                  $request->session()->put('userName', $getData->name);
                  $request->session()->put('userMail', $getData->email);
                  return redirect()->intended(url('home'));
              }
              // if unsuccessful, then redirect back to the login with the form data
              return redirect()->back()->withErrors(['failure' => 'You enter wrong password'])->withInput($request->only('email', 'remember'));
      }else{
          return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['failure' => 'No account associated with this email address.']);
      }
    }
        
    public function register(Request $request)
    {
      // Validate the form data
      $validator = Validator::make($request->all(), [
        'name'   => 'required',
        'email'   => 'required|email|unique:members',
        'mobile'   => 'required|unique:members',
        'password' => 'required|min:8'
      ],
      [
        'name.required'    => 'Fulname is required.',
        'email.required'    => 'Email Address is required',
        'email.email'    => 'Email Address must be a valid email address.',
        'email.unique'    => 'Email Address is registerded.',
        'mobile.required' => 'Mobile is required',
        'mobile.unique' => 'Mobile is registered',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least :min characters',
      ]);
      if($validator->fails()) {
          return redirect(url('member/register'))->withErrors($validator)->withInput();
      }
      
      $input = $request->all();
      $token_key = md5($input['email']) . md5(gmdate('Y-m-d H:i:s', time() + 3600*7));
      $inputMember = [
        'name' => $input['name'], 
        'email' => $input['email'],
        'mobile' => $input['mobile'],
        'activate_token' => $token_key,
        'created_at' => gmdate('Y-m-d H:i:s', time() + 3600*7),
      ];

      if(@$input['provider']){
        $inputMember['provider'] = $input['provider'];
        $inputMember['provider_id'] = $input['provider_id'];
      } else {
          $inputMember['password'] = Hash::make($input['password']); 
      }
      $createId = Member::insertGetId($inputMember);
      
      if($createId > 0){

        #Send Email
          $gets = array(
            'email' => $input['email'],
            'fullname' => $input['name'],
            'url' => url('/member/activate?token='.$token_key.'&email='.$input['email'])
          );
        
          Mail::send('email.regmail', $gets, function ($message) use ($gets) {
            $message->from('no-reply@blackxperience.com', 'WhatCar');
            $message->to($gets['email'])->subject('Action required to activate your account');
          });
        #end Send Email

        return redirect(url('member/login'))->withErrors(['success' => 'Registration is successful, please activate the account with the link that was sent by email']);
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    
    public function forgot(Request $request) {
        $email = $request->email;
        $member = Member::where('email', $email)->first();
        if(empty($member)) {
            return redirect(url('member/forgot'))->withErrors(['failure' => 'Account not registered']);
        } else if ($member->email_verified_at == null) {
            return redirect(url('member/forgot'))->withErrors(['failure' => 'Account not activated']);
        }
        
        #Send Email
          $gets = array(
            'email' => $email,
            'url' => url('/member/reset?token='.$member->activate_token.'&email='.$email)
          );
        
          Mail::send('email.forgotmail', $gets, function ($message) use ($gets) {
            $message->from('no-reply@blackxperience.com', 'WhatCar');
            $message->to($gets['email'])->subject('Action required to reset your password');
          });
        #end Send Email
        
        return redirect(url('member/forgot'))->withErrors(['success' => 'Please check the link that was sent by email to reset your password']);
    }
    
    public function reset(Request $request) {
        $token = $request->token;
        $email = $request->email;
        
        $member = Member::where('email', $email)->first();
        if(empty($member)) {
            return redirect(url('member/forgot'))->withErrors(['failure' => 'Account not registered']);
        } else if ($member->email_verified_at == null) {
            return redirect(url('member/forgot'))->withErrors(['failure' => 'Account not activated']);
        }
        
        if($token === $member->activate_token) {
            return view('auth.member_password')
                ->with('email', $email);
        } else {
            return redirect(url('member/forgot'))->withErrors(['failure' => 'Token invalid']);
        }
    }
    
    public function resetPassword(Request $request) {
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8'
        ],      
        [
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least :min characters',
        ]);
        if($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Member::where('email', $email)->update(
        [
            'password' => Hash::make($request->password),
            'updated_at' =>gmdate('Y-m-d H:i:s', time() + 3600*7)
        ]);
        
        return redirect(url('member/login'))->withErrors(['success' => 'Reset password success, please login to continue.']);
    }
    
    public function activationUser(Request $request) {
      $email = $request->email;
      //Cek jika sudah aktivasi
      $user = Member::where('email', $email)->first();
      if($user->email_verified_at != null) {
        return redirect(url('member/login'))->withErrors(['success' => 'Your account has been activated']);
      }
      
      if($user->activate_token === $request->token){
        Member::where('email', $email)->update(
          [
              'email_verified_at' => gmdate('Y-m-d H:i:s', time() + 3600*7),
              'updated_at' => gmdate('Y-m-d H:i:s', time() + 3600*7)
          ]);
        
        return redirect(url('member/login'))->withErrors(['success' => 'Your account has been successfully activated, please log in using the email address and password that you created']);
          
      } else {
        return redirect(url('member/login'))->withErrors(['failure' => 'Invalid activation link']);
      }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, Request $request)
    {
        $user = Socialite::driver($provider)->user();

        if($user) {
          $authUser = Member::where('email', $user->email)->first();
          if($authUser) {
            if ($authUser->email_verified_at == null) {
              return redirect(url('member/login'))->withErrors(['failure' => 'Account not activated.']);
            }
            Auth::guard('members')->loginUsingId($authUser->id, true);
            $request->session()->put('userName', $authUser->name);
            $request->session()->put('userMail', $authUser->email);
            return redirect('quiz-home');
          } else {
            // $inputMember = [
            //     'name' => $user->name, 
            //     'email' => $user->email,
            //     'email_verified_at' => gmdate('Y-m-d H:i:s', time() + 3600*7),
            //     'created_at' => gmdate('Y-m-d H:i:s', time() + 3600*7),
            // ];
            // $inputMember['provider'] = $provider;
            // $inputMember['provider_id'] = $user->id;
            // $createId = Member::insertGetId($inputMember);
            // Auth::guard('members')->loginUsingId($createId, true);
            // $request->session()->put('userName', $user->name);
            // $request->session()->put('userMail', $user->email);
            // return redirect('quiz-home');
            
            
            if (AppHelper::isMobile()) {
                return view('auth.member_register')
                    ->with('data', $user)
                    ->with('provider', $provider);
            } else {
                return view('auth.desktop.member_register')
                ->with('data', $user)
                ->with('provider', $provider);
            }
              
          }
        } else {
          return redirect(url('member/login'))->withErrors(['failure' => 'Cannot connect with google.']);
        }
        // $user->token;
    }

    public function logout(Request $request)
    {
        Auth::guard('members')->logout();
        $request->session()->forget('userName');
        $request->session()->forget('userMail');
        $request->session()->forget('userAnswer');
        $request->session()->forget('questId');
        $request->session()->forget('questions');
        return redirect('member/login');
    }
}
