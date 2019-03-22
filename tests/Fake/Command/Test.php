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

use Aura\Cli\Status;

class Test extends Command
{
    public function __invoke()
    {
        $this->not_exsits;
    }
}
