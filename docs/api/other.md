------
### other
#### Methods
[boolstr](#boolstr)
[on_exit_scope](#on_exit_scope)

------
##### boolstr
```php
function boolstr(bool $value) : string
```
Return a text representation of a boolean value.

- **bool** $value The input value to test.

**Returns:**  string The word "true" if the boolean is `TRUE`, "false" if not.


------
##### on\_exit\_scope
```php
function on_exit_scope(array &$stack, callable $callback) : void
```
Defer execution of a given callback until the current scope is cleared by the garbage collector.

This works by pushing a wrapper class to the end of a given stack (held by the reference variable $stack).

- **?array<callable>** &$stack Container for the callback to be stored within.
- **callable** $callback The method to be called at a later point in time.


------
