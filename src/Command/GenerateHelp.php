<?php
/**
 * Part of Cli for CodeIgniter
 *
 * @author     PrestTEC <https://github.com/presttec>
 * @license    MIT License
 * @copyright  2015 PrestTEC
 * @link       https://github.com/presttec/codeigniter-cli
 */

namespace PrestTEC\CodeIgniter_Cli\Command;

use Aura\Cli\Help;

class GenerateHelp extends Help
{
    public function init()
    {
        $this->setSummary('Generate code.');
        $this->setUsage('migration <classname>');
        $this->setUsage([
            'migration <classname>  Generate migration file skeleton',
        ]);
        $this->setDescr(
            '<<bold>>generate<<reset>> command generates code.' . PHP_EOL
            . '        eg, generate migration Create_user_table'
        );
    }
}
