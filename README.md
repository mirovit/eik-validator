# EIK Validator

> The BULSTAT Register is a unified national administrative register that is kept by the Registry Agency at the Ministry of Justice.
> 
> Upon entry of a newly registered entity in the BULSTAT Register, a unique unified identification code (UIC) is generated, called BULSTAT Code, which is the only identifier of business subjects in Bulgaria. All legal subjects listed in the BULSTAT Register shall use and state the BULSTAT UIC in the documents they issue and use in their workflow.
> - [psc.egov.bg](http://psc.egov.bg/en/psc-starting-a-business-bulstat)

[![Build Status](https://travis-ci.org/mirovit/eik-validator.svg?branch=master)](https://travis-ci.org/mirovit/eik-validator)

# How to use?

Pull from [Composer](https://getcomposer.org/):

```
composer require mirovit/eik-validator
```

And then use it like so:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$validator = new Mirovit\EIKValidator\EIKValidator;
$validator->isValid('123123123');
```

# Contributing

If you'd like to contribute, feel free to send a pull request!
