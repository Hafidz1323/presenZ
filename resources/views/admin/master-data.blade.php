@extends('layouts.app')

@section('header')
    <span>Master Data Management</span>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Grid container for Departments and Positions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Departments Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm flex flex-col">
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="w-2.5 h-5 bg-violet-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-900">Departemen</h3>
                </div>

                <div class="overflow-hidden border border-slate-100 rounded-2xl">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                            <tr>
                                <th class="px-5 py-3.5">Kode</th>
                                <th class="px-5 py-3.5">Nama Departemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($departments as $d)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-5 py-3.5 font-mono font-bold text-slate-800">{{ $d->code }}</td>
                                    <td class="px-5 py-3.5 font-semibold text-slate-700">{{ $d->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Positions Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm flex flex-col">
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="w-2.5 h-5 bg-violet-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-900">Jabatan (Position)</h3>
                </div>

                <div class="overflow-hidden border border-slate-100 rounded-2xl">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                            <tr>
                                <th class="px-5 py-3.5">Kode</th>
                                <th class="px-5 py-3.5">Nama Jabatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($positions as $p)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-5 py-3.5 font-mono font-bold text-slate-800">{{ $p->code }}</td>
                                    <td class="px-5 py-3.5 font-semibold text-slate-700">{{ $p->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Shifts Card -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/50 shadow-sm">
            <div class="flex items-center gap-2.5 mb-5">
                <div class="w-2.5 h-5 bg-violet-600 rounded-full"></div>
                <h3 class="text-lg font-black text-slate-900">Shift Kerja</h3>
            </div>

            <div class="overflow-hidden border border-slate-100 rounded-2xl">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs font-bold text-slate-700 uppercase bg-slate-50 border-b border-slate-200/40">
                        <tr>
                            <th class="px-6 py-4">Nama Shift</th>
                            <th class="px-6 py-4">Jam Masuk</th>
                            <th class="px-6 py-4">Jam Pulang</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($shifts as $s)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $s->name }}</td>
                                <td class="px-6 py-4 font-mono font-semibold text-slate-600">{{ substr($s->start_time, 0, 5) }}</td>
                                <td class="px-6 py-4 font-mono font-semibold text-slate-600">{{ substr($s->end_time, 0, 5) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xxs font-bold bg-emerald-50 border border-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
