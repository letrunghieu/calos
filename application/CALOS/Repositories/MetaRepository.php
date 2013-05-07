<?php

namespace CALOS\Repositories;

use CALOS\Entities\MetaEntity;

/**
 * Description of MetaRepository
 *
 * @author TrungHieu
 */
class MetaRepository
{

    /**
     * 
     * @param type $meta_id
     * @return \CALOS\Entities\MetaEntity
     */
    public static function find_by_id($meta_id)
    {
	$meta = \Meta::find($meta_id);
	if ($meta)
	{
	    return static::convert_from_orm($meta);
	}
	return null;
    }

    /**
     * 
     * @param type $meta_ids
     * @return \CALOS\Entities\MetaEntity
     */
    public static function find_by_multi_id($meta_ids)
    {
	$metas = \Meta::where_in('id', $meta_ids)->get();
	$result = array();
	foreach ($metas as $m)
	{
	    $result[] = static::convert_from_orm($m);
	}
	return $result;
    }

    /**
     * 
     * @param type $meta_key
     * @return \CALOS\Entities\MetaEntity
     */
    public static function find_by_key($meta_key)
    {
	$meta = \Meta::where('key', '=', $meta_key)->first();
	if ($meta)
	{
	    return static::convert_from_orm($meta);
	}
	return null;
    }

    /**
     * 
     * @param type $object_name
     * @return \CALOS\Entities\MetaEntity
     */
    public static function find_all_of_object($object_name)
    {
	$metas = \Meta::where('object', '=', $object_name)->get();
	$result = array();
	foreach ($metas as $m)
	{
	    $result[] = static::convert_from_orm($m);
	}
	return $result;
    }

    /**
     * 
     * @param type $meta_entity
     * @return boolean
     */
    public static function update_meta($meta_entity)
    {
	$meta = \Meta::find($meta_entity->id);
	if ($meta)
	{
	    $meta->meta_key = $meta_entity->key;
	    $meta->title = $meta_entity->title;
	    $meta->description = $meta_entity->description;
	    $meta->object = $meta_entity->object;
	    $meta->domain = $meta_entity->domain;
	    $meta->type = $meta_entity->type;
	    return $meta->save();
	}
	else
	    return false;
    }

    /**
     * 
     * @param type $key
     * @param type $title
     * @param type $description
     * @param type $type
     * @param type $object
     * @param type $domain
     * @return \CALOS\Entities\MetaEntity
     */
    public static function create_meta($key, $title, $description = null, $type = MetaEntity::TYPE_RAW, $object = '', $domain = null)
    {
	$meta_key = $key;
	$data = compact('meta_key', 'title', 'description', 'type', 'object','domain');
	$meta = \Meta::create($data);
	if ($meta)
	    return static::convert_from_orm($meta);
	else
	    return null;
    }

    /**
     * 
     * @param type $meta
     * @return \CALOS\Entities\MetaEntity
     */
    private static function convert_from_orm($meta)
    {
	$meta_entity = new MetaEntity($meta->id);
	$meta_entity->key = $meta->meta_key;
	$meta_entity->value = $meta->value;
	$meta_entity->title = $meta->title;
	$meta_entity->description = $meta->description;
	$meta_entity->object = $meta->object;
	$meta_entity->domain = $meta->domain;
	$meta_entity->type = $meta->type;

	return $meta_entity;
    }

}

?>
