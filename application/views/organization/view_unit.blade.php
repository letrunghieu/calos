@layout('layout.inner')

@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>
	<h2>The organzation unit name</h2>
    </div>
    <div class='row'>
	<div class='ten columns'>
	    <section>
		<h3>Brief information</h3>
	    </section>
	    <section>
		<h3>Members of this unit</h3>
	    </section>
	</div>
	<div class='four columns'>
	    <ul class='nopad'>
		<li>
		    <a>Basic info</a>
		</li>
		<li>
		    <a href='{{URL::to_action('organization@view_unit_vacancy', array(1))}}'>Vacancies</a>
		</li>
	    </ul>
	</div>
    </div>
</div>
@endsection