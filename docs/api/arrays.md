------
### arrays
#### Methods
[array_first](#array_first)
[array_last](#array_last)
[array_multipop](#array_multipop)
[array_multishift](#array_multishift)
[array_head](#array_head)
[array_tail](#array_tail)
[array_choose](#array_choose)

------
##### array\_first
```php
function array_first(array $array) : mixed
```
Return the first element in an array. If the array is associative then the value corresponding to the first key is sought.

- **array<mixed>** $array The input array.

**Returns:**  mixed The first element in the array or `FALSE` if the array is empty.


------
##### array\_last
```php
function array_last(array $array) : mixed
```
Return the last element in an array.

- **array<mixed>** $array The input array.

**Returns:**  mixed The last element in the array or `FALSE` if the array is empty.


------
##### array\_multipop
```php
function array_multipop(array &$array, int $amount) : array
```
Modify the input array by popping one or more elements off the end.

- **array<mixed>** $array The array to extract the items from.
- **int** $amount The amount of items to remove.

**Returns:**  array<mixed> An array of the items that were removed.


**See:**  `array_tail` if you are only interested in acquiring a sub-array of the items on the end.


------
##### array\_multishift
```php
function array_multishift(array &$array, int $amount) : array
```
Modify the input array by shifting one or more elements off the start.

- **array<mixed>** $array The array to extract the value from.
- **int** $amount The amount of items to remove.

**Returns:**  array<mixed> An array of the items that were removed.


**See:**  `array_head` if you are only interested in acquiring a sub-array of the items at the start.


------
##### array\_head
```php
function array_head(array $array, int $amount) : array
```
Return the first part of the given array containing up to $amount of items from the start. If the given amount is greater than the size of the input array then the whole array is returned.

- **array<mixed>** $array The array to extract the subarray from.
- **positive-int** $amount The amount of items in the resulting array.

**Returns:**  array<mixed> The selected portion of the array.


------
##### array\_tail
```php
function array_tail(array $array, int $amount) : array
```
Return the last part of the given array containing up to $amount of items from the end. If the given amount is greater than the size of the input array then the whole array is returned.

- **array<mixed>** $array The array to extract the subarray from.
- **positive-int** $amount The amount of items in the resulting array.

**Returns:**  array<mixed> The selected portion of the array.


------
##### array\_choose
```php
function array_choose(array $dataSet) : mixed
```
Randomly choose an item from the given array. An empty array will always return null.

- **array<mixed>** $dataSet The array to select an element from.

**Returns:**  mixed The randomly selected value.

Example:

``` php
$numbers = [1,2,3,4,5,6,7,8,9,10];
$choice = arrays::choose($numbers);
// return a random selection from provided array.
```


------
