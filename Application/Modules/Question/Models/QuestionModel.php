<?php
/**
 * Description of QuestionModel
 *
 * @author air
 */
class QuestionModel extends Model{
    //put your code here
    
    public function getUnAnsweredQuestions( $limit=10 ){
        return $this->where( array('type'=> 2, 'replynum'=> 0) )->limit(" LIMIT {$limit}")->fetchArray();
    }
    
    
    public function getNewQuestions( $limit=10 ){
        return $this->where( array('type'=> 2) )->limit(" LIMIT {$limit}")->order(" ORDER BY id DESC")->fetchArray();
    }
    
    public function getHotQuestions($page=1, $pageSize=20, $total=0){
        return $this->where( array('type'=>2))->order(" ORDER BY replynum DESC")->page($page, $pageSize, $total);
    }
    
    
    public function getRecomQuestions($page=1, $pageSize=20, $total=0){
        return $this->where( array('type'=>2))->order(" ORDER BY top DESC")->page($page, $pageSize, $total);
    }
    
}


