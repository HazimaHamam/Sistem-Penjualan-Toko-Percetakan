@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@include('frontend.partials.hero')

@include('frontend.partials.marquee')

@include('frontend.partials.kategori')

@include('frontend.partials.produk')

@include('frontend.partials.stats')

@include('frontend.partials.testimonials')

@include('frontend.partials.cta')

@include('frontend.partials.newsletter')

@push('scripts')
<script>
/**
 * IntersectionObserver — animasi scroll.
 * Kelas .visible ditambahkan saat elemen masuk viewport.
 */
(function () {
    'use strict';

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    document.querySelectorAll('.anim-up, .anim-in, .anim-r').forEach(function (el) {
        observer.observe(el);
    });
})();
</script>
@endpush

@endsection