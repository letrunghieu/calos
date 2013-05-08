<?php

namespace CALOS\Entities;

/**
 * Description of MetaEntity
 *
 * @author TrungHieu
 */
class MetaEntity
{

    const TYPE_TEXT = 'text';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_SELECT_SINGLE = 'select_single';
    const TYPE_SELECT_MULTI = 'select_multi';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_RAW = 'raw';

    public $key;
    public $title;
    public $description;
    public $type;
    public $object;
    public $domain;
    private $_id;

    public function __construct($id = NULL)
    {
	$this->_id = $id;
    }

    public function get_id()
    {
	return $this->_id;
    }

}

?>
