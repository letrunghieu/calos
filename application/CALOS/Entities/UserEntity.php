<?php

namespace CALOS\Entities;

/**
 * Description of user
 *
 * @author TrungHieu
 */
class UserEntity
{
    
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
    private $_id;
    
    public function __construct($id = NULL)
    {
	$this->_id = $id;
    }

    /**
     * Get or set the value of a meta information of this user
     * 
     * @param string $key
     * @param mixed $value
     * @return null|boolean
     */
    public function meta($key, $value = NULL)
    {
	if (!key_exists($key, $this->_metas))
	    return NULL;
	$element = $this->_metas[$key];
	if ($value !== NULL)
	{
	    $this->_metas[$key] = $value;
	    return TRUE;
	}
	else
	{
	    return $element;
	}
    }

    public function metas()
    {
	return $this->_metas;
    }
    
    public function get_id(){
	return $this->_id;
    }

}

?>
