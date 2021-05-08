@extends('template.app')

@section('title','Contact')
@section('page-title','Contact')

@section('content')

@push('nav')
<ul class="nav-menu nav navbar-nav">
    @foreach ($categori as $item)
        <li class="cat-3"><a href="{{ route('artikel.kategori',$item->slug) }}">{{ $item->nama_kategori }}</a></li>
    @endforeach
</ul>
@endpush

@push('categoris')
    <ul class="footer-links">
        @foreach ($categori as $item)
        <li><a href="{{ route('artikel.kategori',$item->slug) }}">{{ $item->nama_kategori }}</a></li>
        @endforeach
    </ul>
@endpush

@endsection
