<?php

namespace FleetCart\Helpers;

class InternetBikes
{
    public static function login()
    {
        if (file_exists($file = public_path('portal/portal-internet.json'))) {
            $response = file_get_contents($file);
            $dataToken = json_decode($response);
            if (isset($dataToken->valid_until) && $dataToken->valid_until > time()) {
                return $dataToken;
            }
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://portal.internet-bikes.com/api/twm/auth/authenticate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query([
                'email' => 'charlesejim@gmail.com',
                'password' => 'Samlondon36'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
                "authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLnRlc3RcL2FwaVwvdHdtXC9hdXRoXC9hdXRoZW50aWNhdGUiLCJpYXQiOjE1NTY2OTg2NTAsImV4cCI6MTU1NjcwMjI1MCwibmJmIjoxNTU2Njk4NjUwLCJqdGkiOiJBYTdiS3d4cjFKQkFseTlJIiwic3ViIjoxOTIxMzMsInBydiI6IjhiNDIyZTZmNjU3OTMyYjhhZWJjYjFiZjFlMzU2ZGQ3NmEzNjViZjIifQ.U1emn8h7ArgefjlU5BpD8SaOdjvTAXirBm5Fa9Xpi-U}",
            ],
        ]);
        $response = curl_exec($curl);
        $path=  public_path('portal/errorx.log');
        // file_put_contents("../public/portal/errorx.log",print_r($response,true));
        file_put_contents( $path ,print_r($response,true));
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            $result = json_decode($response);
            if (isset($result->token) && !empty($result->token)) {
                file_put_contents($file, $response);
                return $result;
            } else {
                return false;
            }
        }
    }

    public static function getProducts($page = 0)
    {
        $accessTokenRow = self::login();
        if (!$accessTokenRow) return false;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://portal.internet-bikes.com/api/twm/products?page={$page}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer {$accessTokenRow->token}",
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    public static function getProPlusProducts()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://pateurope.com/api/v2/product",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer de035cbd6b0b14eb592c39265e89a495f9541a4e7cff2fb8940b9d3b8b8a186ec2522fe9452c4dfc805eb87c7dfe4b14fb22dd70651bb433b91e12244fe0936e"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
