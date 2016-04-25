<?php
    class Validate
    {
        protected $data;
        protected $errors = array();
        protected $required = array();
        protected $missing = array();
        function ___construct($data, $superglobal)
        {
           $this->data = $_POST;
          // print_r($this->data);
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
                var_dump($data);
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
    }


  // $v = new Validate;

  // $v->checkMissing($data = 'lol');
  // print_r($v->getMissing());
  // $v->checkLength('name', 5, 10);
  // print_r($v->getErrors());