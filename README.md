# DriveOpTwilioBundle
A simple Symfony bundle for Twilio Api.

## Setup

### Step 1: Download DriveOpTwilioBundle using composer

Add Twilio Bundle in your composer.json:

```js
{
    "require": {
        "driveop/twilio-bundle": "^1.0"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "driveop/twilio-bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new DriveOp\TwilioBundle\DriveOpTwilioBundle()
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
driveop:
        twilio:
            twilio_sid:    %twilio_sid%
            twilio_token:  %twilio_token%
```

## Usage

**Using service**

``` php
<?php
        $twilioClient = $this->get('twilio_client');
?>
```

##Example

###Send WhatsApp message
``` php
<?php 
    $message = $twilioClient->sendWhatsAppMessage($to, $from, $body);
?>
```
