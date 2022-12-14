@extends('public.layout')

@section('title', 'Allgemeine Geschäftsbedingungen mit Kundeninformationen')


@section('content')
    <section class="custom-page-wrap clearfix">
        <div class="container">
            <div class="custom-page-content clearfix" id="content_box">
                
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $.get( "https://itrk.legal/hS8.2Y.e89.html", function( data ) {
        $( "#content_box" ).html( data );
    });
});
</script>
@endpush