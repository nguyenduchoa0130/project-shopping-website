<?php
class Account
{
    public $id_user;
    public $username;
    public $password;
    public $email;
    public $fullname;
    public $gender;
    public $birth;
    public $phone;
    public $address;
    public $role;
    public function __construct(array $prop)
    {
        $this->id_user = $prop["id_user"];
        $this->username = $prop["username"];
        $this->password = $prop["password"];
        $this->email = $prop["email"];
        $this->fullname = $prop["fullname"];
        $this->gender = $prop["gender"];
        $this->birth = $prop["birth"];
        $this->phone = $prop["phone"];
        $this->address = $prop["address"];
        $this->role = $prop["role"];
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}
