{{-- @extends('layouts.app') --}}

@section('content')
    <form action="{{ route('latsol.submit', $tugas->id_tugas) }}" method="post">
        @csrf
        @foreach($latihanSoal as $soal)
            <div>
                <p>{{ $soal->pertanyaan }}</p>
                <label><input type="radio" name="soal_{{ $soal->id_latihan }}" value="A"> {{ $soal->pilihanA }}</label>
                <label><input type="radio" name="soal_{{ $soal->id_latihan }}" value="B"> {{ $soal->pilihanB }}</label>
                <label><input type="radio" name="soal_{{ $soal->id_latihan }}" value="C"> {{ $soal->pilihanC }}</label>
                <label><input type="radio" name="soal_{{ $soal->id_latihan }}" value="D"> {{ $soal->pilihanD }}</label>
            </div>
        @endforeach
        <button type="submit">Submit</button>
    </form>
    @include('layouts.footer')
@endsection
