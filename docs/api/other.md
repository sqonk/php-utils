------
### other
#### Methods
[bool2str](#bool2str)
[constrain](#constrain)

------
##### bool2str
```php
function bool2str(bool $value) : string
```
Return a text representation of a boolean value.

- **bool** $value The input value to test.

**Returns:**  string The word "true" if the boolean is `TRUE`, "false" if not.


------
##### constrain
```php
function constrain(int|float $value, int|float $min, int|float $max) : int|float
```
Clip a numeric value to the given min and max boundaries.

- **float|int** $value The number to check
- **float|int** $min The minimum value the number can be.
- **float|int** $max The maximum value the number can be.

**Returns:**  float|int If the input number is outside of the max or min, then the relevant boundary is returned, otherwise the original number is returned if it is within the range.

Example:

``` php
$value = 4.9;
println("value:", constrain($value, 5.0, 5.5));
// will print out '5'.
```


------
