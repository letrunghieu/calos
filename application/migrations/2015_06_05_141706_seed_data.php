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
	$org = \CALOS\Repositories\OrganizationUnitRepository::create("Câu lạc bộ tiếng Anh Bách Khoa", "", NULL);

	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Nội dung", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Kỹ thuật", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Nhân sự", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Truyền thông", "", $org->id);
	$level1[] = \CALOS\Repositories\OrganizationUnitRepository::create("Ban Hậu cần", "", $org->id);


	$admin_user = \CALOS\Repositories\UserRepository::create('letrunghieu.cse09@gmail.com', Hash::make('admin'), 'Hiếu', 'Lê');
	$users[] = \CALOS\Repositories\UserRepository::create('nhan.phanmanh@gmail.com', Hash::make('nhanphanmanh'), 'Nhân', 'Phan Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('son.nguyenmanh@gmail.com', Hash::make('sonnguyenmanh'), 'Sơn', 'Nguyễn Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('hoang.phanmanh@gmail.com', Hash::make('hoangphanmanh'), 'Hoàng', 'Phan Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('thong.tranba@gmail.com', Hash::make('thongtranba'), 'Thông', 'Trần Bá');
	$users[] = \CALOS\Repositories\UserRepository::create('tri.duongmanh@gmail.com', Hash::make('triduongmanh'), 'Trí', 'Dương Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('hoai.lemanh@gmail.com', Hash::make('hoailemanh'), 'Hoài', 'Lê Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('hanh.lygia@gmail.com', Hash::make('hanhlygia'), 'Hạnh', 'Lý Gia');
	$users[] = \CALOS\Repositories\UserRepository::create('hoai.phammanh@gmail.com', Hash::make('hoaiphammanh'), 'Hoài', 'Phạm Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('minh.vuthi@gmail.com', Hash::make('minhvuthi'), 'Minh', 'Vũ Thị');
	$users[] = \CALOS\Repositories\UserRepository::create('phu.ngoduc@gmail.com', Hash::make('phungoduc'), 'Phú', 'Ngô Đức');
	$users[] = \CALOS\Repositories\UserRepository::create('hanh.homau@gmail.com', Hash::make('hanhhomau'), 'Hạnh', 'Hồ Mậu');
	$users[] = \CALOS\Repositories\UserRepository::create('phu.nguyenduc@gmail.com', Hash::make('phunguyenduc'), 'Phú', 'Nguyễn Đức');
	$users[] = \CALOS\Repositories\UserRepository::create('dang.lyvan@gmail.com', Hash::make('danglyvan'), 'Đăng', 'Lý Văn');
	$users[] = \CALOS\Repositories\UserRepository::create('tin.huynhmanh@gmail.com', Hash::make('tinhuynhmanh'), 'Tín', 'Huỳnh Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('cam.ngomau@gmail.com', Hash::make('camngomau'), 'Cẩm', 'Ngô Mậu');
	$users[] = \CALOS\Repositories\UserRepository::create('nhan.huynhmanh@gmail.com', Hash::make('nhanhuynhmanh'), 'Nhân', 'Huỳnh Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('tin.duongtrong@gmail.com', Hash::make('tinduongtrong'), 'Tín', 'Dương Trọng');
	$users[] = \CALOS\Repositories\UserRepository::create('chau.ngodieu@gmail.com', Hash::make('chaungodieu'), 'Châu', 'Ngô Diệu');
	$users[] = \CALOS\Repositories\UserRepository::create('tin.ngomanh@gmail.com', Hash::make('tinngomanh'), 'Tín', 'Ngô Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('thu.hothi@gmail.com', Hash::make('thuhothi'), 'Thu', 'Hồ Thị');
	$users[] = \CALOS\Repositories\UserRepository::create('gam.phammanh@gmail.com', Hash::make('gamphammanh'), 'Gấm', 'Phạm Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('tin.dangdieu@gmail.com', Hash::make('tindangdieu'), 'Tín', 'Đặng Diệu');
	$users[] = \CALOS\Repositories\UserRepository::create('tue.dangmanh@gmail.com', Hash::make('tuedangmanh'), 'Tuệ', 'Đặng Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('nhan.trangia@gmail.com', Hash::make('nhantrangia'), 'Nhân', 'Trần Gia');
	$users[] = \CALOS\Repositories\UserRepository::create('hai.nguyengia@gmail.com', Hash::make('hainguyengia'), 'Hải', 'Nguyễn Gia');
	$users[] = \CALOS\Repositories\UserRepository::create('chau.nguyenmanh@gmail.com', Hash::make('chaunguyenmanh'), 'Châu', 'Nguyễn Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('cong.ngodieu@gmail.com', Hash::make('congngodieu'), 'Công', 'Ngô Diệu');
	$users[] = \CALOS\Repositories\UserRepository::create('phu.ngoba@gmail.com', Hash::make('phungoba'), 'Phú', 'Ngô Bá');
	$users[] = \CALOS\Repositories\UserRepository::create('duyen.dangtrong@gmail.com', Hash::make('duyendangtrong'), 'Duyên', 'Đặng Trọng');
	$users[] = \CALOS\Repositories\UserRepository::create('sang.phantrong@gmail.com', Hash::make('sangphantrong'), 'Sáng', 'Phan Trọng');
	$users[] = \CALOS\Repositories\UserRepository::create('huong.huynhmanh@gmail.com', Hash::make('huonghuynhmanh'), 'Hương', 'Huỳnh Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('nghia.homanh@gmail.com', Hash::make('nghiahomanh'), 'Nghĩa', 'Hồ Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('tin.tranmanh@gmail.com', Hash::make('tintranmanh'), 'Tín', 'Trần Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('sang.buimau@gmail.com', Hash::make('sangbuimau'), 'Sáng', 'Bùi Mậu');
	$users[] = \CALOS\Repositories\UserRepository::create('chau.buitrong@gmail.com', Hash::make('chaubuitrong'), 'Châu', 'Bùi Trọng');
	$users[] = \CALOS\Repositories\UserRepository::create('duyen.homanh@gmail.com', Hash::make('duyenhomanh'), 'Duyên', 'Hồ Mạnh');
	$users[] = \CALOS\Repositories\UserRepository::create('son.hoba@gmail.com', Hash::make('sonhoba'), 'Sơn', 'Hồ Bá');
	$users[] = \CALOS\Repositories\UserRepository::create('nhan.phamba@gmail.com', Hash::make('nhanphamba'), 'Nhân', 'Phạm Bá');
	$users[] = \CALOS\Repositories\UserRepository::create('an.dangmanh@gmail.com', Hash::make('andangmanh'), 'An', 'Đặng Mạnh');



	shuffle($users);
	$user_index = 0;
	$leader = $users[0];
	foreach ($level1 as $unit)
	{
	    \CALOS\Repositories\OrganizationUnitRepository::create("Phân nhóm Cơ sở 2", "", $unit->id);
	    CALOS\Repositories\OrganizationUnitRepository::assign_leader($unit->id, $users[$user_index++]->id);
	    for ($j = 0; $j < 7; $j++)
	    {
		if (count($users) - 1 > $user_index)
		    CALOS\Repositories\OrganizationUnitRepository::add_member($unit->id, $users[$user_index++]->id);
	    }
	}

	$unit = $level1[0];
	for ($j = 0; $j < 6; $j++)
	{
	    $title_j = $j + 1;
	    CALOS\Repositories\AnnouncementRepository::create("Announcement Foo {$title_j}", "Foo bar", $leader->id, $unit->id);
	}

	\CALOS\Repositories\OrganizationUnitRepository::assign_leader($org->id, $admin_user->id);
	for ($j = 0; $j < 3; $j++)
	{
	    $title_j = $j + 1;
	    CALOS\Repositories\AnnouncementRepository::create("Announcement Bar {$title_j}", "Foo bar", $admin_user->id, $org->id);
	}
	
	$today = new DateTime();
	# seed activities;
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc A", "", $admin_user->id, $org->id, $today->add(new DateInterval('P10D')));
	\CALOS\Repositories\ActivityRepository::assign_to($users[0]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	$parent_activity = $activity;
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc B", "", $admin_user->id, $org->id, $today->add(new DateInterval('P2D')));
	\CALOS\Repositories\ActivityRepository::assign_to($users[0]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, 100);
	\CALOS\Repositories\ActivityRepository::mark_complete($activity->id, "Công việc này đã hoàn thành");
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc C", "", $admin_user->id, $org->id, $today->add(new DateInterval('P1D')));
	\CALOS\Repositories\ActivityRepository::assign_to($users[0]->id, $activity->id, $admin_user->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc D", "", $admin_user->id, $org->id, $today->sub(new DateInterval('P10D')));
	\CALOS\Repositories\ActivityRepository::assign_to($users[0]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc E", "", $admin_user->id, $org->id, $today->sub(new DateInterval('P5D')));
	\CALOS\Repositories\ActivityRepository::assign_to($users[0]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc A.1", "", $users[0]->id, $org->id, $today->add(new DateInterval('P5D')), $parent_activity->id);
	\CALOS\Repositories\ActivityRepository::assign_to($users[1]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc A.2", "", $users[0]->id, $org->id, $today->add(new DateInterval('P1D')), $parent_activity->id);
	\CALOS\Repositories\ActivityRepository::assign_to($users[2]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc A.3", "", $users[0]->id, $org->id, $today->add(new DateInterval('P1D')), $parent_activity->id);
	\CALOS\Repositories\ActivityRepository::assign_to($users[3]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	$activity = \CALOS\Repositories\ActivityRepository::create("Công việc A.4", "", $users[0]->id, $org->id, $today->add(new DateInterval('P1D')), $parent_activity->id);
	\CALOS\Repositories\ActivityRepository::assign_to($users[4]->id, $activity->id);
	\CALOS\Repositories\ActivityRepository::update_progress($activity->id, rand(0, 75));
	
	
	
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