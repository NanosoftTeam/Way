@extends('layouts.app')

@section('content')
<div class="container">
    @isset($message1)
        <div class="alert alert-success" role="alert">
            Zmieniono pomyślnie!
        </div>
    @endisset


  <div class="row">
    <div class="col-sm">
            <div class="card">
                <div class="card-header">Ustawnienia systemu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('settings2.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Ogłoszenie publiczne</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="content" class="form-control" rows="2">{{ $settings_content }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Ogłoszenie prywatne</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="content_p" class="form-control" rows="5">{{ $settings_content_p }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">HTML w Dashboard</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="content_html" class="form-control" rows="10">{{ $settings_content_html }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">JS w Dashboard</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="content_js" class="form-control" rows="10">{{ $settings_content_js }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Rutyna rano</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="rutyna_rano" class="form-control" rows="10">{{ $rutyna_rano }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Rutyna popołudnie</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="rutyna_popoludnie" class="form-control" rows="10">{{ $rutyna_popoludnie }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Rutyna wieczór</label>
                            

                            <div class="col-md-6">
                                <textarea id="content" name="rutyna_wieczor" class="form-control" rows="10">{{ $rutyna_wieczor }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">0. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_0_start" class="form-control" rows="10" type="time" value="{{ $lesson0->content2 }}">
                                <input id="lesson" name="lesson_0_end" class="form-control" rows="10" type="time" value="{{ $lesson0->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">1. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_1_start" class="form-control" rows="10" type="time" value="{{ $lesson1->content2 }}">
                                <input id="lesson" name="lesson_1_end" class="form-control" rows="10" type="time" value="{{ $lesson1->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">2. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_2_start" class="form-control" rows="10" type="time" value="{{ $lesson2->content2 }}">
                                <input id="lesson" name="lesson_2_end" class="form-control" rows="10" type="time" value="{{ $lesson2->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">3. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_3_start" class="form-control" rows="10" type="time" value="{{ $lesson3->content2 }}">
                                <input id="lesson" name="lesson_3_end" class="form-control" rows="10" type="time" value="{{ $lesson3->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">4. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_4_start" class="form-control" rows="10" type="time" value="{{ $lesson4->content2 }}">
                                <input id="lesson" name="lesson_4_end" class="form-control" rows="10" type="time" value="{{ $lesson4->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">5. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_5_start" class="form-control" rows="10" type="time" value="{{ $lesson5->content2 }}">
                                <input id="lesson" name="lesson_5_end" class="form-control" rows="10" type="time" value="{{ $lesson5->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">6. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_6_start" class="form-control" rows="10" type="time" value="{{ $lesson6->content2 }}">
                                <input id="lesson" name="lesson_6_end" class="form-control" rows="10" type="time" value="{{ $lesson6->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">7. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_7_start" class="form-control" rows="10" type="time" value="{{ $lesson7->content2 }}">
                                <input id="lesson" name="lesson_7_end" class="form-control" rows="10" type="time" value="{{ $lesson7->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">8. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_8_start" class="form-control" rows="10" type="time" value="{{ $lesson8->content2 }}">
                                <input id="lesson" name="lesson_8_end" class="form-control" rows="10" type="time" value="{{ $lesson8->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">9. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_9_start" class="form-control" rows="10" type="time" value="{{ $lesson9->content2 }}">
                                <input id="lesson" name="lesson_9_end" class="form-control" rows="10" type="time" value="{{ $lesson9->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">10. lekcja</label>
                            

                            <div class="col-md-6">
                                <input id="lesson" name="lesson_10_start" class="form-control" rows="10" type="time" value="{{ $lesson10->content2 }}">
                                <input id="lesson" name="lesson_10_end" class="form-control" rows="10" type="time" value="{{ $lesson10->content3 }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Zapisz
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br />

    </div>
    

  </div>
</div>
@endsection
