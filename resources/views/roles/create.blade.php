@extends('adminlte::page')

@section('title', 'Create Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Role</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="permissions">Permissions</label>
                                <div id="permissions">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input select-all" type="checkbox" id="select-all">
                                        <label class="form-check-label" for="select-all">
                                            Select All
                                        </label>
                                    </div>
                                    <div class="row">
                                        @php
                                            $groupedPermissions = $permissions->groupBy(function ($permission) {
                                                return explode('-', $permission->name)[1];
                                            });
                                        @endphp
                                        @foreach ($groupedPermissions as $menuName => $permissionsGroup)
                                            <div class="col-md-12">
                                                <h5 style="font-weight: bold; color: green;">{{ ucfirst($menuName) }}</h5>
                                                <div class="row">
                                                    @foreach ($permissionsGroup as $permission)
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" name="permissions[]"
                                                                    value="{{ $permission->name }}"
                                                                    id="permission{{ $permission->id }}">
                                                                <label class="form-check-label"
                                                                    for="permission{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('#permissions .form-check-input.permission-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
