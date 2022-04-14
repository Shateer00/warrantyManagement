@extends('layouts.app')
@section('title')
Home
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="font-weight-bold text-center mb-0">Summary Chart</p>
                </div>
                <div class=" border border-dark">
                    <canvas id="SummaryChart" width="100" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
const TheSummaryChart =
document.getElementById('SummaryChart').getContext('2d');
CreateDashboardSummaryChart(
TheSummaryChart,
{{ $totalBrand }},
{{ $totalCategory }},
{{ $totalModel }},
{{ $totalWarranty}}
);
@endsection
