<?php

declare(strict_types=0);
/**
 *
 * php-utils
 *
 * @package	  php-utils
 * @subpackage	array-globals
 * @version		1
 *
 * @license		MIT see license.txt
 * @copyright	2021 Sqonk Pty Ltd.
 *
 *
 * This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */


if (!function_exists('array_last')) {
  /**
   * Return the last element in an array. 
   * 
   * This method is not declared in version of PHP 8.5 and later
   * as it is built directly into the language.
   *
   * -- parameters:
   * @param array<mixed> $array The input array.
   * 
   * @return mixed The last element in the array or FALSE if the array is empty.
   */
  function array_last(array $array): mixed
  {
    return end($array);
  }
}

if (!function_exists('array_first')) {
  /**
   * Return the first element in an array. If the array is associative then the value corresponding
   * to the first key is sought.
   * 
   * This method is not declared in version of PHP 8.5 and later
   * as it is built directly into the language.
   *
   * -- parameters:
   * @param array<mixed> $array The input array.
   * 
   * @return mixed The first element in the array or FALSE if the array is empty.
   */
  function array_first(array $array): mixed
  {
    if (count($array) > 0) {
      $keys = array_keys($array);
      return $array[$keys[0]];
    }
    return false;
  }
}


/**
 * Modify the input array by popping one or more elements off the end.
 *
 * -- parameters:
 * @param array<mixed> $array The array to extract the items from.
 * @param int $amount The amount of items to remove.
 *
 * @return array<mixed> An array of the items that were removed.
 *
 * @see `array_tail` if you are only interested in acquiring a sub-array of the items on the end.
 */
function array_multipop(array &$array, int $amount): array
{
  $count = count($array);
  if ($amount >= $count) {
    return [];
  }
  $poppedItems = array_slice($array, -$amount);
  $array = array_slice($array, 0, $count - $amount);

  return array_reverse($poppedItems);
}

/**
 *  Modify the input array by shifting one or more elements off the start.
 *
 * -- parameters:
 * @param array<mixed> $array The array to extract the value from.
 * @param int $amount The amount of items to remove.
 *
 * @return array<mixed> An array of the items that were removed.
 *
 * @see `array_head` if you are only interested in acquiring a sub-array of the items at the start.
 */
function array_multishift(array &$array, int $amount): array
{
  $count = count($array);
  if ($amount >= $count) {
    return [];
  }
  $shiftedItems = array_slice($array, 0, $amount);
  $array = array_slice($array, $amount);

  return $shiftedItems;
}

/**
 * Return the first part of the given array containing up to $amount of items from the start. If the
 * given amount is greater than the size of the input array then the whole array is returned.
 *
 * -- parameters:
 * @param array<mixed> $array The array to extract the subarray from.
 * @param positive-int $amount The amount of items in the resulting array.
 *
 * @return array<mixed> The selected portion of the array.
 */
function array_head(array $array, int $amount): array
{
  if ($amount < 1) { // @phpstan-ignore-line
    throw new \Exception("Amount specified must be 1 or greater, $amount given.");
  }

  if ($amount >= count($array)) {
    return $array;
  }

  return array_slice($array, 0, $amount);
}

/**
 * Return the last part of the given array containing up to $amount of items from the end. If the
 * given amount is greater than the size of the input array then the whole array is returned.
 *
 * -- parameters:
 * @param array<mixed> $array The array to extract the subarray from.
 * @param positive-int $amount The amount of items in the resulting array.
 *
 * @return array<mixed> The selected portion of the array.
 */
function array_tail(array $array, int $amount): array
{
  if ($amount < 1) { // @phpstan-ignore-line
    throw new \Exception("Amount specified must be 1 or greater, $amount given.");
  }

  $total = count($array);
  if ($amount >= $total) {
    return $array;
  }

  return array_slice($array, $total - $amount);
}

if (!function_exists('array_choose')) {
  /**
   * Randomly choose an item from the given array. An empty array will always return null.
   *
   * -- parameters:
   * @param array<mixed> $dataSet The array to select an element from.
   *
   * @return mixed The randomly selected value.
   *
   * Example:
   *
   * ``` php
   * $numbers = [1,2,3,4,5,6,7,8,9,10];
   * $choice = array_choose($numbers);
   * // return a random selection from provided array.
   * ```
   */
  function array_choose(array $dataSet): mixed
  {
    if (count($dataSet) == 0) {
      return null;
    }

    $idxKey = array_rand($dataSet);
    return $dataSet[$idxKey];
  }
}
