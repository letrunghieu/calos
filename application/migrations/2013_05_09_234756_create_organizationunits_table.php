<?php

class Create_Organizationunits_Table
{

    public function up()
    {
	Schema::create('organizationunits', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->text('description')->nullable();
		    $table->integer('leader_vacancy_id')->nullable();
		    $table->integer('parent_id')->nullable();
		    $table->timestamps();
		});

	$org = OrganizationUnit::create(array(
		    'name' => 'CALOS English club',
		    'description' => 'Welcome to CALOS system!',
	));

	$level1[] = OrganizationUnit::create(array(
		    'name' => 'Content Board',
		    'description' => 'Mancipia dolor ad per dicis me in modo genito in, eum in rei completo litus tuos sed quod una.'
	));
	$level1[] = OrganizationUnit::create(array(
		    'name' => 'Technical Board',
		    'description' => 'Modum quod eam eos Communicatio mihi cum magna anima haec sed eu fides se est amet amet amet consensit cellula rei exultant deo.'
	));
	$level1[] = OrganizationUnit::create(array(
		    'name' => 'Financial Board',
		    'description' => 'Sestertia domine autem nobiscum laetitia in deinde vero non coepit amatrix tolle.Permansit in modo ad te finis puellam effari ergo est amet coram te'
	));
	$level1[] = OrganizationUnit::create(array(
		    'name' => 'Foreign Board',
		    'description' => 'Interrogo nata dum est cum.'
	));
	$level1[] = OrganizationUnit::create(array(
		    'name' => 'Personel Board',
		    'description' => 'Palladio in lucem exitum vivit in modo compungi mulierem volutpat cum unde meae sit in fuerat est cum.'
	));

	foreach ($level1 as $unit)
	{
	    $branch_1 = new OrganizationUnit(array(
		'name' => 'Dist. 10 branch',
		'description' => 'Palladio in lucem exitum vivit in modo compungi mulierem volutpat cum unde meae sit in fuerat est cum.'
	    ));
	    $branch_2 = new OrganizationUnit(array(
		'name' => 'Thu Duc Dist. branch',
		'description' => 'Palladio in lucem exitum vivit in modo compungi mulierem volutpat cum unde meae sit in fuerat est cum.'
	    ));
	    $unit->parent_id = $org->id;

	    $unit->child_units()->insert($branch_1);
	    $unit->child_units()->insert($branch_2);
	    $unit->save();
	}
    }

    public function down()
    {
	Schema::drop('organizationunits');
    }

}