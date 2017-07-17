@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                     <h3 align="center">Active Tows</h3>
                    <h5 align="center">{{ $tows }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                     <h3 align="center">Drivers</h3>
                    <h5 align="center">{{ $drivers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                     <h3 align="center">Contracts</h3>
                    <h5 align="center">{{ $contracts }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                     <h3 align="center">Admins</h3>
                    <h5 align="center">{{ $admins }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
