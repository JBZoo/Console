<?php
/**
 * JBZoo PHPUnit
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   PHPUnit
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/PHPUnit
 * @author    Denis Smetannikov <denis@jbzoo.com>
 */

namespace JBZoo\Console\Command;

use JBZoo\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Example
 * @package JBZoo/Console
 * @codeCoverageIgnore
 */
class Test extends Command
{
    /**
     * Configuration of command
     */
    protected function configure() // @codingStandardsIgnoreLine
    {
        $this
            ->setName('test')
            ->setDescription('Just for testing and command skeleton!');

        $this
            ->addOption('option', 'o', InputOption ::VALUE_OPTIONAL, 'Some option', null)
            ->addOption('req-option', null, InputOption::VALUE_REQUIRED, 'Some required option', 'qwerty');
    }

    /**
     * Execute method of command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output) // @codingStandardsIgnoreLine
    {
        $this->_executePrepare($input, $output);

        $optionValue    = $this->_getOpt('option', 42);
        $reqOptionValue = $this->_getOpt('req-option');

        $this->_(array(
            '<info>Success!</info>',
            '<comment>Option="' . $optionValue . '"; Required="' . $reqOptionValue . '";</comment>',
        ));
    }
}
