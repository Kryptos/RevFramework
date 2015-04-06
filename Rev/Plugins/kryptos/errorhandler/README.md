ErrorHandler
=======

Kryptos/ErrorHandler is an easy to use composer package that serves as a beautiful error handler.


Setup
-----
Composer.json

    "require": {
        "kryptos/errorhandler": "dev-master"
    }

Usage
-----
```php
//Instantiate class
new \Kryptos\Handler\Error;

//Code!
if (1===1) {
    trigger_error('1 is equal to 1!');
}

trigger_error('1 is not equal to 1!', E_USER_ERROR);
```

## Contributors

- [Christian Petersen](http://humanoidism.dk)
- [Manuel Fernandez](http://prjrev.com)

## License

(MIT License)

Copyright (c) 2013 Christian Petersen, Manuel Fernandez

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
