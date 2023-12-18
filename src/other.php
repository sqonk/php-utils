<?php declare(strict_types = 0);
/**
*
* php-utils
*
* @package	  php-utils
* @subpackage	other
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


if (!function_exists('bool2str')) 
{
  /**
   * Return a text representation of a boolean value.
   *
   * -- parameters:
   * @param bool $value The input value to test.
   *
   * @return string The word "true" if the boolean is TRUE, "false" if not.
   */
  function bool2str(bool $value): string
  {
    return $value ? 'true' : 'false';
  }
}


/**
 * Clip a numeric value to the given min and max boundaries.
 * 
 * -- parameters:
 * @param float|int $value The number to check
 * @param float|int $min The minimum value the number can be.
 * @param float|int $max The maximum value the number can be.
 * 
 * @return float|int If the input number is outside of the max or min, then the relevant boundary is returned, otherwise the original number is returned if it is within the range.
 *
 * Example:
 *
 * ``` php
 * $value = 4.9;
 * println("value:", constrain($value, 5.0, 5.5));
 * // will print out '5'.
 * ```
 */
function constrain(float|int $value, float|int $min, float|int $max): float|int
{
  return max(min($value, $max), $min);
}