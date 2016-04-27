<?php

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
        // garbage collector

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
