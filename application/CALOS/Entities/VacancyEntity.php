<?php namespace CALOS\Entities;

/**
 * Description of VacancyEntity
 *
 * @author TrungHieu
 */
class VacancyEntity
{
    public $id;
    public $name;
    public $description;
    public $is_valid;
    public $capacity;
    public $order;
    public $org_unit_id;
    public $members = array();
    
    public function is_removable()
    {
	return $this->order > 0 && $this->order < 1000;
    }
}

?>
