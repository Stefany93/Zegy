<?php
    class Comments extends CommonQueries
    {
        protected $commentId;
        protected $postId;

        public function setCommentId($commentId)
        {
            $this->commentId = $commentId;
        }

        public function getCommentId()
        {
           return $this->commentId;
        }

         public function setPostId($postId)
        {
            $this->postId = $postId;
        }
         public function getPostId()
        {
           return $this->postId;
        }
        public function getComments()
        {
            return parent::fetchAllsCond('topic_id', $this->postId);
        }

        public function countComments()
        {
            return parent::fetchOneColumn('topic_id', $this->postId, 'COUNT(id)');
        }

        public function insertComment($values_array, $num_values)
        {
            return parent::insert($values_array, $num_values);
        }
        public function getComment()
        {
            return parent::fetchOneColumn('id', $this->getCommentId(), 'comment' );
        }
    }