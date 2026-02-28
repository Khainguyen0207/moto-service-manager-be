@extends('admin.layouts.contentLayout')

@php
    $title = 'Form'
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="row g-6">
            <div class="form-has-data">
                @include($form->getView(), [$form, $id, $class])
            </div>
        </div>
    </div>
@endsection
