<?php

namespace CALOS\Entities;

/**
 * Description of user
 *
 * @author TrungHieu
 */
class UserEntity
{
    public $id;
    public $email;
    public $password;
    public $new_pass_token;
    public $display_name;
    public $first_name;
    public $last_name;
    public $mobile_phone;
    public $home_phone;
    public $office_phone;
    public $address;
    public $gender;
    private $_metas = array();
    
    public function __construct($id = NULL)
    {
	$this->id = $id;
    }
    
    public function get_id(){
	return $this->id;
    }

}

?>
