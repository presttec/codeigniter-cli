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

class SeedHelp extends Help
{
    public function init()
    {
        $this->setSummary('Seed the database with records.');
        $this->setUsage([
            '',
            '<class>'
        ]);
        $this->setOptions([
            'l,list' => "List all seeder files only. With this option, seeding does not run.",
        ]);
        $this->setDescr(
            'Seed the database using Seeder class in "application/database/seeds" folder.'
        );
    }
}
