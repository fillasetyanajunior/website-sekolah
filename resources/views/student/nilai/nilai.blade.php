@extends('layouts.base_dashboard')
@section('title', $title)
@section('content')
<div class="page">
    <x-sliderbar-student></x-sliderbar-student>
    <div class="page-wrapper">
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                Nilai
                            </div>
                            <h2 class="page-title">
                                {{$title}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{$title}}</h3>
                                </div>
                                <div class="card-body border-bottom py-3">
                                    <div class="d-flex">
                                        <div class="text-muted">
                                            <div class="mb-3">
                                                <select class="form-select">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <option value="1">X</option>
                                                    <option value="2">XI</option>
                                                    <option value="3">XII</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-muted ms-3">
                                            <div class="mb-3">
                                                <select class="form-select">
                                                    <option value="">-- Pilih Semester --</option>
                                                    <option value="1">Ganjil</option>
                                                    <option value="2">Genap</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1">#</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Nilai Angka</th>
                                                <th>Nilai Huruf</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($grade as $showgrade)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{App\Models\Subject::find($showgrade->matapelajaran)->matapelajaran}}</td>
                                                    <td>{{$showgrade->angka}}</td>
                                                    <td>{{$showgrade->huruf}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</div>
@endsection
