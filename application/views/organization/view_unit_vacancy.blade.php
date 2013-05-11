@layout('layout.inner')

@section('page-content')
<div class='page container' id='view_unit'>
    <div class='row'>
	<h2>The organzation unit vacancies</h2>
    </div>
    <div class='row'>
	<div class='ten columns'>
	    <section>
		<h3>Leader</h3>
	    </section>
	    <section>
		<h3>Member vacancies</h3>
	    </section>
	</div>
	<div class='four columns'>
	    <ul class='nopad'>
		<li>
		    <a href='{{URL::to_action('organization@view_unit', array(1))}}'>Basic info</a>
		</li>
		<li>
		    <a >Vacancies</a>
		</li>
	    </ul>
	</div>
    </div>
</div>
@endsection