<?php
    class User
    {
        protected $user_id;
        protected $role;
        function __construct($user_id)
        {
           if(!isset($user_id) or !is_numeric($user_id))
           {
                throw new Exception("First argument of " .__CLASS__. " object must be int!");
           }

           $this->user_id = $user_id;
        }

        public function role()
        {
            //get the role of the user from DB........
            // $number_for_role......
            $number_for_role = 1;
            switch ($number_for_role) 
            {
                case 1:
                    $role = 'user';
                    break;
                       case 2:
                    $role = 'moderator';
                    break;
                       case 3:
                    $role = 'admin';
                    break;
                default:
                    # code...
                    break;
            }
            $this->role = $role;
            return $this->role;
        }
        public function isLoggedIn()
        {
            if(isset($_SESSION['session_user_id']) and $_SESSION['session_user_id']
            {
                return true;
            }else
            {
                return false;
            }
        }
    }
    try
    {
        $c = new User(1);
        echo $c->role();
    }catch(Exception $e)
    {
        echo $e->getMessage();
    }