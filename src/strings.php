<?php declare(strict_types = 0);
/**
*
* php-utils
*
* @package	  php-utils
* @subpackage	str-globals
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


/**
 * Translate the given text to a clean representation by removing all control or UTF characters that can
 * produce unreadable artefacts on various mediums of output such as HTML or PDF.
 *
 * The common characters corrected to standard ASCII are:
 * - single quotes
 * - double quotes
 * - hyphens
 * - double hyphens
 * - ellipsis
 *
 * NOTE: This method is _not identical_ to the strings::clean() method in phext-core. No encoding conversion
 * is performed.
 *
 * -- parameters:
 * @param string $text The text to be cleaned.
 *
 * @return string A copy of the modified input with all UTF8 and Windows-1252 characters removed.
 */
function str_clean(string $text): string
{
  static $replacements = ["'", "'", '"', '"', '-', '--', '...'];
    
  // First, replace UTF-8 characters.
  $text = str_replace(
    ["\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"],
    $replacements,
    $text
  );

  // Next, replace their Windows-1252 equivalents.
  $text = str_replace(
    [chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)],
    $replacements,
    $text
  );
    
  $text = preg_replace("/[^\x0A\x20-\x7E]/", '', $text);

  return trim($text);
}


/**
 * Modify a string by splitting it by the given delimiter and popping `$amount` of elements off of the end.
 *
 * If the delimiter was not found and no items were popped then this method returns an empty
 * array and the input string is not modified.
 *
 * -- parameters:
 * @param string $string The string to be modified.
 * @param string $delimiter The substring to split the main string into seperate elements with.
 * @param int $amount The number of elements to removed from the end of the main string.
 *
 * @return list<string> An array containing all of the elements that were removed.
 */
function str_multipop(string &$string, string $delimiter, int $amount): array
{
  $poppedItems = [];
  if (str_contains($string, $delimiter)) {
    $parts = explode($delimiter, $string);
    $amount = min($amount, count($parts));
    for ($i = 0; $i < $amount; $i++) {
      $poppedItems[] = array_pop($parts);
    }
    
    $string = implode($delimiter, $parts);
  }
    
  return array_reverse($poppedItems);
}

/**
 * Modify a string by splitting it by the given delimiter and shifting `$amount` of elements off of the start.
 *
 * If the delimiter was not found and no items were shifted then this method returns an empty
 * array and the input string is not modified.
 *
 * -- parameters:
 * @param string $string The string to be modified.
 * @param string $delimiter The substring to split the main string into seperate elements with.
 * @param int $amount The number of elements to removed from the start of the main string.
 *
 * @return list<string> An array containing all of the elements that were removed.
 */
function str_multishift(string &$string, string $delimiter, int $amount): array
{
  $poppedItems = [];
  if (str_contains($string, $delimiter)) {
    $parts = explode($delimiter, $string);
    $amount = min($amount, count($parts));
    for ($i = 0; $i < $amount; $i++) {
      $poppedItems[] = array_shift($parts);
    }
    
    $string = implode($delimiter, $parts);
  }
    
  return $poppedItems;
}


/**
 * Split the given string by the delimiter and return the last element. The provided input string
 * is shortened as a result.
 *
 * If the delimiter was not found and no item was popped then this method returns an empty
 * string and the input string is not modified.
 *
 * -- parameters:
 * @param string $string The string to be modified.
 * @param string $delimiter The substring to split the main string into seperate elements with.
 *
 * @return string A string containing the element removed.
 */
function str_popex(string &$string, string $delimiter): string
{
  if (str_contains($string, $delimiter)) {
    $items = str_multipop($string, $delimiter, 1);
    if (count($items)) {
      return $items[0];
    }
  }
  return '';
}

/**
 * Split the given string by the delimiter and return the first element. The provided input string
 * is shortened as a result.
 *
 * If the delimiter was not found and no item was shifted then this method returns an empty
 * string and the input string is not modified.
 *
 * -- parameters:
 * @param string $string The string to be modified.
 * @param string $delimiter The substring to split the main string into seperate elements with.
 *
 * @return string A string containing the element removed.
 */
function str_shiftex(string &$string, string $delimiter): string
{
  if (str_contains($string, $delimiter)) {
    $items = str_multishift($string, $delimiter, 1);
    if (count($items)) {
      return $items[0];
    }
  }
  return '';
}

if (!function_exists('is_stringable'))
{
  /**
   * Is the supplied variable capable of being transformed into a string?
   * 
   * @param mixed $value The value to inspect.
   * 
   * @return bool 
   * TRUE if the value is a primitive type that can be type juggled into a string, or is an object 
   * with a __tostring() implementation.
   */
  function is_stringable(mixed $value): bool
  {
    return is_string($value) or is_numeric($value) or
        (is_object($value) and method_exists($value, '__toString'));
  }
}