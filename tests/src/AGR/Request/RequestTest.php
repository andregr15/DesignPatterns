<?php
namespace AGR\Request;

class RequestTest extends \PHPUnit_Framework_TestCase {

    public function testClassType(){
        $this->assertInstanceOf("AGR\Request\Request", new \AGR\Request\Request());
    }
}


?>