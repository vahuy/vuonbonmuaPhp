<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/14/2019
 * Time: 11:32 AM
 */

class UserAccount extends stdClass {
    private $name;
    private $password;
    private $id;


    /**
     * UserAccount constructor.
     * @param $name
     * @param $password
     */

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function toString() {
        return json_encode($this);
    }


}