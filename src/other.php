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
