<?php

class User extends Basemodel
{

    public static $timestamps = true;
    public static $rules = array(
	'username' => 'required',
	'email' => 'required|mail',
	'password' => 'required',
    );

    public function roles()
    {
	return $this->has_many_and_belongs_to('Role', 'role_user');
    }

    public function has_role($key)
    {
	foreach ($this->roles as $role)
	{
	    if ($role->name == $key)
	    {
		return true;
	    }
	}

	return false;
    }

    public function has_any_role($keys)
    {
	if (!is_array($keys))
	{
	    $keys = func_get_args();
	}

	foreach ($this->roles as $role)
	{
	    if (in_array($role->name, $keys))
	    {
		return true;
	    }
	}

	return false;
    }
    
    public function metas()
    {
	return $this->has_many_and_belongs_to('Meta', 'metavalues', 'object_id', 'meta_id')->with('meta_value');
    }
    
    public function vacancies()
    {
	return $this->has_many_and_belongs_to('Vacancy', 'user_vacancy');
    }

}