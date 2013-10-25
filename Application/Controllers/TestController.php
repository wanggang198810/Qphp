<?php

/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class TestController extends Controller{
    //put your code here
    public function index(){
        
    }
    
    
    
    public function t3(){
        $data = array('key'=>1);
        $name = 'key';
        echo $data[$name];//exit;
        $a = array(12,120,5,45,456,44,65,89,45,85);
        $m = microtime(true);
        $p = 0;
        
        
        for($i=0;$i<10;$i++){
            if($a[$i] < $a[$i+1]){
                
            }
            
        }
        
    }
    
    
    
    public function t2(){
        $a = 1;
        $c = $a + $a++;
        echo $c.'<br>';
        $a = 1;
        $b = $a + $a + ($a++);
        echo $b;
    }
    
    public function resource(){
        $r =resourcebundle_create( 'es', "1.txt");
        //resourcebundle_create($locale, $bundlename, $fallback);
        echo $r['teststring'];
    }
    
    public function text(){
        echo 0x5f3759df,'<Br>';
        echo 0x5f375a86;
        $str1 = 'bd';
        $str2 = 'ad';
        //echo similar_text($str1, $str2, $per),'<Br>';
        //echo $per;
    }
    
    public function md5file(){
        echo md5_file('1.txt'),'<br>';
        echo md5_file('2.txt');
    }
    
    public function counter2(){
        echo str_rot13('PHP 4.3.0'),'<br>'; 
        echo LOG_PERROR  ;
        //echo Counter::getValue();
    }
    
    
    
    public function counter(){
        $starting_counter_value = counter_get();
        counter_bump(1);
        $second_counter_value = counter_get();
        counter_reset();
        $final_counter_value = counter_get();
        printf("%3d %3d %3d", $starting_counter_value, $second_counter_value, $final_counter_value);
    }
    
    
    public function counterMeta(){
        if (($counter_one = counter_get_named("one")) === NULL) {
            $counter_one = counter_create("one", 0, COUNTER_FLAG_PERSIST);
        }
        counter_bump_value($counter_one, 2);
        $counter_two = counter_create("two", 5);
        $counter_three = counter_get_named("three");
        $counter_four = counter_create("four", 2, COUNTER_FLAG_PERSIST | COUNTER_FLAG_SAVE | COUNTER_FLAG_NO_OVERWRITE);
        counter_bump_value($counter_four, 1);

        $this->print_counter_info($counter_one);
        $this->print_counter_info($counter_two);
        $this->print_counter_info($counter_three);
        $this->print_counter_info($counter_four);

    }
    
    function print_counter_info($counter){
        if (is_resource($counter)) {
            printf("计数器的名称为 '%s'，且%s进行持久化。其当前值为 %d.\n",
                counter_get_meta($counter, COUNTER_META_NAME),
                counter_get_meta($counter, COUNTER_META_IS_PERSISTENT) ? '' : '不',
                counter_get_value($counter));
        } else {
          print "计数器无效!\n";
        }
    }


}

?>
