<?php

  abstract public bool close ( void )
abstract public bool destroy ( string $session_id )
abstract public bool gc ( int $maxlifetime )
abstract public bool open ( string $save_path , string $name )
abstract public string read ( string $session_id )
abstract public bool write ( string $session_id , string $session_data )
    class Session extends CommonQueries implements SessionHandlerInterface
    {
        protected $sessionName;
        protected $sessionId;
        private $savePath;
    
      function __construct()
      {
        session_set_save_handler(
          array(&$this, 'open'),
          array(&$this, 'close'),
          array(&$this, 'read'),
          array(&$this, 'write'),
          array(&$this, 'destroy'),
          array(&$this, 'clean'));
     
        session_start();
      }
       public function open($savePath, $sessionName)
    {
        $this->savePath = $savePath;
        return true;
    }
        
    public function close()
    {
        return true;
    }

    public function read($id)
    {
        return parent::fetchOneColumn('id', $id, 'data');  
    }

    public function write($id, $data)
    {
        $session_data = array('id' => $id, 'data' => $data);
        return replace( $session_data, count($session_data) );
    }

    public function destroy($id)
    {
        parent::delete('id', $id);
        return true;
    }
//filemtime($file) + $maxlifetime < time()
    public function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
    /**
     * Gets the value of sessionName.
     *
     * @return mixed
     */
    public function getSessionName()
    {
        return $this->sessionName;
    }

    /**
     * Sets the value of sessionName.
     *
     * @param mixed $sessionName the session name
     *
     * @return self
     */
    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;

        return $this;
    }
}

/*
  Session class by Stephen McIntyre
  http://stevedecoded.com
*/


