<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Guest;

class TokenController extends Controller
{
    /**
     * Validate or generate a new guest token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guest = null;
        $token = filterTokenValue($request->cookie('token', ''));

        if (!empty($token)) {
            $guest = Guest::byToken($token)
                ->first();

            if ($guest) {
                return response()->json([])
                    ->cookie('token', $token);
            }
        }

        $token = md5(hexdec(uniqid()));
        $guest = Guest::create([
            'token' => $token,
        ]);

        return response()->json([])
            ->cookie('token', $token);
    }
}
