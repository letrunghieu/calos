<?php

class Vacancy extends Basemodel
{
    public static $timestamps = true;

    public static $rules = array(
        
    );

    public function organizationunit() {
        return $this->belongs_to('OrganizationUnit');
    }

//    public function supervisor_vacancy()
//    {
//	return $this->belongs_to('Vacancy', 'supervisor_id');
//    }
//    
//    public function supervised_vacancies()
//    {
//	return $this->has_many('Vacancy', 'supervisor_id');
//    }
    
    public function members()
    {
	return $this->has_many_and_belongs_to('User', 'user_vacancy');
    }
}