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
                        <div class="card-body">
                            <form action="{{ route('soal.store', $tugas->id_tugas ?? '') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_latihan" value="{{ $tugas->id_latihan ?? '' }}">
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" rows="3" required>{{ old('pertanyaan') }}</textarea>
                                    @error('pertanyaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                @foreach(['A', 'B', 'C', 'D'] as $option)
                                    <div class="mb-3">
                                        <label for="pilihan{{ $option }}" class="form-label">Pilihan {{ $option }}</label>
                                        <input type="text" class="form-control @error('pilihan' . $option) is-invalid @enderror" name="pilihan{{ $option }}" value="{{ old('pilihan' . $option) }}" required>
                                        @error('pilihan' . $option)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            
                                <div class="mb-3">
                                    <label for="jawaban" class="form-label">Jawaban Benar</label>
                                    <select class="form-select @error('jawaban') is-invalid @enderror" name="jawaban" required>
                                        <option value="">-- Pilih Jawaban --</option>
                                        @foreach(['A', 'B', 'C', 'D'] as $option)
                                            <option value="{{ $option }}" {{ old('jawaban') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('jawaban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($soal as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->pertanyaan }}</td>
                                                <td>{{ $item->jawaban }}</td>
                                                <td>
                                                    <!-- Button for Lihat Modal -->
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#lihatModal{{ $item->id }}" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Button for Edit Modal -->
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Form -->
                                                    <form action="{{ route('soal.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal Lihat -->
                                            <div class="modal fade" id="lihatModal{{ $item->id }}" tabindex="-1" aria-labelledby="lihatModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="lihatModalLabel">Detail Soal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Pertanyaan:</strong> {{ $item->pertanyaan }}</p>
                                                            <p><strong>Pilihan A:</strong> {{ $item->pilihanA }}</p>
                                                            <p><strong>Pilihan B:</strong> {{ $item->pilihanB }}</p>
                                                            <p><strong>Pilihan C:</strong> {{ $item->pilihanC }}</p>
                                                            <p><strong>Pilihan D:</strong> {{ $item->pilihanD }}</p>
                                                            <p><strong>Jawaban Benar:</strong> {{ $item->jawaban }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Soal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('soal.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                                                    <textarea class="form-control" name="pertanyaan" rows="3" required>{{ $item->pertanyaan }}</textarea>
                                                                </div>
                                                                @foreach(['A', 'B', 'C', 'D'] as $option)
                                                                    <div class="mb-3">
                                                                        <label for="pilihan{{ $option }}" class="form-label">Pilihan {{ $option }}</label>
                                                                        <input type="text" class="form-control" name="pilihan{{ $option }}" value="{{ $item->{'pilihan' . $option} }}" required>
                                                                    </div>
                                                                @endforeach
                                                                <div class="mb-3">
                                                                    <label for="jawaban" class="form-label">Jawaban Benar</label>
                                                                    <select class="form-select" name="jawaban" required>
                                                                        <option value="">-- Pilih Jawaban --</option>
                                                                        @foreach(['A', 'B', 'C', 'D'] as $option)
                                                                            <option value="{{ $option }}" {{ $item->jawaban == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
