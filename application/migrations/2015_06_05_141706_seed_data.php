<?php

class Seed_Data
{

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
	$admin_user = \CALOS\Repositories\UserRepository::create('letrunghieu.cse09@gmail.com', Hash::make('admin'), 'Hiếu', 'Lê');

	$org = \CALOS\Repositories\OrganizationUnitRepository::create("Câu lạc bộ tiếng Anh Bách Khoa", "", NULL);

	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Nội dung", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Kỹ thuật", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Nhân sự", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Truyền thông", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Hậu cần", "", $org->id);

	foreach ($level1 as $unit)
	{
	    \CALOS\Repositories\OrganizationUnitRepository::create("Phân nhóm Cơ sở 2", "", $unit->id);
	}
	
	\CALOS\Repositories\OrganizationUnitRepository::assign_leader($org->id, $admin_user->id);
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
	//
    }

}