# Middleware that resumes response bodies if they are streaming

[![Continuous Integration](https://github.com/WyriHaximus/reactphp-http-middleware-resume-response-body/actions/workflows/ci.yml/badge.svg)](https://github.com/WyriHaximus/reactphp-http-middleware-resume-response-body/actions/workflows/ci.yml)
[![Latest Stable Version](https://poser.pugx.org/wyrihaximus/react-http-middleware-resume-response-body/v/stable.png)](https://packagist.org/packages/wyrihaximus/react-http-middleware-resume-response-body)
[![Total Downloads](https://poser.pugx.org/wyrihaximus/react-http-middleware-resume-response-body/downloads.png)](https://packagist.org/packages/wyrihaximus/react-http-middleware-resume-response-body/stats)
[![Type Coverage](https://shepherd.dev/github/WyriHaximus/reactphp-http-middleware-resume-response-body/coverage.svg)](https://shepherd.dev/github/WyriHaximus/reactphp-http-middleware-resume-response-body)
[![License](https://poser.pugx.org/wyrihaximus/react-http-middleware-resume-response-body/license.png)](https://packagist.org/packages/wyrihaximus/react-http-middleware-resume-response-body)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-http-middleware-resume-response-body
```

# Usage

```php
$server = new Server(
    $loop,
    /** Other Middleware */
    new ResumeResponseBodyMiddleware(),
    /** Other Middleware */
);
```

# License

The MIT License (MIT)

Copyright (c) 2020 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
