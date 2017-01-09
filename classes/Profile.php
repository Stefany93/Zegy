    <?php 
class Profile extends CommonQueries
{
    protected $userId;
    public function setUserId($userId)
    {   
        $this->userId = $userId;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getUsername()
    {
        return parent::fetchOneColumn('id', $this->userId, 'username');
    }
    public function getUserInfo()
    {
        return parent::fetchOneRowWithCond('id', $this->userId);
    }
    public function isLoggedIn()
    {
        return true;
    }
    public function listPrivateMessages()
    {
        return parent::fetchAllsCond('receiver_id', $this->userId, '=', 'ORDER BY id DESC');
    }
    public function viewPM($pm_id)
    {   
        return parent::fetchOneRowWithCond('id', $pm_id, '=');
    }
    public function sendPrivateMessage($data, $count_data)
    {
        return parent::insert($data, $count_data);
    }
    public function register($values_array, $num_values)
    {
        return parent::insert($values_array, $num_values);
    }
    public function login($password, $email)
    {

        if( !empty( parent::fetchOneRowWithCond('password', $password) ) )
        {
            $db_email =  trim(parent::fetchOneRowWithCond('password', $password)['email']);
            if(  strcmp($db_email, $email) != 0)
            {
                return false;
            }else
            {   
               // parent::update( array('logged_in' => 1), 1 );
                return parent::fetchOneRowWithCond('password', $password)['id'];
            }

        }
        return false;
    }
}