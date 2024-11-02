<!DOCTYPE html>
<html>
@include('layouts.header')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.navbar')

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <h1 class="fw-bold fs-4">Manage Soal - 
                        @if($tugas->latsols->isNotEmpty())
                            {{ $tugas->latsols->first()->judulLatsol }}
                        @else
                            <span class="text-danger">Judul Latsol Tidak Ditemukan</span>
                        @endif
                    </h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Tambah Soal Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('soal.store', $tugas->id_tugas ?? '') }}" method="POST">
                                @csrf
                            
                                <input type="hidden" name="id_latihan" value="{{ $tugas->id_latihan ?? '' }}">
                            
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" 
                                              name="pertanyaan" rows="3" required>{{ old('pertanyaan') }}</textarea>
                                    @error('pertanyaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-3">
                                    <label for="bobot_nilai" class="form-label">Bobot Nilai</label>
                                    <input type="number" class="form-control @error('bobot_nilai') is-invalid @enderror" 
                                           name="bobot_nilai" min="1" value="{{ old('bobot_nilai') }}" required>
                                    @error('bobot_nilai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                @foreach(['A', 'B', 'C', 'D'] as $option)
                                    <div class="mb-3">
                                        <label for="pilihan{{ $option }}" class="form-label">Pilihan {{ $option }}</label>
                                        <input type="text" class="form-control @error('pilihan' . $option) is-invalid @enderror" 
                                               name="pilihan{{ $option }}" value="{{ old('pilihan' . $option) }}" required>
                                        @error('pilihan' . $option)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            
                                <div class="mb-3">
                                    <label for="jawaban" class="form-label">Jawaban Benar</label>
                                    <select class="form-select @error('jawaban') is-invalid @enderror" 
                                            name="jawaban" required>
                                        <option value="">-- Pilih Jawaban --</option>
                                        @foreach(['A', 'B', 'C', 'D'] as $option)
                                            <option value="{{ $option }}" {{ old('jawaban') == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jawaban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Simpan Soal</button>
                            </form>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Soal</h4>
                        </div>
                        <div class="card-body">
                            @if($soal->isEmpty())
                                <p>Tidak ada soal untuk latihan ini.</p>
                            @else
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Jawaban Benar</th>
                                            <th>Bobot Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($soal as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->pertanyaan }}</td>
                                                <td>{{ $item->jawaban }}</td>
                                                <td>{{ $item->bobot_nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include('layouts.script')
</body>
</html>
