@extends('layout.dashboard.index')

@section('page_title', 'Alterar Senha')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">password</i>
                    </div>
                    <h4 class="card-title">Alterar Senha</h4>

                </div>
                <div class="card-body ">
                    <form class="form-horizontal" method="post" action="{{ route('changepass.form.do') }}">
                        @csrf
                        <div class="row">
                            <label class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-9">
                                <div class="col-form-label text-left">{{ auth()->user()->email }}</div>
                                <div class="form-group has-default bmd-form-group"></div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Nova senha</label>
                            <div class="col-md-9">
                                <div class="form-group bmd-form-group">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Repita a nova senha</label>
                            <div class="col-md-9">
                                <div class="form-group bmd-form-group">
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 text-right">
                                <button type="submit" class="btn btn-fill btn-primary">Alterar<div class="ripple-container"></div></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
