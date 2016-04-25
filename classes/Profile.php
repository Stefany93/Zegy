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
}