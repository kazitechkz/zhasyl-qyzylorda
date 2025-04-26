@extends("layouts.front.front-layout")
@section("main")
    <!-- Quote Start -->
    <div class="container-fluid quote my-5 py-5" data-parallax="scroll" data-image-src="/images/bg-6.jpg">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7 my-2">
                    <div class="bg-white rounded p-4 p-sm-5 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="display-5 text-center mb-5">{{__('messages.form_text')}}</h1>
                        <form action="{{route('send-mail')}}" class="form-control" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input name="name" type="text" class="form-control bg-light border-0" id="name"
                                               placeholder="ФИО">
                                        <label for="name">{{__('messages.name')}}</label>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input name="email" type="email" class="form-control bg-light border-0"
                                               id="gmail" placeholder="Email">
                                        <label for="gmail">{{__('messages.email')}}</label>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input name="phone" type="text" class="form-control bg-light border-0"
                                               id="cphone" placeholder="Телефон">
                                        <label for="cphone">{{__('messages.phone')}}</label>
                                        @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input name="title" type="text" class="form-control bg-light border-0"
                                               id="cage" placeholder="Тема">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="cage">{{__('messages.title')}}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="text" class="form-control bg-light border-0"
                                                  placeholder="Ваш текст" id="message" style="height: 100px"></textarea>
                                        <label for="message">{{__('messages.text')}}</label>
                                        @error('text')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary py-3 px-4" type="submit">{{__('messages.send')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 my-2">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94357.77327408775!2d69.58059553116401!3d42.34933655879392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38a91c1dfaac40e1%3A0x9da582dcd21a80bf!2z0JDQutC40LzQsNGCINCz0L7RgNC-0LTQsCDQqNGL0LzQutC10L3Rgg!5e0!3m2!1sen!2skz!4v1685462246634!5m2!1sen!2skz"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->
@endsection
@push('front_js')
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script>
        $("#cphone").mask("+7(999) 999-9999");
    </script>
@endpush
