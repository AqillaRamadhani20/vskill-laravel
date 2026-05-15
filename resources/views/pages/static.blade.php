@extends('layouts.app')

@section('title', $title . ' | V-Skill')

@section('content')
    <section class="static-page">
        <div class="static-card">
            <h1 class="static-title">
                {{ $title }}
            </h1>

            <p class="static-body">
                {{ $body }}
            </p>
        </div>
    </section>
@endsection