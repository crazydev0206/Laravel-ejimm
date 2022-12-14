@section('title', trans('storefront::404.404'))
@section('content')
		<section class="error-part">
            <div class="container">
                <h1>404 | Not Found</h1>
                <img class="img-fluid" src="error.png" alt="error" />
                <h3>ooopps! this page can't be found.</h3>
                <p>It looks like nothing was found at this location.</p>
                <a href="index.html">go to home</a>
            </div>
        </section>
 @endsection
