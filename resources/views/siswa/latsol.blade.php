@foreach($latihanSoal as $index => $latihan)
                            <div class="modal fade modal-lg" id="showModal{{$latihan->id_tugas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Latihan Soal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid my-8">
                                                <div class="row justify-content-center">
                                                    <div class="container-fluid">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div>
                                                                    ID Tugas: {{ $latihan->id_tugas }}
                                                                </div>
                                                                <div>
                                                                    ID latian: {{ $latihan->id_latihan }}
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Materi :</strong>
                                                                        {{ $latihan->judulMateri }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Judul Latihan :</strong>
                                                                        {{ $latihan->judulLatsol }}
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pertanyaan :</strong>
                                                                        {{ $latihan->pertanyaan }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Nilai :</strong>
                                                                        {{ $latihan->bobot_nilai }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 1 :</strong>
                                                                        {{ $latihan->pilihanA }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 2 :</strong>
                                                                        {{ $latihan->pilihanB }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 3 :</strong>
                                                                        {{ $latihan->pilihanC }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 4 :</strong>
                                                                        {{ $latihan->pilihanD }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Jawaban :</strong>
                                                                        {{ $latihan->jawaban }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach