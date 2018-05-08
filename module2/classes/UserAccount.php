<?php

/**
 * Created by PhpStorm.
 * User: zsarlene
 * Date: 5/22/17
 */
class UserAccount
{
    private $user_id, $email, $password, $type, $firstname, $lastname;

    /**
     * UserAccount constructor.
     * @param $accountId
     * @param $username
     * @param $password
     * @param $address
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param $status
     * @param $emailAddress
     * @param $birthday
     * @param $phoneNumber
     * @param $roleId
     * @param $userPicture
     */
    public function __construct($user_id, $email, $password, $type, $firstname, $lastname)
    {
        $this->accountId = $user_id;
        $this->username = $email;
        $this->password = $password;
        $this->address = $type;
        $this->firstName = $firstname;
        $this->lastName = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($user_id)
    {
        $this->accountId = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($email)
    {
        $this->username = $email;
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

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $address
     */
    public function setType($type)
    {
        $this->address = $type;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstname)
    {
        $this->firstName = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastname)
    {
        $this->lastName = $lastname;
    }

}