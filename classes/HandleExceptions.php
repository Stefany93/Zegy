<?php
    include 'vendor/autoload.php';
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\FirePHPHandler;
    class HandleExceptions
    {
        private $mode;
        private $logger;
        function __construct($mode)
        {
            // Create the logger
            $logger = new Logger('error_log');
            // Now add some handlers
            $logger->pushHandler(new StreamHandler('C:\xampp\htdocs\my-projects\zegy\log/error_log.log', Logger::ERROR));
            if(!isset($mode))
            {
                throw new Exception("You must provide website mode for the constructor of ". __CLASS__ . " class!");
            }
            if(!in_array($mode,  array('Development', 'Production') ) )
            {
                throw new Exception("Invalid value for constructor! Possible values are 'Development' or 'Production' ");
            }
            $this->mode = $mode;
            $this->logger = $logger;
        }

        final private function formatException($exception)
        {
            if(empty($exception) or !isset($exception))
            {
                throw new Exception("Please provide an exception for the ". __FUNCTION__. " function!");
            }
            return sprintf("Exception thrown in file *%s*, \n line *%s*, \n with the message *%s* ",
                             $exception->getFile(), $exception->getLine(), $exception->getMessage() );
        }

        public function parseException($exception)
        {
            if($this->mode == 'Development')
            {
               return $this->formatException($exception);

            }elseif ($this->mode == 'Production') 
            {
                $this->logger->addError( $this->formatException($exception) );
                
            }
        }
    }