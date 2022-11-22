<?php

/**
 * A simple program for finding nearest smaller item of an array of integer.
 */
class NSN
{
    /**
     * 
     *
     * @var SplStack
     */
    private $stk;

    /**
     * Result array
     *
     * @var array
     */
    private $res;

    public static function main(): void
    {
        // $arr = [1,3,4,2,5,3,4,2];
        $arr = [10,9,11,10,12,11];

        $tmp=((new Self())->nearestSmallerItem($arr));
        print_r($tmp);
    }

    public function nearestSmallerItem(array $arr): array
    {
        if (empty($arr)) {
            return null;
        }
        $index = 0;
        $this->res = array();
        $this->stk = new SplStack();

        do {
            $this->res[] = ["item" =>$arr[$index],"smaller-item"=>$this->check($arr, $index)];
        } while (++$index < sizeof($arr));
        return $this->res;
    }

    private function check(array $a, int $i)
    {
        if ($this->stk->isEmpty()) {
            $this->stk->push($a[$i]);
            return;
        }
        $small = null;
        
        do{  // WARNING: Hard time having working with php SplStack
            $this->stk->rewind();
            $curr = $this->stk->current();
            if($curr < $a[$i]){
               $small = $curr;
                break;
            }
            $this->stk->pop();
        }while($this->stk->valid());
        $this->stk->push($a[$i]);
        return $small;
        
    }
}

NSN::main();
