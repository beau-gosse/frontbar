# Frontbar

Version: 1.2.0-beta

Frontbar is an extra for MODX Revolution that displays an admin toolbar in the front end for logged in users.

## Usage example

Simply place the following call within the `<body>` tag of your template:
```
[[!Frontbar]]
```

To position Frontbar at the bottom of the page:
```
[[!Frontbar? &position=`bottom`]]
```

**Available properties:**

`tpl` => Name of the chunk serving as template. Default is `Frontbar`
