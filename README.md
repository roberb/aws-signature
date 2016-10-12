# PHP AWSRequestRestSignerV2

[![N|Solid](http://docs.aws.amazon.com/images/aws_logo_105x39.png)](https://aws.amazon.com/)
## What is
AWSRequestRestSignerV2 is a URL signer (AWS signature V2) for Amazon Web Services REST requests written in PHP. For a given URL, AWS Secret Key and AWS Associate Tag, you can get tje signed URL ready to make an AWS valid REST request

## Requirements
AWS-signature is provided as a single class ready to join any PHP project.

### Mandatory
 ```
* PHP >= 4
 ```
## How it works
AWSRequestRestSignerV2 follow [AWS instructions for V2 REST signing]. That instructions are the following:







```text
1. Enter the time stamp.
2. URL encode the request's comma (,) and colon (:) characters, so that they don't get misinterpreted (RFC 3986 specification). Do not double-escape any characters.
3. Split the parameter/value pairs and delete the ampersand characters (&). The linebreaks used in the following example follow Unix convention (ASCII 0A, "line feed" character).
4. Sort your parameter/value pairs by byte value (not alphabetically, lowercase parameters will be listed after uppercase ones).
5. Rejoin the sorted parameter/value list with ampersands. The result is the canonical string that we'll sign
6. Prepend the following three lines (with line breaks) before the canonical string:
GET
webservices.amazon.com
/onca/xml
7. Calculate an RFC 2104-compliant HMAC with the SHA256 hash algorithm using the string above with a given AWS secret key
8. URL encode the plus (+) and equal (=) characters in the signature
9. Add the URL encoded signature to your request, and the result is a properly-formatted signed request
```

License
----

MIT

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)


   [AWS instructions for V2 REST signing]: <http://docs.aws.amazon.com/AWSECommerceService/latest/DG/rest-signature.html>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [@thomasfuchs]: <http://twitter.com/thomasfuchs>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [keymaster.js]: <https://github.com/madrobby/keymaster>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]:  <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>

