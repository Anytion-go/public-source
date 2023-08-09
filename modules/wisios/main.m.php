<?php
/*  * Copyright (c) 2022 ณวสันต์ วิศิษฏ์ศิงขร
    *
    * This source code is licensed under the MIT license found in the
    * LICENSE file in the root directory of this source tree.
*/
return new class
{
    public $Url = '';

    public function baseUrl($baseUrl)
    {
        $this->Url = $baseUrl;
    }
    public function Route($method, $url, $data = false, $header = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            if (gettype($data) == 'array') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        /************** */
        $headers = (object)[];
        curl_setopt(
            $ch,
            CURLOPT_HEADERFUNCTION,
            function ($curl, $heading) use (&$headers) {
                $len = strlen($heading);
                $heading = explode(':', $heading, 2);
                if (count($heading) < 2) // ignore invalid headers
                    return $len;

                $headers->{trim($heading[0])} = trim($heading[1]);

                return $len;
            }
        );
        /************** */
        $response = curl_exec($ch);
        if (isset($headers->{'Content-Type'})) {
            if (strpos($headers->{'Content-Type'}, 'json') !== false) {
                $response = json_decode($response);
            }
        } elseif (isset($headers->{'content-type'})) {
            if (strpos($headers->{'content-type'}, 'json') !== false) {
                $response = json_decode($response);
            }
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        /************** */
        if ($e = curl_error($ch)) {
            curl_close($ch);
            return $e;
        } else {
            curl_close($ch);

            return (object) [
                "status" => $httpcode,
                "headers" => $headers,
                "data" => $response
            ];
        }
    }

    public function get($url, $data = false, $header = false)
    {
        return $this->Route('GET', $url, $data, $header);
    }
    public function post($url, $data = false, $header = false)
    {
        return $this->Route('POST', $url, $data, $header);
    }
    public function put($url, $data = false, $header = false)
    {
        return $this->Route('PUT', $url, $data, $header);
    }
    public function delete($url, $data = false, $header = false)
    {
        return $this->Route('DELETE', $url, $data, $header);
    }
};
