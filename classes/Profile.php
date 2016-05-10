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
        return parent::fetchAllsCond('receiver_id', $this->userId);
    }
    public function register($values_array, $num_values)
    {
        return parent::insert($values_array, $num_values);
    }
    public function login($password, $email)
    {

        // if( empty( parent::fetchOneRowWithCond('password', $password) )
        // {
        //     //
        // }
    }
}