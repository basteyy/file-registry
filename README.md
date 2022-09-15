# File Registry

Hi! This is (my personal) file registry script. It could help you to manage files. 

[![CC BY-SA 4.0][cc-by-sa-shield]][cc-by-sa]

## Setup

Use composer to install the package:

```shell
composer require basteyy/file-registry
```

## Config/Usage

```php
<?php 

// Get the registry
$file_registry = new FileRegistry();

// Choose the driver of the registry
$file_registry->setRegistryDriver(new JsonFileDriver('path/to/database.json'));

// Add a file
$file_registry->add(
    filename: 'example.jpg',
    location: '/var/www/data/',
    scope: 'foobar'
);

$file_registry->add(
    filename: 'john-doe.pdf',
    location: '/var/www/data/',
    scope: 'vita'
);

$file_registry->add(
    filename: 'john-doe.pdf',
    location: '/var/www/data/',
    scope: 'foobar'
);

// Get the first which is matching the search arguments
$file_registry->get(
    filename: 'john-doe.pdf'
); // Return john-die from vita-scope

$file_registry->get(
    filename: 'john-doe.pdf',
    scope: 'foobar'
); // Return john-die from foobar-scope

// Get all files from a scope/location
$file_registry->all(
    scope: 'foobar'
); // Return all files form scope foobar

// Delete a file
$file_registry->delete(
    filename: 'john-doe.pdf',
    scope: 'foobar'
); // Delete the file from scope foobar
```

## License

This work is licensed under a
[Creative Commons Attribution-ShareAlike 4.0 International License][cc-by-sa].

[![CC BY-SA 4.0][cc-by-sa-image]][cc-by-sa]

[cc-by-sa]: http://creativecommons.org/licenses/by-sa/4.0/
[cc-by-sa-image]: https://licensebuttons.net/l/by-sa/4.0/88x31.png
[cc-by-sa-shield]: https://img.shields.io/badge/License-CC%20BY--SA%204.0-lightgrey.svg