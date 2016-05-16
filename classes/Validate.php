<?php
    class Validate
    {
        protected $data;
        protected $errors = array();
        protected $required = array();
        protected $missing = array();
        function ___construct($superglobal)
        {
           $this->data = $_POST;
        }
        public function setRequired($req)
        {
          return $this->required;
        }
        public function setData($data)
        {
          $this->data = $data;
        }
        public function getData()
        {
          return $this->data;
        }
        public static function isNumericString($data, $superglobal = null)
        {
            if($superglobal == 'post')
            {
             return $data =  filter_input(INPUT_POST, $data, FILTER_VALIDATE_INT);
            }elseif($superglobal == 'get')
            {
              return $data = filter_input(INPUT_GET, $data, FILTER_VALIDATE_INT);
            }
           if( !$data or is_null($data) )
           {
                throw new Exception("String is not numeric!");
           }else
           {
            return $data;
           }
        }
        public function checkLength($fieldName, $min, $max)
        {
          if(strlen($this->data[$fieldName]) < $min or strlen($this->data[$fieldName]) > $max )
          {
            $this->errors[$fieldName] = sprintf(" must be longer than %s and shorter than %s ",  $min, $max);            
          }
        }
        public function checkEmail($fieldName)
        {
          if(!filter_var($this->data[$fieldName], FILTER_VALIDATE_EMAIL))
          {
            $this->errors[$fieldName] = sprintf(" is invalid!");            
          }
        }
        public function checkMissing( $exceptions_array = array())
        {
     //     $this->data = array('name' => '111111ssssssss', 'age' => '');
          $number_of_fields = count($this->data);
              foreach ($this->data as $key => $value)
               {
                if(empty($value) and !in_array($key, $exceptions_array))
                {
                  $this->missing[$key] = ' is mandatory!';
                }
              }
        }
        public function checkLogin($loginMethod)
        {
          if(!$loginMethod)
          {
            $this->errors['login'] = sprintf(" wrong password/username combination!");
          }
        }
        public function checkAlphaNumeric($fieldName)
        {
          $re = "/^[a-z]+[a-z0-9]*$/i";
          if( !preg_match($re, $this->data[$fieldName]) )
          {
            $this->errors[$fieldName]  = sprintf( " must  start with a letter and contain only numbers & leters!");
          }
        }
        protected function formatErrors($array)
        {
          array_walk($array, function(&$value, $key){
                    $value = ucfirst($key).$value;
          });
          return $array;
        }
        public function getMissing()
        {
          return $this->formatErrors( $this->missing );
        }
        public function getErrors()
        {
          return $this->formatErrors( $this->errors );
        }
        protected function loopErrors($errorsArray)
        {
          $allErrors = '';
          foreach ($errorsArray as $error) 
          {
            $allErrors .=  sprintf('<p class="error"> %s </p>', $error);
          }
          return $allErrors;
        }
        public function presentErrors()
        {
          if( empty( $this->getMissing() ) and empty( $this->getErrors() ) )
          {
            return false;
          }
          return true;
        }
        public function returnErrorsOrMissing()
        {
          if( !empty($this->getMissing() ))
          {
            return $this->loopErrors( $this->getMissing() );
          }
          if( !empty($this->getErrors() ))
          {
            return $this->loopErrors( $this->getErrors() );
          }
        }
    }


  // $v = new Validate;

  // $v->checkMissing($data = 'lol');
  // print_r($v->getMissing());
  // $v->checkLength('name', 5, 10);
  // print_r($v->getErrors());