<?php 

namespace Isaiahiroko\LvrState;

class State{
    
    private $state = array();

    public function get($key, $default = null)
    {
        return (array_has($this->state, $key)) ? array_get($this->state, $key, $default) : null;
    }

    public function set($key, $value = null)
    {
        
        $value = (is_array($key)) ? $key : [$key => $value];

        foreach ($value as $k => $v) {
            array_set($this->state, $k, $v);
        }

    }

    public function has($key)
    {
        return array_has($this->state, $key) && !empty(array_get($this->state, $key)) && !is_null(array_get($this->state, $key));
    }
}