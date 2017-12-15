<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

$router->get('/', function () {
    $candidates = DB::table('candidates')->get();

    return view('index', compact('candidates'));
});

$router->get('/candidate', function () {
    $candidate = (object) [
        'id' => null,
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'role' => '',
        'linkedin' => '',
        'avatar' => ''
    ];

    return view('form', compact('candidate'));
});

$router->get('/candidate/{id:[0-9]+}', function ($id) {
    $candidate = DB::table('candidates')->where('id', $id)->first();

    return view('form', compact('candidate'));
});

$router->post('/candidate', function (Request $request) {
    $this->validate($request, [
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => "required|email|unique:candidates|max:255",
        'role' => 'required|max:255',
        'linkedin' => 'required|url'
    ]);

    $firstname = $request->input('firstname');
    $lastname = $request->input('lastname');
    $email = $request->input('email');
    $role = $request->input('role');
    $linkedin = $request->input('linkedin');
    $avatar = null;

    if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
        $avatar = $request->file('avatar');
        $avatar = $avatar->move('./assets/avatars', "{$email}.{$avatar->guessExtension()}");
    }

    $data = compact('firstname', 'lastname', 'email', 'role', 'linkedin', 'avatar');

    if (DB::table('candidates')->insert($data)) {
        return response()->json(['redirect' => '/'], 200);
    } else {
        return response()->json(['error' => 'Algo inesperado aconteceu'], 500);
    }
});

$router->post('/candidate/{id:[0-9]+}', function (Request $request, $id) {
    $this->validate($request, [
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => "required|email|unique:candidates,id,{$id}|max:255",
        'role' => 'required|max:255',
        'linkedin' => 'required|url'
    ]);

    $firstname = $request->input('firstname');
    $lastname = $request->input('lastname');
    $email = $request->input('email');
    $role = $request->input('role');
    $linkedin = $request->input('linkedin');
    $avatar = null;

    if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
        $avatar = $request->file('avatar');
        $avatar = $avatar->move('./assets/avatars', "{$email}.{$avatar->guessExtension()}");
    }

    if ($avatar === null) {
        $data = compact('firstname', 'lastname', 'email', 'role', 'linkedin');
    } else {
        $data = compact('firstname', 'lastname', 'email', 'role', 'linkedin', 'avatar');
    }

    if (DB::table('candidates')
        ->where('id', $id)
        ->update($data)) {
        return response()->json(['redirect' => '/'], 200);
    } else {
        return response()->json(['error' => 'Algo inesperado aconteceu'], 500);
    }
});

$router->delete('/candidate/{id:[0-9]+}', function ($id) {
    $candidate = DB::table('candidates')->select('avatar')->where('id', $id)->first();

    if (file_exists($candidate->avatar)) {
        unlink($candidate->avatar);
    }

    if (DB::table('candidates')->where('id', $id)->delete()) {
        return response()->json(['redirect' => '/'], 200);
    } else {
        return response()->json(['error' => 'Algo inesperado aconteceu'], 500);
    }
});