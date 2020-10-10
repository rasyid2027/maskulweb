@extends('layouts.master')
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-info-circle"></i> Klik nama siswa untuk melihat detail siswa.
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{session('success')}}
                        </div>
                        @endif
                        <h2 class="panel-title">Data Siswa</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    @if (auth()->user()->role == 'admin')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentsData as $student)
                                <tr>
                                    <td><a href="{{route('profile', ['id' => $student->id])}}" style="color: inherit;">{{ucfirst($student->first_name)}}</a></td>
                                    <td><a href="{{route('profile', ['id' => $student->id])}}" style="color: inherit;">{{ucfirst($student->last_name)}}</a></td>
                                    <td>{{ucfirst($student->gender)}}</td>
                                    <td>{{ucfirst($student->address)}}</td>
                                    @if (auth()->user()->role == 'admin')
                                    <td>
                                        <form action="{{route('delete', ['id' => $student->id])}}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash-o"></i> </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (auth()->user()->role == 'admin')
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle"></i> Tambah Siswa</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel" style="display: inline">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('student')}}" method="POST">
                        @csrf
                        <div class="form-group @error('first_name') has-error @enderror">
                            <label for="first_name">Nama Depan</label>
                            <input name="first_name" type="text" class="form-control" id="first_name"
                            aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                            @error('first_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nama Belakang</label>
                            <input name="last_name" type="text" class="form-control" id="last_name"
                            aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                        </div>
                        <div class="form-group @error('gender') has-error @enderror">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Pilih...</option>
                                <option value="L" {{ (old('gender') == 'L') ? ' selecter' : ''}}>Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('gender')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('birth_date') has-error @enderror">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input name="birth_date" type="date" class="form-control" id="birth_date"
                            aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                            @error('birth_date')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('religion') has-error @enderror">
                            <label for="religion">Agama</label>
                            <input name="religion" type="text" class="form-control" id="religion"
                                aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                            @error('religion')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                        <div class="form-group @error('dad_name') has-error @enderror">
                            <label for="dad_name">Nama Ayah</label>
                            <input name="dad_name" type="text" class="form-control" id="dad_name"
                                aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                            @error('dad_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group @error('mom_name') has-error @enderror">
                            <label for="mom_name">Nama Ibu</label>
                            <input name="mom_name" type="text" class="form-control" id="momName"
                                aria-describedby="emailHelp" autocomplete="off" value="{{old('first_name')}}">
                            @error('mom_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Alamat</label>
                            <textarea name="address" class="form-control" id="address" rows="3">{{old('first_name')}}</textarea>
                            @error('address')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="button" class="btn btn-primary">Save changes</button>
                </form>
                </div>
            </div>
        </div>
    </div>
        <!-- END MAIN CONTENT -->
    </div>
@endsection

