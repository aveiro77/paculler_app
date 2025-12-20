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
                <h3>Projects</h3>
                <p class="text-subtitle text-muted">Manage projects data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Projects</li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">

                <form action="{{ route('projects.store') }}" method="POST" x-data="projectForm()">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" id="status" required>
                    </div>

                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Paculler</label>
                        <select name="employee_id" class="form-control" id="employee_id" required>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Project Details</label>
                        <button type="button" class="btn btn-secondary btn-sm mb-2" @click="addDetail">Add Detail</button>
                        <div id="details">
                            <template x-for="(detail, index) in details" :key="index">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <select :name="'project_details[' + index + '][item_id]'" class="form-control" x-model="detail.item_id" @change="updateRate(index)" required>
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" :name="'project_details[' + index + '][quantity]'" class="form-control" placeholder="Quantity" min="1" x-model="detail.quantity" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" :name="'project_details[' + index + '][rate]'" class="form-control" placeholder="Rate" min="0" step="0.01" x-model="detail.rate" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm" @click="removeDetail(index)">Remove</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Project</button>
                </form>

                <script>
                    function projectForm() {
                        return {
                            items: @json($items->keyBy('id')->toArray()),
                            details: [],
                            addDetail() {
                                this.details.push({ item_id: '', quantity: 1, rate: 0 });
                            },
                            removeDetail(index) {
                                this.details.splice(index, 1);
                            },
                            updateRate(index) {
                                const itemId = this.details[index].item_id;
                                if (itemId && this.items[itemId]) {
                                    this.details[index].rate = this.items[itemId].rate;
                                } else {
                                    this.details[index].rate = 0;
                                }
                            }
                        }
                    }
                </script>

            </div>
        </div>
    </section>
</div>

@endsection