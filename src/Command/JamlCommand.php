<?php

/**
 * This file is part of the JAML utility project
 *
 * (c) Yannoff (https://github.com/yannoff)
 *
 * @project   yannoff/jaml
 * @link      https://github.com/yannoff/jaml
 * @license   https://github.com/yannoff/jaml/blob/master/LICENSE
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yannoff\Jaml\Command;

use StdClass;
use Yannoff\Component\Console\Application;
use Yannoff\Component\Console\Command;
use Yannoff\Component\Console\Definition\Argument;
use Yannoff\Component\Console\Definition\Option;
use Yannoff\Component\Console\IO\Output\Formatter;
use Yannoff\Component\Console\IO\Output\Verbosity;
use Yannoff\YamlTools\Encoder\Json;
use Yannoff\YamlTools\Encoder\Yaml;
use Yannoff\YamlTools\Exception\RuntimeWarning;

/**
 * Unique command for both JSON & YAML conversions
 *
 * @author  Yannoff
 * @package Yannoff\Jaml\Command
 */
class JamlCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $helpText = 'Performs either a YAML=>JSON or JSON=>YAML conversion, depending on the detected input format';

        $this
            ->setHelp($helpText)
            ->setDescription($helpText)
            ->addOption(
                'verbose',
                'v',
                Option::FLAG,
                'Turn on verbose mode (debug messages on STDERR)'
            )
            ->addOption(
                'interactive',
                'i',
                Option::FLAG,
                'Run JAML in interactive mode'
            )
            ->addArgument(
                'infile',
                Argument::OPTIONAL,
                'Input file (JSON/YAML) - If none provided, use standard input'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        if ($this->getOption('verbose')) {
            $this->verbosity = Verbosity::DEBUG;
        }


        try {

            $infile = $this->getArgument('infile');
            $interactive = $this->getOption('interactive');

            if ($interactive) {
                $this->error("Welcome to JAML interactive mode ! \nType your contents here and press CTRL+D to trigger conversion");
            }

            $contents = $this->getContents($interactive, $infile);

            if ($this->isJson($contents)) {
                $this->debug('Detected input looks like a JSON formatted contents...');
                $data = $this->fromJson($contents);
                $out = $this->toYaml($data);
            } else  {
                $this->debug('Assuming input is a YAML formatted contents...');
                $data = $this->fromYaml($contents);
                $out = $this->toJson($data);
            }

            $out = \rtrim($out, Formatter::LF) . Formatter::LF;

            // In case the dump() result is 'null', don't write to file
            if ('null' == \trim($out)) {
                throw new RuntimeWarning('No contents generated');
            }

            $this->write($out, null);

        } catch (\Exception $e) {
            $this->debug($e);
            return $e->getCode();
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSynopsis($tab = Formatter::TAB)
    {
        $format = "{$tab}%s [options] <infile>\n{$tab}cat <infile> | %s [options]";

        return sprintf($format, $this->name, $this->name);
    }

    /**
     * Print message with DEBUG verbosity level
     *
     * @param string $message
     */
    protected function debug($message)
    {
        $this->dmesg($message, Verbosity::DEBUG);
    }

    /**
     * Get contents from input file or stdin if file is null or "-"
     *
     * @param bool        $interactive Enable/disable listening on user input
     * @param string|null $filename    Relative or absolute path to the input file
     *
     * @return false|string
     */
    protected function getContents($interactive, $filename = null)
    {
        if (null === $filename || '-' === $filename) {
            return $this->read($interactive);
        }

        return \file_get_contents($filename);
    }

    /**
     * @param string $contents
     *
     * @return bool
     */
    protected function isJson($contents)
    {
        return(in_array(substr(trim($contents), 0, 1), ['{', '[']));
    }

    /**
     * @param string $json
     *
     * @return StdClass
     */
    protected function fromJson($json)
    {
        $this->debug('Loading JSON contents...');
        return Json::decode($json);
    }

    /**
     * @param StdClass $object
     *
     * @return string
     */
    protected function toYaml($object)
    {
        $this->debug('Converting to YAML...');
        return Yaml::encode($object);
    }

    /**
     * @param string $yaml
     *
     * @return StdClass
     */
    protected function fromYaml($yaml)
    {
        $this->debug('Loading YAML contents...');
        return Yaml::decode($yaml);
    }

    /**
     * @param StdClass $object
     *
     * @return string
     */
    protected function toJson($object)
    {
        $this->debug('Converting to JSON...');
        return Json::encode($object);
    }
}
