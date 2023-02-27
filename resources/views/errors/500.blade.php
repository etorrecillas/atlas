@extends('layout.errors.index')

@section('error_details')
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset("assets/img/atlas5.jpg") }}'); background-size: cover; background-position: top center;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <h3 class="card-title text-center" style="color: white; font-weight: bold;">Sistema ATLAS</h3>
                    <div class="alert alert-danger text-center">
                        <b>Erro do servidor</b>
                    </div>
                    <p class="text-center"><a href="{{ route('home') }}"><button class="btn text-center">Início</button></a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
