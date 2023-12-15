# Ibexa Icon Fieldtype 
This bundle provides a new field type "icon".
It allows an editor to select an icon from a predefined set of icons

## Features
* Configure multiple icon-sets
* Select the icon-set at content-type edit level
* Select icon from a dropdown instead of text

## Installation
1. Add the bundle
```shell
composer require elbformat/icon-bundle
```

2. Activate the bundle 
```php
Elbformat\IconBundle\ElbformatIconBundle::class => ['all' => true],
```

3. Add iconset configuration
Add `config/packages/elbformat_icon.yaml`
```yaml
elbformat_icon:
  iconset1:
    - clock
    - house 
  iconset2:
    folder: "vendor/ezsystems/ezplatform-admin-ui/src/bundle/Resources/public/img/icons"
```
See [configuration](doc/configuration.md) for more advanced examples

## Usage
Edit a content-type and add an "Icon" field. Select icon-set to use.
When editing the content, a dropdown with icons will be shown.