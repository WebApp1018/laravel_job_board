<div data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none backdrop-blur"
    id="create_project_modal" tabindex="-1" aria-labelledby="test_modalTitle" aria-modal="true" role="dialog">
    <div data-te-modal-dialog-ref
        class="pointer-events-none relative flex w-auto items-center duration-300 mx-auto h-screen justify-center">
        <div id="select_mode"
            class="pointer-events-auto relative flex w-fit flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
            <div class="p-8 flex flex-col gap-6">
                <p>New Project</p>
                <div class="flex gap-6">
                    <button
                        class="flex gap-3 justify-center items-center text-[#13816B] text-center bg-emerald-100 hover:bg-emerald-200 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium inline-flex items-center w-64 py-4 text-center"
                        onclick="select_mode('Sketch')">
                        <i class="fa-solid fa-square-pen text-2xl"></i>
                        Sketch Mode
                    </button>
                    <button
                        class="flex gap-3 justify-center items-center text-[#ED0000] text-center bg-rose-100 hover:bg-rose-200 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium inline-flex items-center w-64 py-4 text-center"
                        onclick="select_mode('Data')">
                        <img class="h-6 mb-0.5" src="/assets/img/direct-inbox.svg" />
                        Data Mode
                    </button>
                </div>
            </div>
        </div>
        <div id="add_project_data"
            class="hidden pointer-events-auto relative p-4 w-1/2 min-w-[600px] max-w-full max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-xl overflow-hidden shadow">
                <!-- Modal header -->
                <div class="flex items-center py-5 px-8 gap-4">
                    <button onclick="back_to_select_mode()"
                        class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                        <i class="fa-solid fa-angle-left text-lg"></i>
                    </button>
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Project Data
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="px-8 pb-8 flex flex-wrap justify-end">
                    <div class="w-full grid gap-4 mb-8 grid-cols-2">
                        <div class="col-span-2">
                            <label for="project_name"
                                class="block mb-2 font-medium text-gray-900">Project name
                            </label>
                            <input type="text" name="project_name" required="" id="project_name"
                                class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3"
                                placeholder="Type project name" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 font-medium text-gray-900">
                                Project Description
                            </label>
                            <textarea id="description" name="description"
                                class="block p-3 w-full text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Write product description here"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label for="map" class="block mb-2 font-medium text-gray-900">
                                Project Location
                            </label>
                            <div class="border border-gray-300 rounded-lg h-36" id="map"></div>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="client_name" class="block mb-2 font-medium text-gray-900">Client name</label>
                            <input type="text" name="client_name" id="client_name"
                                class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3">
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="project_number"
                                class="block mb-2 font-medium text-gray-900">Project number</label>
                            <input type="text" name="project_number" id="project_number"
                                class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3">
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="address" class="block mb-2 font-medium text-gray-900">Project Address</label>
                            <input type="text" name="address" id="address"
                                class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3">
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="plot_number" class="block mb-2 font-medium text-gray-900">Plot number</label>
                            <input type="text" name="plot_number" id="plot_number"
                                class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3">
                        </div>
                    </div>
                    <button type="button"
                        class="text-white inline-flex bg-rose-500 hover:bg-rose-600 focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg px-6 py-3.5 flex text-lg items-center gap-2.5"
                        onclick="submit_project_data()">
                        Next
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="sketch_canvas"
            class="hidden pointer-events-auto relative p-4 w-3/4 min-w-[800px] max-w-full max-h-full">
            <!-- Modal content -->
            <div class="flex bg-gray-100 rounded-xl max-h-content">
                <div class="flex-1 relative overflow-hidden shadow flex flex-col p-8 gap-5 h-inherit">
                    <!-- Modal header -->
                    <div class="flex items-center gap-4 plot_canvas_panel">
                        <button onclick="back_to_add_project_data()"
                            class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                            <i class="fa-solid fa-angle-left text-lg"></i>
                        </button>
                        <h3 class="text-xl font-semibold text-gray-900">
                            Plot sketch canvas
                        </h3>
                    </div>
                    <div class="flex items-center gap-4 floor_canvas_panel">
                        <button onclick="back_to_plot_sketch_canvas()"
                            class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                            <i class="fa-solid fa-angle-left text-lg"></i>
                        </button>
                        <h3 class="text-xl font-semibold text-gray-900">
                            Floor Canvas
                        </h3>
                    </div>
                    <div class="w-full h-full max-h-[calc(100vh-15rem)]">
                        <div class="flex gap-5 h-full w-full" id="canvas_panel">
                            <div
                                class="h-fit rounded-xl border bg-white px-4 py-8 flex flex-col gap-10 text-rose-500 text-2xl items-center">
                                <button id="btn_select">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-paper-plane"></i>
                                </button>
                                <button id="btn_fullscreen">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-up-right-and-down-left-from-center"></i>
                                </button>
                                <button id="btn_move">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-arrows-up-down-left-right"></i>
                                </button>
                                <button id="btn_pan" class="rounded-lg h-10 w-10 -m-2">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-hand"></i>
                                </button>
                                <button id="btn_delete">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-trash-can"></i>
                                </button>
                                <div class="-m-1 w-full border-t-2 border-gray-300"></div>
                                <button id="btn_zoomin">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-magnifying-glass-plus"></i>
                                </button>
                                <button id="btn_zoomout">
                                    <i
                                        class="hover:text-rose-600 hover:underline underline-offset-8 fa-solid fa-magnifying-glass-minus"></i>
                                </button>
                            </div>

                            {{-- <div class="flex flex-col w-full"> --}}
                            <div class="flex-1 h-inherit bg-white p-4 border rounded-xl overflow-auto">
                                <div id="sketch_canvas_container"
                                    class="border border-neutral-600 w-full h-full m-auto overflow-hidden">
                                </div>
                            </div>

                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="items-center mt-3 grid grid-cols-2">
                        <div id="error_text"
                            class="hidden inline-flex w-fit items-center rounded-lg bg-rose-200 px-6 py-3 text-base text-[#FF0000]"
                            role="alert">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-6 w-6">
                                    <path fill-rule="evenodd"
                                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span id="alert_text">Error object crashing</span>
                        </div>
                        <div class="col-start-2 flex-1 flex justify-center items-center">
                            <button id="btn_undo"
                                class="h-fit rounded bg-white border px-8 py-3 mx-2 hover:bg-neutral-200">
                                Undo
                            </button>
                            <button id="btn_redo"
                                class="h-fit rounded bg-white border px-8 py-3 mx-2 hover:bg-neutral-200">
                                Redo
                            </button>
                        </div>
                    </div>

                </div>
                <div class="w-[350px] h-inherit shadow bg-white py-6 flex flex-col items-end rounded-r-lg">
                    <div class="grid gap-3 px-6 mt-8 mb-8 grid-cols-2 plot_canvas_panel">
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddPlot()">
                                <i class="fa-solid fa-plus"></i>
                                Add Plot
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="plot_type">
                                @foreach ($plot_types as $type)
                                    <option value="{{ $type->id_plot }}">{{ $type->plot_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRect('building')">
                                <i class="fa-solid fa-plus"></i>
                                Add Building
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="building_type">
                                @foreach ($building_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->building_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRect('external')">
                                <i class="fa-solid fa-plus"></i>
                                Add ExtRoom
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="external_type">
                                @foreach ($room_types as $type)
                                    @if ($type->type == 'external')
                                        <option value="{{ $type->id }}">{{ $type->room_type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRect('road')">
                                <i class="fa-solid fa-plus"></i>
                                Add Road
                            </button>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRect('neighbor')">
                                <i class="fa-solid fa-plus"></i>
                                Add Neigh
                            </button>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                    </div>
                    <div class="grid gap-3 px-6 mt-8 mb-8 grid-cols-2 floor_canvas_panel">
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                >
                                Edit Building
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="select_building">

                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRoom('normal')">
                                <i class="fa-solid fa-plus"></i>
                                Add Room
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="normal_room_type">
                                @foreach ($room_types as $type)
                                    @if ($type->type == 'normal')
                                        <option value="{{ $type->id }}">{{ $type->room_type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRoom('stack')">
                                <i class="fa-solid fa-plus"></i>
                                Add S.Room
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="stack_room_type">
                                @foreach ($room_types as $type)
                                    @if ($type->type == 'stack')
                                        <option value="{{ $type->id }}">{{ $type->room_type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="col-span-1">
                            <button class="w-full py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-md"
                                onclick="onAddRoom('floor')">
                                <i class="fa-solid fa-plus"></i>
                                Add Floor
                            </button>
                        </div>
                        <div class="col-span-1">
                            <select data-te-select-init id="select_floor">

                            </select>
                        </div>
                        
                        <hr class="col-span-2 my-0 -mx-6" />
                        <div class="w-full">
                            <div class="block min-h-[1.5rem] pl-[1.5rem]">
                                <label
                                    class="inline-block pl-[0.15rem] hover:cursor-pointer"
                                    for="is_roof_floor">
                                    Roof Floor
                                </label>
                                <input
                                    class="relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-rose-500 checked:bg-rose-500 checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent"
                                    type="checkbox"
                                    value=""
                                    id="is_roof_floor" />
                            </div>
                        </div>
                        <div class="col-span-2 flex gap-2 items-center justify-center">
                            <div type="text" class="flex-1">
                                <input id="floor_name" class="h-10 w-full border px-3" />
                            </div>
                            <button onclick="change_floor(1)"
                                class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                                <i class="fa-solid fa-arrow-up"></i>
                            </button>
                            <button onclick="change_floor(-1)"
                                class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                                <i class="fa-solid fa-arrow-down"></i>
                            </button>
                            {{-- <button onclick="delete_floor()"
                                class="flex justify-center items-center rounded-md bg-rose-100 text-rose-500 h-10 w-10 hover:bg-rose-500 hover:text-white">
                                <i class="fa-solid fa-trash"></i>
                            </button> --}}
                        </div>
                    </div>
                    <div class="flex-1"></div>
                    <div class="w-full p-4 border-b border-t my-2">
                        <span>Properties panel</span>
                        <div id="properties_panel" class="mt-3 border rounded-xl p-4 w-full grid gap-4 grid-cols-2">
                            <div class="col-span-2 md:col-span-1">
                                <label for="length" class="block mb-2 text-rose-500">Length(m)
                                </label>
                                <input type="number" name="length" required="" id="length" value="40"
                                    class="w-full border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label for="width" class="block mb-2 text-rose-500">Width(m)
                                </label>
                                <input type="number" name="width" required="" id="width" value="30"
                                    class="w-full border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label for="x_pos" class="block mb-2 text-rose-500">X Pos(m)
                                </label>
                                <input type="number" name="x_pos" required="" id="x_pos" value="0"
                                    class="w-full border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label for="y_pos" class="block mb-2 text-rose-500">Y Pos(m)
                                </label>
                                <input type="number" name="y_pos" required="" id="y_pos" value="0"
                                    class="w-full border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1"></div>
                    <button
                        class="w-fit text-white bg-rose-500 hover:bg-rose-600 font-medium rounded-lg px-6 py-3 mx-6 my-2 plot_canvas_panel"
                        onclick="go_to_floor_canvas()">
                        Floor Canvas
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                    <button
                        class="w-fit text-white bg-rose-500 hover:bg-rose-600 font-medium rounded-lg px-6 py-3 mx-6 my-2 floor_canvas_panel"
                        onclick="onGenerate()">
                        Generate
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    var new_project_mode;
    var sketch_board = null;
    var current_floor = 0;
    var current_building = null;
    
    function close_create_project_modal() {
        window.location.reload();
    }

    function select_mode(mode) {
        new_project_mode = mode;
        $('#select_mode').hide();
        $('#add_project_data').show();
        var data = localStorage.getItem('project_data');
        if (data) {
            var project_data = JSON.parse(data)
            $('#project_name').val(project_data.project_name),
            $('#description').val(project_data.description),
            $('#client_name').val(project_data.client_name),
            $('#project_number').val(project_data.project_number),
            $('#address').val(project_data.address),
            $('#plot_number').val(project_data.plot_number)
        }
    }

    function back_to_select_mode() {
        $('#add_project_data').hide();
        $('#select_mode').show();
    }

    function submit_project_data() {
        if (new_project_mode == 'Data') {
            $.ajax({
                url: "{{ route('admin.add.project') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    mode: new_project_mode,
                    project_name: $('#project_name').val(),
                    description: $('#description').val(),
                    location: $('#address').val()
                },
                success: function(data) {
                    if (data.result == 'success') {
                        close_create_project_modal();
                    } else {

                    }
                }
            });
        } else {
            $('#add_project_data').hide();
            $('#sketch_canvas').show();
            $('.floor_canvas_panel').addClass('hidden');
            var project_data = {
                project_name: $('#project_name').val(),
                description: $('#description').val(),
                client_name: $('#client_name').val(),
                project_number: $('#project_number').val(),
                address: $('#address').val(),
                plot_number: $('#plot_number').val()
            };
            localStorage.setItem('project_data', JSON.stringify(project_data));

            var data = localStorage.getItem('canvas_data');
            if (data) {
                data = JSON.parse(data);
                sketch_board = new KonvaSketch({
                    container: 'sketch_canvas',
                    width: data.width,
                    height: data.height,
                    on_mode_changed: (plot_canvas) => {
                        if (plot_canvas) back_to_plot_sketch_canvas();
                        else go_to_floor_canvas();
                    },
                    on_select_building: (id, floor) => {
                        $('#select_building').html('');
                        for (let i = 0; i < sketch_board.buildings.length; i++) {
                            var txt = sketch_board.buildings[i].text;
                            $('#select_building').append(`<option value="${i}">${txt}</option>`);
                        }
                        $('#select_building').val(id);
                        $('#select_building')[0].dispatchEvent(new Event('change'));
                        onSelectBuilding();
                        change_floor(floor);
                    },
                    json: data.stage,
                    buildings: data.buildings
                })
            }
            
        }
    }

    function back_to_add_project_data() {
        $('#sketch_canvas').hide();
        $('#add_project_data').show();
    }

    function roundValue(x) {
        return parseInt(x);
    }

    function onAddPlot() {
        if (sketch_board != null) {
            alert('Cannot add more than one plot.');
            return ;
        }
        // // var canvas = $('#sketch_canvas');
        var width = parseFloat($('#length').val());
        var height = parseFloat($('#width').val());
        if (width == 0 || height == 0) {
            alert('Please input correct size.');
            return;
        }
        
        // console.log(v_width, v_height);

        var sub_type = $('#plot_type option:selected').text();
        sketch_board = new KonvaSketch({
            container: 'sketch_canvas',
            width: width * 2,
            height: height * 2,
            on_mode_changed: (plot_canvas) => {
                if (plot_canvas) back_to_plot_sketch_canvas();
                else go_to_floor_canvas();
            },
            on_select_building: (id, floor) => {
                $('#select_building').html('');
                for (let i = 0; i < sketch_board.buildings.length; i++) {
                    var txt = sketch_board.buildings[i].text;
                    $('#select_building').append(`<option value="${i}">${txt}</option>`);
                }
                $('#select_building').val(id);
                $('#select_building')[0].dispatchEvent(new Event('change'));
                onSelectBuilding();
                change_floor(floor);
            }
        });

        // sketch_board.resize_sketch_canvas();
        onAddRect('plot');
        // sketch_board.min_sketch_canvas_scale = sketch_board.sketch_canvas_scale = Math.min(v_width / width, v_height /
        //     height);
        // sketch_board.setScale();
    }

    function onAddRect(type) {
        if (sketch_board == null) return;
        if (type == 'plot') {
            if (sketch_board.layer.find('.plot').length > 0) {
                alert('Cannot add more than one plot.');
                return ;
            }
        }
        if (type == 'building' || type == 'external') {
            if (sketch_board.layer.find('.plot').length == 0) {
                alert('Please add a plot first.');
                return ;
            }
            sketch_board.set_parent(sketch_board.plot);
        }
        else {
            sketch_board.set_parent(null);
        }
        var width = parseFloat(sketch_board.width_input.val());
        var height = parseFloat(sketch_board.height_input.val());
        if (width == 0 || height == 0 || sketch_board.get_width() < width || sketch_board.get_height() < height) {
            alert('Please input correct size.');
            return;
        }
        var sub_type = type;
        if (type != 'neighbor' && type != 'road') sub_type = $('#' + type + '_type option:selected').text();
        var name;
        if (type == 'building' || type == 'external') name = 'rect node ' + type;
        else name = 'rect primary ' + type;
        
        sketch_board.addRect(width, height, name, sub_type);
    }

    function go_to_floor_canvas() {
        if (!$('.floor_canvas_panel').hasClass('hidden')) return ;
        if (sketch_board == null) {
            alert('Please add plot');
            return;
        }
        if (sketch_board.has_error) {
            alert('Please fix object crashing error.');
            return;
        }
        if (sketch_board.buildings.length == 0) {
            alert('Please at least one building');
            return;
        }
        $('.plot_canvas_panel').addClass('hidden');
        $('.floor_canvas_panel').removeClass('hidden');
        sketch_board.set_canvas_mode(false);

        $('#select_building').html('');
        for (let i = 0; i < sketch_board.buildings.length; i++) {
            var txt = sketch_board.buildings[i].text;
            $('#select_building').append(`<option value="${i}">${txt}</option>`);
        }
        
        onSelectBuilding();
        $('#select_building').off('change');
        $('#select_building').on('change', () => { onSelectBuilding() });
        $('#floor_name').off('change');
        $('#floor_name').on('change', (e) => {
            current_building.floors[current_floor] = e.target.value;
        })
    }

    function onAddRoom(type) {
        if (type == 'floor') {
            onSelectFloor(current_building.floors.length);
            return ;
        }
        
        var width = parseFloat(sketch_board.width_input.val());
        var height = parseFloat(sketch_board.height_input.val());
        if (sketch_board.width < width || sketch_board.height < height) {
            alert('Please input correct size.');
            return;
        }
        var sub_type = $('#' + type + '_room_type option:selected').text();
        name = 'rect room ' + type;
        if (type == 'normal') sub_type = `${current_building.id}_floor_${current_floor}_${sub_type}`;
        else sub_type = `${current_building.id}_stack_${sub_type}`;

        var nodes = sketch_board.addRect(width, height, name, sub_type);
    }

    function onSelectBuilding() {
        current_building = sketch_board.buildings[$('#select_building').val()]
        sketch_board.set_parent_by_id(current_building.id);
        console.log('onSelectBuilding', current_building.id, sketch_board.parent_node);

        $('#select_floor').html('');
        for (let floor = 0; floor < current_building.floors.length; floor ++) {
            $('#select_floor').append(`<option value='${floor}'>Floor ${floor + 1}</option>`);
        }
        onSelectFloor(0);
        $('#select_floor').off('change');
        $('#select_floor').on('change', (e) => {
            onSelectFloor(e.target.value);
        });
        $('#is_roof_floor').off('change');
        $('#is_roof_floor').on('change', (e) => {
            if (e.target.checked) current_building.roof_floor = current_floor;
            else current_building.roof_floor = -1;
        })
    }

    function change_floor(dir) {
        var floor = parseInt($('#select_floor').val()) + parseInt(dir);
        if (floor < 0 || floor >= current_building.floors.length) return ;
        $('#select_floor').html('');
        for (let floor = 0; floor < current_building.floors.length; floor ++) {
            $('#select_floor').append(`<option value='${floor}'>Floor ${floor + 1}</option>`);
        }
        onSelectFloor(floor);
        $('#select_floor').val(floor);
        $('#select_floor')[0].dispatchEvent(new Event('change'));
    }

    function delete_floor() {
        var floor = $('#select_floor').val();
    }

    function onSelectFloor(floor) {
        if (current_building.floors.length <= floor) {
            $('#select_floor').append(`<option value='${floor}'>Floor ${floor + 1}</option>`);
            current_building.floors.push(`Floor ${floor + 1}`);
            $('#select_floor').val(floor);
            current_building.roof_floor = floor;
            sketch_board.addRect(0, 0, 'floor', `${current_building.id}_floor_${floor}`);
        }
        current_floor = floor;
        
        $('#floor_name').val(current_building.floors[floor]);
        $('#is_roof_floor')[0].checked = current_building.roof_floor == floor;
        sketch_board.select_floor(floor);
    }

    function back_to_plot_sketch_canvas() {
        if (!$('.plot_canvas_panel').hasClass('hidden')) return ;
        $('.plot_canvas_panel').removeClass('hidden');
        $('.floor_canvas_panel').addClass('hidden');
        sketch_board.set_canvas_mode(true);
        // $('#plot_sketch_canvas').show();
        // $('#floor_canvas').hide();
        // sketch_board.set_keyevent_listeners();
    }
    
    function onGenerate() {
        var project_data = {
            project_name: $('#project_name').val(),
            description: $('#description').val(),
            client_name: $('#client_name').val(),
            project_number: $('#project_number').val(),
            address: $('#address').val(),
            plot_number: $('#plot_number').val()
        };
        
        var primaries = sketch_board.layer.find('.primary');
        var nodes = sketch_board.layer.find('.node');
        var rooms = sketch_board.layer.find('.room');
        var objects = [];
        // plot & roads & neighbors
        primaries.forEach(element => {
            objects.push({
                "Object Name": sketch_board.get_label(element),
                "Object ID": element._id,
                "Parent ID": null,
                "Ext Points List": sketch_board.get_ext_points(element),
                "SVG B64str": sketch_board.createSvg(element),
                "Family Class": element.name().split(' ').pop(),
                "Family Type": sketch_board.get_sub_type(element),
                "Area": sketch_board.get_area(element)
            })
        })
        // buildings & external rooms
        nodes.forEach(element => {
            objects.push({
                "Object Name": sketch_board.get_label(element),
                "Object ID": element._id,
                "Parent ID": sketch_board.plot._id,
                "Ext Points List": sketch_board.get_ext_points(element),
                "SVG B64str": sketch_board.createSvg(element),
                "Family Class": element.name().split(' ').pop(),
                "Family Type": sketch_board.get_sub_type(element),
                "Area": sketch_board.get_area(element)
            })
        })
        var floor_ids = {}
        // floors
        sketch_board.buildings.forEach(building => {
            let rect = sketch_board.get_node_by_id(building.id);
            building.floors.forEach((floor, index) => {
                let floor_id = floor_ids[`${building.id}_floor_${index}`] = sketch_board.get_node_by_id(`${building.id}_floor_${index}`)._id;
                objects.push({
                    "Object Name": floor,
                    "Object ID": floor_id,
                    "Parent ID": rect._id,
                    "Ext Points List": sketch_board.get_ext_points(rect),
                    "SVG B64str": sketch_board.createSvg(rect),
                    "Family Class": "Floor",
                    "Family Type": building.roof_floor == index ? "roof" : "normal",
                    "Area": sketch_board.get_area(rect),
                    "Type Properties": {
                        "Floor No": index + 1
                    }
                })
            })
        })
        // rooms
        rooms.forEach(room => {
            if (room.hasName('stack')) {
                objects.push({
                    "Object Name": sketch_board.get_label(room),
                    "Object ID": room._id,
                    "Parent ID": sketch_board.get_node_by_id(room.id().split('_stack_')[0])._id,
                    "Ext Points List": sketch_board.get_ext_points(room),
                    "SVG B64str": sketch_board.createSvg(room),
                    "Family Class": "stack room",
                    "Family Type": sketch_board.get_sub_type(room),
                    "Area": sketch_board.get_area(room)
                })
            }
            else {
                objects.push({
                    "Object Name": sketch_board.get_label(room),
                    "Object ID": room._id,
                    "Parent ID": floor_ids[`${room.id().split('_floor_')[0]}_floor_${room.id().split('_floor_')[1].split('_')[0]}`],
                    "Ext Points List": sketch_board.get_ext_points(room),
                    "SVG B64str": sketch_board.createSvg(room),
                    "Family Class": "normal room",
                    "Family Type": sketch_board.get_sub_type(room),
                    "Area": sketch_board.get_area(room)
                })
            }
        })
        const blob = new Blob([JSON.stringify({
            project_data,
            objects
        })], { type: 'application/json' });

        // Create a download link
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'data.json';

        // Append the link to the document
        document.body.appendChild(link);

        // Trigger a click on the link to initiate the download
        link.click();

        // Remove the link from the document
        document.body.removeChild(link);

        localStorage.removeItem('project_data');
        localStorage.removeItem('canvas_data');
    }
    
</script>
