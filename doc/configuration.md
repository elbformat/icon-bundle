# Configuration

To configure your icon sets, there are two options:
1. Fixed sets of icon names
2. A list of icons derived from a filesystem folder

## Fixed set
To configure a fixed set of icons (e.g. "myicons"), use the following config syntax
```yaml
elbformat_icon:
  myicons:
    - clock
    - house  
```

## From filesystem
You can specify a folder that is being scanned for files. Optionally you can add a pattern to ignore non-icon files.
This example will look into the public/assets/build/images/icons folder and scans for svg files.
```yaml
elbformat_icon:
  myiconsfromfolder:
    folder: '%webroot_dir%/assets/build/images/icons'
    pattern: '*.svg'
```
