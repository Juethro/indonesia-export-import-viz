<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <div class="form-group">
                            <select class="form-control px-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="chart_type">
                                <option value="0" selected>Line Chart</option>
                                <option value="1">Bar Chart</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart" class="mb-8"></div>
                    <div class="flex flex-wrap space-x-4 justify-center items-center">
                        <!-- Tahun Select -->
                        <div class="form-group">
                            
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="tahun">
                                @for($i = 2019; $i <= 2023; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
    
                        <!-- Tipe Select -->
                        <div class="form-group">
                            
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="tipe">
                                <option value="impor">Impor</option>
                                <option value="ekspor">Ekspor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="volorval">
                                <option value="Value">Value</option>
                                <option value="Volume">Volume</option>
                            </select>
                        </div>
                                
                        <!-- Go Button -->
                        <button onclick="postData()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            Go
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</x-app-layout>
