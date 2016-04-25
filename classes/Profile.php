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
    public function sendPrivateMessage($sender_id, $receiver_id, $message)
    {
        extract($message);
        $query = $this->newQuery()
                      ->insert('private_messages')
                      ->values(
                                array(
                                     'sender_id' => '?',
                                     'receiver_id' => '?',
                                     'message' => '?',
                                     'date_send' => "STRFTIME('%s','now')"
                                    )
                               )
                        ->setParameter(0, $sender_id)
                        ->setParameter(1, $receiver_id)
                        ->setParameter(2, $message)
                        ->execute();
        return true;
    }
    public function listPrivateMessages()
    {
        return parent::fetchAllsCond('receiver_id', $this->userId);
    }
}