@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Products {{ $category->tittle }}
    @endsection
    @section('content')

    @endsection
@endif
