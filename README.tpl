# JAML

Easy-to-use JSON <=> YAML converter

[![Latest stable release](https://img.shields.io/badge/Release-@@version@@-blue)](https://github.com/yannoff/jaml/releases/latest "Latest stable release")
[![MIT License](https://img.shields.io/badge/License-MIT-lightgrey)](https://github.com/yannoff/jaml/blob/master/LICENSE "MIT License")

## Usage

_Input format is detected automatically, hence:_

- [YAML input will be converted to JSON](#converting-yaml-to-json)
- [JSON input will be converted to YAML](#converting-json-to-yaml)

### Converting YAML to JSON

```bash
# The classic way:
jaml <file.yaml>

# or using piped standard input:
cat file.yaml | jaml
```

### Converting JSON to YAML

```bash
# The classic way:
jaml <file.json>

# or using piped standard input:
cat file.json | jaml
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
