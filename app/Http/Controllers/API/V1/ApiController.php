<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Psr\Http\Message\ServerRequestInterface;
// use Zend\Diactoros\Response as Psr7Response;
// use League\OAuth2\Server\AuthorizationServer;
// use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;

class ApiController extends Controller
{
    // use HandlesOAuthErrors;

    // protected $server;

    // public function __construct(AuthorizationServer $server)
    // {
    //     $this->server = $server;
    // }


    /**
     * Login to the app to receive access token
     *
     * @param ServerRequestInterface
     * @param \App\User
     * @return json
     */
    // public function login(ServerRequestInterface $request, $provider)
    // {
    //     return $this->withErrorHandling(function () use ($request, $provider) {
    //         return $this->convertResponse(
    //             $this->server->respondToAccessTokenRequest($request, new Psr7Response),
    //             $provider
    //         );
    //     });
    // }

    /**
     * Convert a PSR7 response to json
     *
     * @param \Psr\Http\Message\ResponseInterface $psrResponse
     * @param \App\Customer
     * @return json
     */
    // public function convertResponse($psrResponse, $provider = null)
    // {
    //     $oAuthResponse = json_decode($psrResponse->getBody(), true);

    //     if (array_has($oAuthResponse, 'error')) {
    //         return $this->respondWithFailure($oAuthResponse['message']);
    //     }

    //     $data = ['token' => $oAuthResponse];


    //     $customerDetails = new CustomerResource($provider);

    //     return $this->respond(
    //         'Logged in successfully',
    //         $data,
    //         true,
    //         $psrResponse->getStatusCode()
    //     );
    // }


    /**
    * Processes an array and returns individual array for each of the element
    *
    * @param array
    * @return array
    */
    // public function processStaticOptions($options)
    // {
    //     return collect($options)->map(function ($item, $key) {
    //         return [
    //             'key' => $key,
    //             'value' => $item,
    //         ];
    //     })->values();
    // }
}
