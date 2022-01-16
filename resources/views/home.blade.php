@extends('layouts.app')
@section('title')
Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                {{-- <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Welcome, {{ Auth::user()->name }}
                </div> --}}
                <canvas id="SummaryChart" width="100" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')


const ctx = document.getElementById('SummaryChart').getContext('2d');
const myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Merek', 'Kategori', 'Model', 'Garansi'],
datasets: [{
label: 'Total Data',
data: [{{ $totalBrand }}, {{ $totalCategory }}, {{ $totalModel }}, {{ $totalWarranty }}],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255, 99, 132, 1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
y: {
beginAtZero: true
}
}
}
});
@endsection
