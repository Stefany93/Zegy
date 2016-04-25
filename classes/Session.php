<?php
    class Session
    {
        protected $sessionName;
    
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