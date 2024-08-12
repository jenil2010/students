{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-4 mb-4">
        <!-- Congratulations card -->
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body text-nowrap">
                    <h4 class="card-title mb-1 d-flex gap-2 flex-wrap">Congratulations Norris! 🎉
                    </h4>
                    <p class="pb-0">Best seller of the month</p>
                    <h4 class="text-primary mb-1">$42.8k</h4>
                    <p class="mb-2 pb-1">78% of target 🚀</p>
                    <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
                </div>
                <img src="../../assets/img/illustrations/trophy.png"
                    class="position-absolute bottom-0 end-0 me-3" height="140" alt="view sales" />
            </div>
        </div>
        <!--/ Congratulations card -->

        <!-- Total Profit -->
        <div class="col-xl-2 col-md-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="mdi mdi-cart-plus mdi-24px"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-success me-1">+22%</p>
                            <i class="mdi mdi-chevron-up text-success"></i>
                        </div>
                    </div>
                    <div class="card-info mt-4 pt-1">
                        <h5 class="mb-2">155k</h5>
                        <p>Total Order</p>
                        <div class="badge bg-label-secondary rounded-pill">Last 4 Month</div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Profit -->
    </div>
</div>
@endsection

