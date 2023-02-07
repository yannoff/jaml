# JAML

Easy-to-use JSON <=> YAML converter

[![Latest stable release](https://img.shields.io/badge/Release-@@version@@-blue)](https://github.com/yannoff/jaml/releases/latest "Latest stable release")
[![MIT License](https://img.shields.io/badge/License-MIT-lightgrey)](https://github.com/yannoff/jaml/blob/master/LICENSE "MIT License")

## Usage

- [YAML to JSON Conversion](#converting-yaml-to-json)
- [JSON to YAML Conversion](#converting-json-to-yaml)

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

## Installation

### Requirements

- `php` 5.5+

### Quick install

Get the latest release and install it

```bash
curl -Lo /usr/bin/jaml https://github.com/yannoff/jaml/releases/latest/download/jaml
chmod +x /usr/bin/jaml
```

:bulb: _The `/usr/bin/jaml` path is just an example, fell free to replace by any custom binary file path._


## Credits

Compiled as a PHAR self-executable using [Box](https://github.com/box-project/box2).

## License

Licensed under the [MIT License](LICENSE).
