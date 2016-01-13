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

namespace JBZoo\Console;

use JBZoo\Utils\FS;
use Symfony\Component\Console\Application;

/**
 * Class App
 * @package JBZoo\Console
 * @codeCoverageIgnore
 */
class App extends Application
{
    /**
     * @var array
     */
    private $_logo = array(
        "       _ ____ ______              _____                      _       ",
        "      | |  _ |___  /             / ____|                    | |      ",
        "      | | |_) | / / ___   ___   | |     ___  _ __  ___  ___ | | ___  ",
        "  _   | |  _ < / / / _ \ / _ \  | |    / _ \| '_ \/ __|/ _ \| |/ _ \ ",
        " | |__| | |_) / /_| (_) | (_) | | |___| (_) | | | \__ | (_) | |  __/ ",
        "  \____/|____/_____\___/ \___/   \_____\___/|_| |_|___/\___/|_|\___| ",
    );

    /**
     * Register commads by directory path
     *
     * @param string $commandsDir The commands class directory
     * @throws \Exception
     */
    public function registerCommands($commandsDir)
    {
        if (!is_dir($commandsDir)) {
            throw new \Exception('First argument is not directory!');
        }

        $this->_registerCommands($commandsDir);
    }

    /**
     * Register commands
     *
     * @param $commandsDir
     * @return bool
     */
    protected function _registerCommands($commandsDir)
    {
        $files = FS::ls($commandsDir);
        if (empty($files)) {
            return false;
        }

        foreach ($files as $file) {

            require_once $file;

            $reflection = new \ReflectionClass(__NAMESPACE__ . '\\Command\\' . FS::filename($file));

            if ($reflection->isSubclassOf('Symfony\\Component\\Console\\Command\\Command') &&
                !$reflection->isAbstract()
            ) {
                $this->add($reflection->newInstance());
            }
        }

        return true;
    }

    /**
     * Returns the long version of the application.
     * @return string The long application version
     */
    public function getLongVersion()
    {
        return '<info>' . implode(PHP_EOL, $this->_logo) . '</info> <comment>by SmetDenis</comment>';
    }
}
