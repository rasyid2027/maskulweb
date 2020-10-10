@extends('layouts.master')
@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel">
                <div class="panel-heading">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{session('success')}}
                    </div>
                    @endif
                    <h3 class="panel-title">Edit Data Siswa</h3>
                </div>
                <div class="panel-body">
                    <form class="was-validated" action="{{route('update', ['id' => $student->id])}}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="first_name">Nama Depan</label>
                            <input name="first_name" type="text" class="form-control is-invalid" id="first_name"
                                aria-describedby="emailHelp" autocomplete="off" value="{{$student->first_name}}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nama Belakang</label>
                            <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="emailHelp"
                                autocomplete="off" value="{{$student->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="L" @if ($student->gender == 'L') selected @endif>Laki-Laki</option>
                                <option value="P" @if ($student->gender == 'P') selected @endif>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="religion">Agama</label>
                            <input name="religion" type="text" class="form-control" id="religion" aria-describedby="emailHelp"
                                autocomplete="off" value="{{$student->religion}}">
                        </div>
                        <div class="form-group">
                            <label for="dad_name">Nama Ayah</label>
                            <input name="dad_name" type="text" class="form-control" id="dad_name" aria-describedby="emailHelp"
                                autocomplete="off" value="{{$student->dad_name}}">
                        </div>
                        <div class="form-group">
                            <label for="mom_name">Nama Ibu</label>
                            <input name="mom_name" type="text" class="form-control" id="mom_name" aria-describedby="emailHelp"
                                autocomplete="off" value="{{$student->mom_name}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" class="form-control" id="address" rows="3">{{$student->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input name="avatar" type="file" class="form-control" value="{{asset('images/'. $student->avatar)}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection