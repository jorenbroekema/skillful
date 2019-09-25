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
            return null;
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
                $decodedResult = json_decode($result, true);
                return $decodedResult["access_token"];
            }
        }
        return null;
    }

    public function handleAuth(String $accessToken)
    {
        $profile = $this->getProfileInfo($accessToken);

        // 1) Check if user is already registered with the email address
        $email = $this->getEmail($accessToken);

        // 2) Register new user if no one with email address is registered
        $avatar = $this->getAvatar($profile);

        // 3) Authenticate if the user already exists with that email address

        dd($email, $profile, $avatar);
    }

    private function getAvatar(Array $data)
    {
        // Get the last avatar in the array which is the largest version (800x800)
        $avatarData = end($data["profilePicture"]["displayImage~"]["elements"]);
        $avatarURL = $avatarData["identifiers"][0]["identifier"];
    }

    private function getEmail(String $accessToken)
    {
        $url = "https://api.linkedin.com/v2/emailAddress";
        $url .= "?q=members&projection=(elements*(handle~))";

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Connection: Keep-Alive',
                'Authorization: Bearer '.$accessToken
            ]
        ]);

        $result = curl_exec($ch);

        curl_close($ch);

        return json_decode($result, true)["elements"][0]["handle~"]["emailAddress"];
    }

    private function getProfileInfo(String $accessToken)
    {
        $url = "https://api.linkedin.com/v2/me";
        $url .= "?projection=(id,firstName,lastName,profilePicture(displayImage~:playableStreams))";

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Connection: Keep-Alive',
                'Authorization: Bearer '.$accessToken
            ]
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}
