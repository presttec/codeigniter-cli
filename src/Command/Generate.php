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

class Generate extends Command
{
    public function __invoke($type, $classname = null)
    {
        $generator = __NAMESPACE__ . '\\Generate\\' . ucfirst($type);
        if (! class_exists($generator)) {
            $this->stdio->errln(
                '<<red>>No such generator class: ' . $generator . '<<reset>>'
            );
            return Status::FAILURE;
        }

        $command = new $generator($this->context, $this->stdio, $this->ci);
        return $command($type, $classname);
    }
}
