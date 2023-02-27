@extends('layout.dashboard.index')

@section('page_title', 'Administração | Verificação de Integridade')

@section('content')
    <div class="row">
        @foreach($integrityData as $card)
        <div class="col-lg-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-{{ $card['viewClass'] }} card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ $card['icon'] }}</i>
                        </div>
                        <h3 class="card-title">{{ $card['count'] }}</h3>
                        <p class="card-category">{{ $card['title'] }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-{{ $card['viewClass'] }}">{{ $card['footerIcon'] }}</i>
                            <a href="{{ route($card['adjustmentRoute']) }}">{{ $card['footerText'] }}</a>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection

