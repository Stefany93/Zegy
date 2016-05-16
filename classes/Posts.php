<?php
class Posts extends CommonQueries
{
    protected $postId;
    protected $categoryId;
    protected $authorId;
     public function setAuthorId($authorId)
    {   
        $this->authorId = $authorId;
    }
    public function getAuthorId()
    {
        return $this->authorId;
    }
    public function setpostId($postId)
    {   
        $this->postId = $postId;
    }
    public function getPostId()
    {
        return $this->postId;
    }
    public function setCategoryId($categoryId)
    {   
        $this->categoryId = $categoryId;
    }
    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function getTopics($where = 'category_id')
    {
        if(isset($this->postId))
        {
            return parent::fetchAllsCond( $where, $this->getPostId() );
        }elseif(isset($this->categoryId))
        {
            return parent::fetchAllsCond( $where, $this->getCategoryId(), $operator = '=', "ORDER BY last_post DESC" );
        }
        elseif(isset($this->authorId))
        {
            return parent::fetchAllsCond( $where, $this->getAuthorId() );
        }
    }
   /* public function countComments()
    {
        $query = $this->queryBuilder
                     ->select('comments_id')
                     ->from('comments')
                     ->where('comments_topic_id = 1')
                     ->execute();
        return $query->fetchAll();
    }*/
    public function getTopic()
    {
        return parent::fetchOneRowWithCond('id', $this->postId);
    }
    public function countTopics()
    {
        return parent::fetchOneColumn('category_id', $this->categoryId, 'COUNT(id)');
    }

    public function getCategories()
    {
        return parent::fetchAlls();
    }
    public function insertPost($values_array, $num_values)
    {
        return parent::insert($values_array, $num_values);
    }
}



