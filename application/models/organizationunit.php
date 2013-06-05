<?php

class OrganizationUnit extends Basemodel
{

    public static $timestamps = true;
    public static $rules = array(
    );

    public function vacancies()
    {
	return $this->has_many('Vacancy');
    }

    public function parent_unit()
    {
	return $this->belongs_to('OrganizationUnit', 'parent_id');
    }

    public function child_units()
    {
	return $this->has_many('OrganizationUnit', 'parent_id');
    }
    
    public function leader_vacancy()
    {
	return $this->belongs_to('Vacancy', 'leader_vacancy_id');
    }

}