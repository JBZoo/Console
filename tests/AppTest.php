<?php
/**
 * JBZoo Console
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   Console
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/Console
 * @author    Denis Smetannikov <denis@jbzoo.com>
 */

namespace JBZoo\PHPUnit;

/**
 * Class AppTest
 * @package JBZoo\PHPUnit
 */
class AppTest extends PHPUnit
{


    public function testExecute()
    {
        skip();
        $uniq = uniqid('', true);

        $output = cmd('php ./bin/jbzoo test', array(
            'option' => $uniq,
        ));

        isContain($uniq, $output);
        isContain('qwerty', $output);
        isContain('Success', $output);
    }
}
