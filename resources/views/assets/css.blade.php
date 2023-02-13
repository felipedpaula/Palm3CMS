@php
// $allSrc = 'assets/css/all-'.config("aliases.styles_ver").'.min.css';
$allSrc = 'assets/css/all-1.0.0.min.css';
@endphp

<link rel="stylesheet preload" href="{{ asset($allSrc) }}" as="style" type="text/css" media="all">
