@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-8">
            <!-- BEGIN: Basic Table -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    1. fdfd
                </div>
                
            </div>
        </div>
        
    </div>
    <!-- BEGIN: Хариултууд -->
    <form class="custom-validate-form" action="{{ route('bigg-shalgalt-asuult-save', $id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-span-12 xl:col-span-4 mt-6">
        <!-- BEGIN: Хариултууд -->
        <div class="col-span-12 xl:col-span-8 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <div class="input-form w-3/5">
                    <textarea class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" name="asuult" placeholder="Асуултын гарчиг бичих..."></textarea>
                </div>
                <div class="sm:ml-auto mt-3 sm:mt-0 relative">
                    <select id="hariult-songolt" name="hariult_songolt" class="input border mr-2">
                        <option value="neg">Нэг сонголттой</option>
                        <option value="olon">Олон сонголттой</option>
                        <option value="nuhuh">Үг нөхөх</option>
                    </select>
                </div>
                <a href="{{ route('bigg-shalgalt-asuult', $id) }}" class="button text-white bg-theme-13 shadow-md mr-2">Болих</a>
                <button class="button text-white bg-theme-1 shadow-md mr-2">Хадгалах</button>
            </div>
        </div>
        <!-- END: Хариултууд -->
        <div class="mt-10">
            <div class="neg">
                <div class="intro-y ">
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                        <div class="w-10">1.</div>
                        <div class="w-10">
                            <input type="radio" name="zuv[]" class="input border mr-2 mt-1" value="1">
                        </div>
                        <div class="input-form ml-4 w-7/12">
                            <input type="input" tabindex="1" name="hariult[1]" class="input w-full border" placeholder="Хариулт">
                        </div>
                        <div class="flex justify-center items-center w-20"></div>
                    </div>
                    <div id="neg_container"></div>
                </div>
                <a href="#" id="neg-add" data-viewer="neg_container" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Хариулт нэмэх</a> 
            </div>

            <div class="olon hidden">
                <div class="intro-y">
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                        <div class="w-10">1.</div>
                        <div class="w-10">
                            <input type="checkbox" name="zuv2[]" class="input border mr-2 mt-1" value="1"> 
                        </div>
                        <div class="input-form ml-4 w-7/12">
                            <input type="input" tabindex="1" name="hariult2[1]" class="input w-full border" placeholder="Хариулт">
                        </div>
                        <div class="flex justify-center items-center w-20">
                        </div>
                    </div>
                    <div id="olon_container"></div>
                </div>
                <a href="#" id="olon-add" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Хариулт нэмэх</a> 
            </div>

            

            <div class="nuhuh hidden">
                <div class="intro-y">
                    Nuhuh
                </div>
                
                <a href="#" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Хариулт нэмэх</a> 
            </div>
        </div>
    </div>
    </form>
    <!-- END: Хариултууд -->
@endsection

@section('style')
@endsection

@section('script')
@endsection