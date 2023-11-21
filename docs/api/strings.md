------
### strings
#### Methods
[str_multipop](#str_multipop)
[str_multishift](#str_multishift)
[str_popex](#str_popex)
[str_shiftex](#str_shiftex)
[str_clean](#str_clean)
[var_is_stringable](#var_is_stringable)

------
##### str\_multipop
```php
function str_multipop(string &$string, string $delimiter, int $amount) : array
```
Modify a string by splitting it by the given delimiter and popping `$amount` of elements off of the end.

If the delimiter was not found and no items were popped then this method returns an empty array and the input string is not modified.

- **string** $string The string to be modified.
- **string** $delimiter The substring to split the main string into seperate elements with.
- **int** $amount The number of elements to removed from the end of the main string.

**Returns:**  list<string> An array containing all of the elements that were removed.


------
##### str\_multishift
```php
function str_multishift(string &$string, string $delimiter, int $amount) : array
```
Modify a string by splitting it by the given delimiter and shifting `$amount` of elements off of the start.

If the delimiter was not found and no items were shifted then this method returns an empty array and the input string is not modified.

- **string** $string The string to be modified.
- **string** $delimiter The substring to split the main string into seperate elements with.
- **int** $amount The number of elements to removed from the start of the main string.

**Returns:**  list<string> An array containing all of the elements that were removed.


------
##### str\_popex
```php
function str_popex(string &$string, string $delimiter) : string
```
Split the given string by the delimiter and return the last element. The provided input string is shortened as a result.

If the delimiter was not found and no item was popped then this method returns an empty string and the input string is not modified.

- **string** $string The string to be modified.
- **string** $delimiter The substring to split the main string into seperate elements with.

**Returns:**  string A string containing the element removed.


------
##### str\_shiftex
```php
function str_shiftex(string &$string, string $delimiter) : string
```
Split the given string by the delimiter and return the first element. The provided input string is shortened as a result.

If the delimiter was not found and no item was shifted then this method returns an empty string and the input string is not modified.

- **string** $string The string to be modified.
- **string** $delimiter The substring to split the main string into seperate elements with.

**Returns:**  string A string containing the element removed.


------
##### str\_clean
```php
function str_clean(string $text) : string
```
Translate the given text to a clean representation by removing all control or UTF characters that can produce unreadable artefacts on various mediums of output such as HTML or PDF.

The common characters corrected to standard ASCII are: - single quotes - double quotes - hyphens - double hyphens - ellipsis

NOTE: This method is _not identical_ to the strings::clean() method in phext-core. No encoding conversion is performed.

- **string** $text The text to be cleaned.

**Returns:**  string A copy of the modified input with all UTF8 and Windows-1252 characters removed.


------
##### var\_is\_stringable
```php
function var_is_stringable(mixed $value) : bool
```
Is the supplied variable capable of being transformed into a string?

@param mixed $value The value to inspect.

**Returns:**  bool `TRUE` if the value is a primitive type that can be type juggled into a string, or is an object with a __tostring() implementation.


------
