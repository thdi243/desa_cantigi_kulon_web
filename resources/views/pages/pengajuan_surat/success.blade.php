@extends('template.layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="bg-green-500 p-6">
                    <div class="flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pengajuan Berhasil</h2>
                    <p class="text-gray-600 mb-6">
                        Pengajuan surat Anda telah berhasil dikirim. Silakan tunggu proses verifikasi lebih lanjut.
                    </p>

                    <div class="flex justify-center">
                        <a href="{{ route('home') }}"
                            class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg 
                              shadow-md hover:bg-green-600 transition duration-300 
                              transform hover:-translate-y-1 focus:outline-none 
                              focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="text-center text-gray-500 mt-4">
                <p class="text-sm">
                    Butuh bantuan?
                    <a href="{{ route('contact') }}" class="text-green-500 hover:underline">
                        Hubungi Kami
                    </a>
                </p>
            </div> --}}
        </div>
    </div>
@endsection

@php
    $noNavbar = true;
    $noFooter = true;
@endphp
