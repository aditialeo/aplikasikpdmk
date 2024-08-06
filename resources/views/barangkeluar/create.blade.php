@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang Keluar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-title">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                </div>
                <div class="card-body">
                    <form action="{{ route('barangkeluar.store') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <select class="form-control" name="kd_barang" id="kd_barang">
                                <option> Pilih Kode Barang </option>
                              @foreach ($barangs as $barang)
                                  <option value="{{$barang->kd_barang}}">{{$barang->kd_barang}}</option>
                              @endforeach
                            </select>
                          </div>

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" readonly id="nama_barang">
                          </div>



                     <div class="form-group">
                          <label for="">Suplair</label>
                          <select class="form-control" name="suplair_id" id="">
                            @foreach ($suplairs as $suplair)
                                <option value="{{$suplair->id}}">{{$suplair->nama_suplair}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="">Merk</label>
                            <select class="form-control" name="merk_id" id="">
                              @foreach ($merks as $merk)
                                  <option value="{{$merk->id}}">{{$merk->nama}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar" class="form-control @error('tanggalkeluar') is-invalid @enderror" name="tanggalkeluar" id=""
                                aria-describedby="tanggalkeluarHelpId" placeholder="tanggalkeluar">
                                @error('tanggal_keluar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah Keluar</label>
                            <input type="text" name="jumlah_keluar" class="form-control @error('jumlahkeluar') is-invalid @enderror" name="jumlahkeluar" id=""
                                aria-describedby="jumlahkeluarHelpId" placeholder="jumlahkeluar">
                                @error('jumlah_keluar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>






                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
<script>
    $(document).ready(function(){
        $('#kd_barang').on('change',function(){
            var kdBarang = this.value
            $.ajax({
                url:"{{route('api.get.produk_barang')}}",
                type:"POST",
                data:{
                    kd_barang:kdBarang,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function(result){
                    $('#nama_barang').val(result.data.nm_barang)
                }
            })
        })
    })
</script>
@stop
