<?php
    class HandleExceptions
    {
        private $mode;
        function __construct($mode)
        {
            if(!isset($mode))
            {
                throw new Exception("You must provide website mode for the constructor of ". __CLASS__ . " class!");
            }
            if(!in_array($mode,  array('Development', 'Production') ) )
            {
                throw new Exception("Invalid value for constructor! Possible values are 'Development' or 'Production' ");
            }
            $this->mode = $mode;
        }

        final private function formatException($exception)
        {
            if(empty($exception) or !isset($exception))
            {
                throw new Exception("Please provide an exception for the ". __FUNCTION__. " function!");
            }
            return sprintf("Exception thrown in file %s, line %s, with the message '%s' ",
                             $exception->getFile(), $exception->getLine(), $exception->getMessage() );
        }

        public function logOrDisplay($exception)
        {
            if($this->mode == 'Development')
            {
               return $this->formatException($exception);

            }elseif ($this->mode == 'Production') 
            {
                echo 'log it';
            }
        }
    }