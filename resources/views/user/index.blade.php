@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Data User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a name="" id="" class="btn btn-primary float-right text-xs font-bold"
                        href="{{ route('user.create') }}" role="button"><i class="fa fa-plus-circle"
                            aria-hidden="true"></i>
                        Tambah Data User</a>
                </div>
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        @foreach ($data->roles as $role)
                                            <span class="badge badge-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a name="" id="" class="btn btn-primary text-xs"
                                                href="{{ route('user.edit', $data->id) }}" role="button">Edit</a>
                                            <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary text-xs" data-toggle="modal"
                                                data-target="#roleModal" data-userid="{{ $data->id }}">Tambah
                                                Role</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user.addRole') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">Tambah Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();

            $('#roleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var userId = button.data('userid');
                var modal = $(this);
                modal.find('.modal-body #user_id').val(userId);
            });
        });
    </script>
@stop
