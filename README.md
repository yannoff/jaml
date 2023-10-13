# JAML

Easy-to-use JSON <=> YAML converter

[![Latest stable release](https://img.shields.io/badge/Release-1.3.0-blue)](https://github.com/yannoff/jaml/releases/latest "Latest stable release")
[![MIT License](https://img.shields.io/badge/License-MIT-lightgrey)](https://github.com/yannoff/jaml/blob/master/LICENSE "MIT License")

## Usage

_Input format is detected automatically, hence:_

- [YAML input will be converted to JSON](#converting-yaml-to-json)
- [JSON input will be converted to YAML](#converting-json-to-yaml)

### Converting YAML to JSON

```bash
# The classic way:
jaml <file.yaml|url-to-yaml-contents>

# or using piped standard input:
cat file.yaml | jaml
```

### Converting JSON to YAML

```bash
# The classic way:
jaml <file.json|url-to-json-contents>

# or using piped standard input:
cat file.json | jaml
```

### Examples

_**Converting remote JSON contents over https**_

```bash
jaml https://repo.packagist.org/packages/list.json?vendor=yannoff
```

_Output:_

```yaml
packageNames:
    - yannoff/collections
    - yannoff/composer-dotenv-handler
    - yannoff/console
    - yannoff/handyman
    - yannoff/lumiere-ui
    - yannoff/lumiere-utils
    - yannoff/symfony-boilerplate
    - yannoff/y-a-m-l
    - yannoff/yamltools
```

_**Converting a YAML file contents**_

```bash
jaml composer.yaml
```

_Output:_

```json
{
    "name": "yannoff/jaml",
    "description": "Easy-to-use JSON <=> YAML converter",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Yannoff",
            "homepage": "https://github.com/yannoff"
        }
    ],
    "autoload": {
        "psr-4": {
            "Yannoff\\Jaml\\": "src/"
        }
    },
    "require": {
        "yannoff/console": "^2.0",
        "yannoff/yamltools": "^1.5"
    }
}
```

### Available options

**`-i, --interactive`**

*Run in interactive mode*

**`-h, --help`**

*Display help message*

**`-v, --verbose`**

*Increase the verbosity of jaml output*

**`--version`**

*Display version and exit*

## Installation

### Requirements

- [`php`](https://www.php.net/) 5.5+ or [`PAW`](https://github.com/yannoff/p-a-w)

### Quick install

Get the latest release and install it

```bash
curl -Lo /usr/bin/jaml https://github.com/yannoff/jaml/releases/latest/download/jaml
chmod +x /usr/bin/jaml
```

:bulb: _The `/usr/bin/jaml` path is just an example, fell free to replace by any custom binary file path._

### Checksums

Some checksum files are available to verify the `jaml` binary integrity:

- [jaml.md5](https://github.com/yannoff/jaml/releases/latest/download/jaml.md5)
- [jaml.sha384](https://github.com/yannoff/jaml/releases/latest/download/jaml.sha384)

_Here is an example using PHP_

```php
echo hash_file('sha384', 'https://github.com/yannoff/jaml/releases/latest/download/jaml');
```

## Credits

_**JAML** leverages [offenbach](https://github.com/yannoff/offenbach) for PHP dependency management._

Compiled as a PHAR self-executable using [Box](https://github.com/box-project/box2).

## License

Licensed under the [MIT License](LICENSE).
