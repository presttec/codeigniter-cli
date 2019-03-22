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

class MigrateHelp extends Help
{
    public function init()
    {
        $this->setSummary('Runs the migrations.');
        $this->setUsage([
            '            Migrate up to the current version.',
            '<version>   Migrate up to the version.',
            'status      List all migration files and versions.',
            'version     Show migration versions.'
        ]);
        $this->setDescr(
            '<<bold>>migrate<<reset>> command runs the migrations and shows its status.' . PHP_EOL
        );
    }
}
