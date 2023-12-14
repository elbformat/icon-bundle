# Ibexa Icon FieldType
This bundle provides a new field type "icon".
It allows an editor to select an icon from a predefined set of icons

## Features
* Configure multiple icon sets
* Select the icon set at content-type edit level
* Select icon from a dropdown instead of text

## Installation
1. Add the bundle
```shell
composer require elbformat/ibexa-icon-fieldtype
```

2. Activate the bundle 
```php
Elbformat\IconFieldtypeBundle\IconFieldtypeBundle::class => ['all' => true],
```

3. Add iconset configuration
TBD.

## Usage
Edit a content-type and add 