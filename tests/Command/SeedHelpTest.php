<?php

namespace PrestTEC\CodeIgniter_Cli\Command;

use Aura\Cli\Context\OptionFactory;

class SeedHelpTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->help = new SeedHelp(new OptionFactory);
    }

    public function test_get_help()
    {
        $actual = $this->help->getSummary('run');
        $expected = 'No such generator class: PrestTEC\CodeIgniter_Cli\Command\Generate\Not_exists' . PHP_EOL;
        $this->assertEquals('Seed the database with records.', $actual);
    }
}
