<?php 
/*@yuzixiu*/
class MessageWidget extends CWidget{  
       public function run(){  
			$id =  Yii::app()->user->getId();
			$count = Message::model()->count("recever_id=$id and read_status='0'"); 
			echo '<font color="#CD0000">('.$count.')</font>';
       }  
    }  

?>