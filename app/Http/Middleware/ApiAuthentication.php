<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Request;

class ApiAuthentication
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $start_time = microtime(true);
        $token = $request->header('jwt');

        $list_endpoint = array('/api/v1/apps', '/api/v1/apps/regex:[0-9]/detail', '/api/v1/apps/regex:[0-9]/review-feedback', '/api/v1/apps/list-category', '/api/v1/ads');
        $check_url = explode('?', Request::getRequestUri());
        $local_status = env('LOCAL_STATUS', false);
        if($local_status){
            $check_url[0] = str_replace('/cms-etalase-app/public', '', $check_url[0]);
        }
        $search_details = explode('/', $check_url[0]);
        if(in_array($check_url[0], $list_endpoint) || $search_details[count($search_details) - 1] == 'detail' || $search_details[count($search_details) - 1] == 'review-feedback'){
            $public_token = $request->header('signature');
            if($token == null){
                if($public_token == env('PUBLIC_TOKEN')){
                    $request->sdk_version = "40";
                    $request->user_id = 0;
                    return $next($request)->header('Cache-Control', 'no-cache, must-revalidate');
                } else {
                    return response()->json([
                        'message' => "Signature verification failed"
                    ], 403);
                }
            }
        }
        
        if($token == null) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => "API Key is Missing"
            ], 403);
        }
        $tks = explode('.', $token);
        if (count($tks) != 3) {
            return response()->json([
                'message' => "Signature verification failed"
            ], 403);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            $request->user_email = $credentials->sub->email;
            $request->username = $credentials->sub->name;
            $request->user_id = $credentials->sub->id;
            return $next($request)->header('Cache-Control', 'no-cache, must-revalidate');
        } catch(\Firebase\JWT\ExpiredException $e) {
            return response()->json([
                'message' => "API Key is Expired"
            ], 403);
        } catch(\Firebase\JWT\SignatureInvalidException $e) {
            return response()->json([
                'message' => "Signature verification failed"
            ], 403);
        } catch(\Firebase\JWT\Exception $e) {
            return response()->json([
                'message' => "API Key is Something Went Wrong"
            ], 403);
        } catch (Exception $e) {
            return response()->json([
                'message' => "API Key is Something Went Wrong"
            ], 403);
        }

        return $next($request)->header('Cache-Control', 'no-cache, must-revalidate');

    }

}
