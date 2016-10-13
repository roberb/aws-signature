# PHP AWSRequestRestSignerV2

[![N|Solid](http://docs.aws.amazon.com/images/aws_logo_105x39.png)](https://aws.amazon.com/)
## What is
AWSRequestRestSignerV2 is a URL signer (AWS signature V2) for Amazon Web Services REST requests written in PHP. For a given URL, AWS Secret Key and AWS Associate Tag, you can get the signed URL ready to make an AWS valid REST request.

## Requirements
AWSRequestRestSignerV2 is provided as a single class ready to join any PHP project.

### Mandatory
 ```
· PHP >= 4
 ```
## How it works
AWSRequestRestSignerV2 follow [AWS instructions for V2 REST signing]. That instructions are the following:
> STEP 1. Enter the time stamp.

> STEP 2. URL encode the request's comma (,) and colon (:) characters, so that they don't get misinterpreted (RFC 3986 specification). Do not double-escape any characters.

> STEP 3. Split the parameter/value pairs and delete the ampersand characters (&). The linebreaks used in the following example follow Unix convention (ASCII 0A, "line feed" character).

> STEP 4. Sort your parameter/value pairs by byte value (not alphabetically, lowercase parameters will be listed after uppercase ones).

> STEP 5. Rejoin the sorted parameter/value list with ampersands. The result is the canonical string that we'll sign

> STEP 6. Prepend the following three lines (with line breaks) before the canonical string:
GET
<AWS host>
/onca/xml

> STEP 7. Calculate an RFC 2104-compliant HMAC with the SHA256 hash algorithm using the string above with a given AWS secret key

> STEP 8. URL encode the plus (+) and equal (=) characters in the signature

> STEP 9. Add the URL encoded signature to your request, and the result is a properly-formatted signed request

# Examples

## Process
* Url to sign: http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&Operation=ItemLookup&ItemId=0679722769&ResponseGroup=Images,ItemAttributes,Offers,Reviews&Version=2013-08-01
* Associate Tag: mytag-20
* AWS Secret Key: 1234567890


> STEP 1. Enter the time stamp. For this example, we'll use the UTC time 2014-08-18T12:00:00Z:
    
```text
http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&Operation=ItemLookup&ItemId=0679722769&ResponseGroup=Images,ItemAttributes,Offers,Reviews&Version=2013-08-01&Timestamp=2014-08-18T12:00:00Z
```

> STEP 2. URL encode the request's comma (,) and colon (:) characters, so that they don't get misinterpreted (RFC 3986 specification). Do not double-escape any characters.

```text
http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&Operation=ItemLookup&ItemId=0679722769&ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews&Version=2013-08-01&Timestamp=2014-08-18T12%3A00%3A00Z
```

> STEP 3. Split the parameter/value pairs and delete the ampersand characters (&). The linebreaks used in the following example follow Unix convention (ASCII 0A, "line feed" character).

```text
Service=AWSECommerceService
AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE
AssociateTag=mytag-20
Operation=ItemLookup
ItemId=0679722769
ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews
Version=2013-08-01
Timestamp=2014-08-18T12%3A00%3A00Z
```

> STEP 4. Sort your parameter/value pairs by byte value (not alphabetically, lowercase parameters will be listed after uppercase ones).

```text
AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE
AssociateTag=mytag-20
ItemId=0679722769
Operation=ItemLookup
ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews
Service=AWSECommerceService
Timestamp=2014-08-18T12%3A00%3A00Z
Version=2013-08-01
```

> STEP 5. Rejoin the sorted parameter/value list with ampersands. The result is the canonical string that we'll sign

```text
AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&ItemId=0679722769&Operation=ItemLookup&ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews&Service=AWSECommerceService&Timestamp=2014-08-18T12%3A00%3A00Z&Version=2013-08-01
```

> STEP 6. Prepend the following three lines (with line breaks) before the canonical string:
GET
<AWS host>
/onca/xml

```text
GET
webservices.amazon.com
/onca/xml
AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&ItemId=0679722769&Operation=ItemLookup&ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews&Service=AWSECommerceService&Timestamp=2014-08-18T12%3A00%3A00Z&Version=2013-08-01
```

> STEP 7. Calculate an RFC 2104-compliant HMAC with the SHA256 hash algorithm using the string above with a given AWS secret key

```text
j7bZM0LXZ9eXeZruTqWm2DIvDYVUU3wxPPpp+iXxzQc=
```

> STEP 8. URL encode the plus (+) and equal (=) characters in the signature

```text
j7bZM0LXZ9eXeZruTqWm2DIvDYVUU3wxPPpp%2BiXxzQc%3D
```

> STEP 9. Add the URL encoded signature to your request, and the result is a properly-formatted signed request

```text
http://webservices.amazon.com/onca/xml?AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&ItemId=0679722769&Operation=ItemLookup&ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews&Service=AWSECommerceService&Timestamp=2014-08-18T12%3A00%3A00Z&Version=2013-08-01&Signature=j7bZM0LXZ9eXeZruTqWm2DIvDYVUU3wxPPpp%2BiXxzQc%3D
```

## Usage

```php
require('./AWSRequestRestSignerV2.php');
$signatureObj = new AWSRequestRestSignerV2 (
    'http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&Operation=ItemLookup&ItemId=0679722769&ResponseGroup=Images,ItemAttributes,Offers,Reviews&Version=2013-08-01',
    '1234567890',
    'mytag-20'
);
print $signatureObj->getSignedUrl();
```

```text
http://webservices.amazon.com/onca/xml?AWSAccessKeyId=AKIAIOSFODNN7EXAMPLE&AssociateTag=mytag-20&ItemId=0679722769&Operation=ItemLookup&ResponseGroup=Images%2CItemAttributes%2COffers%2CReviews&Service=AWSECommerceService&Timestamp=2014-08-18T12%3A00%3A00Z&Version=2013-08-01&Signature=j7bZM0LXZ9eXeZruTqWm2DIvDYVUU3wxPPpp%2BiXxzQc%3D
```

License
----

MIT

[//]: # 
   [AWS instructions for V2 REST signing]: <http://docs.aws.amazon.com/AWSECommerceService/latest/DG/rest-signature.html>
