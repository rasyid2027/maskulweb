@extends('layouts.master')
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @if (session('errorScore'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{session('errorScore')}}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{session('success')}}
                </div>
                @endif
                <div class="panel panel-profile">
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                <div class="overlay"></div>
                                <div class="profile-main">
                                    <img src="{{$student->getAvatar()}}" class="img-circle" alt="Avatar" style="width: 100%; max-width: 100px;">
                                    <h3 class="name">{{ucfirst($student->first_name)}} {{ucfirst($student->last_name)}}</h3>
                                </div>
                                <div class="profile-stat">
                                    <div class="row">
                                        <div class="col-md-4 stat-item">
                                            {{$student->lesson->count()}}<span>Mata Pelajaran</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            15 <span>Awards</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            2174 <span>Points</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE HEADER -->
                            <!-- PROFILE DETAIL -->
                            <div class="profile-detail">
                                <div class="profile-info">
                                    <h4 class="heading">Detail Data</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Tanggal Lahir <span>{{ucfirst($student->birth_date)}}</span></li>
                                        <li>Agama <span>{{ucfirst($student->religion)}}</span></li>
                                        <li>Nama Ayah <span>{{ucfirst(ucwords($student->dad_name))}}</span></li>
                                        <li>Nama Ibu <span>{{ucfirst(ucwords($student->mom_name))}}</span></li>
                                        <li>Alamat <span>{{ucfirst($student->address)}}</span></li>
                                    </ul>
                                </div>
                                @if (auth()->user()->role == 'admin')
                                <div class="text-center">
                                    <a href="{{$student->id}}/edit" class="btn btn-primary">Edit Profile</a>
                                </div>
                                @endif
                            </div>
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">
                            @if (auth()->user()->role == 'guru')
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 20px;">Tambah nilai</button>
                            @endif
                            <!-- TABBED CONTENT -->
                            <div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Mata Pelajaran</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Nilai</th>
											</tr>
                                        </thead>
										<tbody>
                                            @foreach ($student->lesson as $lesson)
											<tr>
                                                <td>{{$lesson->code}}</td>
												<td>{{ucfirst(ucwords($lesson->name))}}</td>
												<td>{{$lesson->semester}}</td>
												<td>{{$lesson->pivot->score}}</td>
											</tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
                            <!-- END TABBED CONTENT -->
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{route('student')}}" class="btn btn-primary"><i class="fa fa-undo"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
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
                        <form action="/student/{{$student->id}}/add-score" method="POST">
                            @csrf
                            <div class="form-group">
                                <select name="lesson_id" class="form-control">
                                    @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group @error('score') has-error @enderror">
                                <label for="score">Nilai</label>
                                <input name="score" type="text" class="form-control" id="score"
                                aria-describedby="emailHelp" autocomplete="off" value="{{old('score')}}">
                                @error('score')
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