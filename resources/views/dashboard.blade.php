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
                    <div class="flex flex-col lg:flex-row">
                        <!-- Left column for chart and controls -->
                        <div class="w-full lg:w-3/4 pr-0 lg:pr-8">
                            <div class="flex justify-end mb-4">
                                <div class="form-group">
                                    <select class="form-control px-10 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="chart_type">
                                        <option value="0" selected>Line Chart</option>
                                        <option value="1">Bar Chart</option>
                                    </select>
                                </div>
                            </div>
                            <div id="chart_1" class="mb-8"></div>
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
                                <button onclick="postData_1()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                                    Go
                                </button>
                            </div>
                        </div>

                        <!-- Right column for scoreboards -->
                        <div class="w-full lg:w-1/4 mt-8 lg:mt-0">
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <h2 class="text-xl font-bold mb-4 text-center">Scoreboards</h2>

                                <!-- Scoreboard Type Selection -->
                                <div class="mb-4">
                                    <select id="scoreboardType" class="w-full p-2 border rounded">
                                        <option value="impor">Impor</option>
                                        <option value="ekspor">Ekspor</option>
                                    </select>
                                </div>

                                <!-- Total Value Scoreboard -->
                                <div class="mb-6">
                                    <div class="bg-white rounded-lg shadow-md p-4">
                                        <h3 class="text-lg font-bold mb-2">Total Value per Year</h3>
                                        <div class="flex items-center justify-between">
                                            <button id="prevYearValue" class="bg-blue-500 text-white px-3 py-1 rounded">&lt;</button>
                                            <span id="currentYearValue" class="text-xl font-bold">2023</span>
                                            <button id="nextYearValue" class="bg-blue-500 text-white px-3 py-1 rounded">&gt;</button>
                                        </div>
                                        <div id="totalValue" class="text-2xl font-bold text-center mt-2">$0</div>
                                        <div class="text-sm text-gray-600 text-center mt-1">USD</div>
                                    </div>
                                </div>

                                <!-- Total Volume Scoreboard -->
                                <div>
                                    <div class="bg-white rounded-lg shadow-md p-4">
                                        <h3 class="text-lg font-bold mb-2">Total Volume per Year</h3>
                                        <div class="flex items-center justify-between">
                                            <button id="prevYearVolume" class="bg-green-500 text-white px-3 py-1 rounded">&lt;</button>
                                            <span id="currentYearVolume" class="text-xl font-bold">2023</span>
                                            <button id="nextYearVolume" class="bg-green-500 text-white px-3 py-1 rounded">&gt;</button>
                                        </div>
                                        <div id="totalVolume" class="text-2xl font-bold text-center mt-2">0</div>
                                        <div class="text-sm text-gray-600 text-center mt-1">Tons</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            {{-- CHART-2 --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mt-5">
                <div class="p-8 text-gray-900">
                    <div id="chart_2" class="mb-8"></div>
                    <div class="flex flex-wrap space-x-4 justify-center items-center">
                        <!-- Tahun Select -->
                        <div class="form-group">
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="tahun_2">
                                @for($i = 2019; $i <= 2023; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <!-- Tipe Select -->
                        <div class="form-group">
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="tipe_2">
                                <option value="impor">Impor</option>
                                <option value="ekspor">Ekspor</option>
                            </select>
                        </div>

                        <!-- Tipe Select -->
                        <div class="form-group">
                            <select class="form-control border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="volorval_2">
                                <option value="Value">Value</option>
                                <option value="Volume">Volume</option>
                            </select>
                        </div>

                        <!-- Go Button -->
                        <button onclick="postData_2()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            Go
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
