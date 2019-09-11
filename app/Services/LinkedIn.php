<?php

namespace App\Services;

class LinkedIn
{
    public function __construct()
    {

    }

    public function getAuthorized() {
        $csrfLinkedIn = random_int(111111, 99999999999);
        session(['csrfLinkedIn' => $csrfLinkedIn]);

        $url = "https://www.linkedin.com/oauth/v2/authorization";
        $url.= "?response_type=code";
        $url.= "&client_id=".env('LINKEDIN_API_ID');
        $url.= "&redirect_uri=http://skillful.test/linkedin/callback";
        $url.= "&state=".$csrfLinkedIn;
        $url.= "&scope=r_emailaddress%20r_liteprofile";
        return $url;
    }

    public function getAccessToken($code, String $state, $error, $error_description) {
        if ($error !== null) {
            return false;
        };

        if ($state === strval(session('csrfLinkedIn'))) {
            $url = "https://www.linkedin.com/oauth/v2/accessToken";
            $url.= "?grant_type=authorization_code";
            $url.= "&code=".$code;
            $url.= "&redirect_uri=http://skillful.test/linkedin/callback";
            $url.= "&client_id=".env('LINKEDIN_API_ID');
            $url.= "&client_secret=".env('LINKEDIN_API_SECRET');

            $ch = curl_init($url);

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: x-www-form-urlencoded'
                ],
                CURLOPT_POST => 1,
            ]);

            $result = curl_exec($ch);
            curl_close($ch);

            if ($result) {
                $decodedResult = json_decode($result);

                // TODO: Now make sure to securely HASH the access token, and save it to the user's account
                // 1) If the user is logged in already, add the access token to the user entry in the DB
                // 2) If the user is not logged in, first we should grab the email address from the linkedin profile
                //    Then we check if it does not conflict with the email address of another user, and add him to the database.
                //    If there is a conflict, we give them the option to

                // TODO: Consider what to do about user names.

                // TODO: Make password optional (nullable), since we can use LinkedIn access token instead
                dd($decodedResult);
            }

            dd($result);
        }
        return true;
    }
}
