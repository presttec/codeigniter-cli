<?php
/**
 * Part of Cli for CodeIgniter
 *
 * @author     PrestTEC <https://github.com/presttec>
 * @license    MIT License
 * @copyright  2015 PrestTEC
 * @link       https://github.com/presttec/codeigniter-cli
 */

namespace PrestTEC\CodeIgniter_Cli\Command\Generate;

use Aura\Cli\Stdio;
use Aura\Cli\Context;
use Aura\Cli\Status;
use PrestTEC\CodeIgniter_Cli\Command\Command;
use CI_Controller;

/**
 * @property \CI_Loader $load
 * @property \CI_Config $config
 */
class Models extends Command
{
    public function __construct(Context $context, Stdio $stdio, CI_Controller $ci)
    {
        parent::__construct($context, $stdio, $ci);
    }

    /**
     * @param string $type
     * @param string $classname
     */
    public function __invoke($type, $classname)
    {
        if ($classname === null) {
            $this->stdio->errln(
                '<<red>>Classname is needed<<reset>>'
            );
            $this->stdio->errln(
                '  eg, generate models CreateUserModel'
            );
            return Status::USAGE;
        }

        $model_path = $this->config->item('model_path');
        $model_type = $this->config->item('model_type');

        $file_path = $this->generateFilename(
            $model_path, $model_type, $classname
        );

        // check file exist
        if (file_exists($file_path)) {
            $this->stdio->errln(
                "<<red>>The file \"$file_path\" already exists<<reset>>"
            );
            return Status::FAILURE;
        }

        // check class exist
        foreach (glob($model_path . '*_*.php') as $file) {
            $name = basename($file, '.php');
            if (preg_match($model_type === 'timestamp' ? '/^\d{14}_(\w+)$/' : '/^\d{3}_(\w+)$/', $name, $match)) {
                if (strtolower($match[1]) === strtolower($classname)) {
                    $this->stdio->errln(
                        "<<red>>The Class \"$match[1]\" already exists<<reset>>"
                    );
                    return Status::FAILURE;
                }
            }
        }

        $template = file_get_contents(__DIR__ . '/templates/Migration.txt');
        $search = [
            '@@classname@@',
            '@@date@@',
        ];
        $replace = [
            $classname,
            date('Y/m/d H:i:s'),
        ];
        $output = str_replace($search, $replace, $template);
        $generated = @file_put_contents($file_path, $output, LOCK_EX);

        if ($generated !== false) {
            $this->stdio->outln('<<green>>Generated: ' . $file_path . '<<reset>>');
        } else {
            $this->stdio->errln(
                "<<red>>Can't write to \"$file_path\"<<reset>>"
            );
            return Status::FAILURE;
        }
    }

    private function generateFilename($model_path, $model_type, $classname)
    {
        if ($model_type === 'sequential') {
            $migrations = [];

            // find max version
            foreach (glob($model_path . '*_*.php') as $file) {
                $name = basename($file, '.php');

                if (preg_match('/^\d{3}_(\w+)$/', $name)) {
                    $number = sscanf($name, '%[0-9]+', $number) ? $number : '0';
                    $migrations[] = $number;
                }
            }

            $version = 0;
            if ($migrations !== []) {
                $version = max($migrations);
            }

            return $model_path . sprintf('%03d', ++$version) . '_' . $classname . '.php';
        }

        return $model_path . date('YmdHis') . '_' . $classname . '.php';
    }
}
