@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kingdoms</h3>
                <p class="text-subtitle text-muted">Manage kingdoms data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Kingdoms</li>
                        <li class="breadcrumb-item active" aria-current="page">Show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <h5>Name</h5>
                        <p>{{ $kingdom->name }}</p>
                    </div>
                </div>

                <a href="{{ route('kingdoms.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('kingdoms.edit', $kingdom->id) }}" class="btn btn-warning">Edit</a>

            </div>
        </div>
    </section>
</div>

@endsection