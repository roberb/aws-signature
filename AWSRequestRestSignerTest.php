<?php
/**
 * Created by PhpStorm.
 * User: roberb
 * Date: 16/09/16
 * Time: 21:54
 */

require('./AWSRequestRestSignerV2.php');

$signatureObj = new AWSRequestRestSignerV2 (
    'http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&Operation=ItemLookup&ItemId=0679722769&ResponseGroup=Images,ItemAttributes,Offers,Reviews&Version=2013-08-01',
    '1234567890',
    'mytag-20'
);

print $signatureObj->getSignedUrl();