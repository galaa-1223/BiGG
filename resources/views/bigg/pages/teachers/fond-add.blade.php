@extends('../bigg.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ Str::substr($teacher->ovog, 0, 1)}}. {{ $teacher->ner }} багшийн цагийн фонд</h2>
    <div class="intro-y text-gray-600 text-xs mt-0.5">{{ $teacher->mergejil }}</div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('bigg-angi-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Анги:
                        </label>
                        <div class="mt-2">
                            <select name="a_id" data-search="true" class="tail-select w-full">
                                @if($angis)
                                    @foreach($angis as $angi):
                                        <option value="{{ $angi->id }}">{{ $angi->ner }} {{ $angi->course }}{{ $angi->buleg }}</option>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="input-form mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Хичээл: 
                        </label>
                        <div class="mt-2">
                            <select name="h_id" data-search="true" class="tail-select w-full">
                                @if($hicheels)
                                    @foreach($hicheels as $hicheel):
                                        <option value="{{ $hicheel->id }}">{{ $hicheel->ner }}</option>
                                    @endforeach;
                                @else
                                    <option value="">Хоосон байна</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('bigg-angi') }}'" class="button bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="button bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="button bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Анги нэмэх -->
            </div>
        </form>
    </div> 
@endsection

@section('style')
@endsection

@section('script')
@endsection