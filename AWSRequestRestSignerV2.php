<?php
/**
 * Author: roberb
 * Date: 16/09/16
 * Time: 20:59
 * @see http://docs.aws.amazon.com/AWSECommerceService/latest/DG/rest-signature.html
 */

class AWSRequestRestSignerV2
{

    var $url, $aws_secret_key, $aws_associate_tag;

    /**
     * AWSRequestRestSignerV2 constructor.
     * @param $url
     * @param $aws_secret_key
     * @param $aws_associate_tag
     */
    function __construct($url, $aws_secret_key, $aws_associate_tag)
    {
        $this->url = $url;
        $this->aws_secret_key = $aws_secret_key;
        $this->aws_associate_tag = $aws_associate_tag;
    }

    /**
     * @return string signed url
     */
    function getSignedUrl()
    {
        $parsed_url = parse_url($this->url);
        $query = $this->http_format_query($parsed_url['query']);
        $query['Timestamp'] = gmdate("Y-m-d\TH:i:s\Z");
        $query['AssociateTag'] = $this->aws_associate_tag;
        ksort($query);
        $parsed_url['query'] = http_build_query($query,null, '&', PHP_QUERY_RFC3986);
        $string_to_sign = "GET\n".trim($parsed_url['host'])."\n".trim($parsed_url['path'])."\n".trim($parsed_url['query']);
        if (function_exists("hash_hmac")) {
            $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->aws_secret_key, True));
        } elseif (function_exists("mhash")) {
            $signature = mhash(MHASH_SHA256, $string_to_sign, $this->aws_secret_key);
        } else {
            die("No hash function available!");
        }
        $query['Signature'] = $signature;
        $parsed_url['query'] = $query;
        return $this->build_url($parsed_url);
    }

    /**
     * Returns an array version of string url query
     * @param string $query
     * @return array
     */
    function http_format_query($query){
        $formatted_query = array();
        $query = explode('&', $query);
        foreach ($query as $pairs){
            $query_parts = explode('=', $pairs);
            $formatted_query[$query_parts[0]] = $query_parts[1];
        }
        return $formatted_query;
    }


    /**
     * @param $parsed_query
     * @return string
     */
    function build_url($parsed_query) {
        return $parsed_query['scheme'] . '://' . $parsed_query['host'] . $parsed_query['path'] .'?'.http_build_query($parsed_query['query'],null, '&', PHP_QUERY_RFC3986);
    }
}