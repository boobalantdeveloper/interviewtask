<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
use Redirect;

class LoginController extends BaseController
{
    public function Index(Request $request)
    {
        if (Auth::user() && Auth::user()->user_role == 1) {
            return redirect()->route("dashboard");
        } elseif (Auth::user()) {
            return redirect()->route("home");
        }
        return view("login.login");
    }

    public function DoLogin(Request $request)
    {
        $credentials = $request->validate([
            "username" => ["required"],
            "password" => ["required"],
        ]);
        $username = $request->input("username");

        if (
            Auth::attempt([
                "username" => $request->input("username"),
                "password" => $request->input("password"),
            ])
        ) {
            $username = Auth::user()->username;
            $user_role = Auth::user()->user_role;
            $user_id = Auth::user()->id;

            if (Auth::check()) {
                $request->session()->regenerate();
                $request->session()->put("user_role", $user_role);
                $request->session()->put("username", $username);
                $request->session()->put("user_id", Auth::id());

                return redirect()
                    ->route("dashboard")
                    ->with("message", "You have logged in successfully");
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors(
                        " The username/password combo does not exist."
                    );
            }
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors("The username/password combo does not exist.");
        }
    }

    public function DoLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()
            ->route("login")
            ->with("message", "You are logged out!");
    }

    public function Home()
    {
        return View::make("home");
    }
}
