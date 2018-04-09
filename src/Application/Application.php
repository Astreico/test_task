<?php

namespace Application;

class Application
{
    /**
     * @var array
     */
    protected $input;

    /**
     * @var string
     */
    protected $class;


    public function __construct()
    {
        $router = parse_ini_file('./router.ini', true);
        $input = $_SERVER['argv'];
        array_shift($input); // remove file name from input
        $command = array_shift($input);
        $class = isset($router[$command]) ? (isset($router[$command]['class']) ? $router[$command]['class'] : false) : false;
        $this->input = $input;
        $this->class = $class;
    }

    public function run()
    {
        $commandClassName = 'Application\\Command\\'.$this->class;
        if (class_exists($commandClassName)) {
            $class = new $commandClassName();
            return $class->execute($this->input);
        } else {
            Throw new \Exception('Invalid command');
        }
    }

    public static function writeLn($string)
    {
        print "\n\n";
        print $string;
        print "\n\n";
    }
}
