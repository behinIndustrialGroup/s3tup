<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="فرم ثبت‌نام صنایع برای تامین برق پایدار از طریق نیروگاه خورشیدی کوچک‌مقیاس یا پکیج‌های ذخیره‌ساز انرژی">
    <link rel="icon" href="{{ url('behin/logo.ico') . '?' . config('app.version') }}">
    <title>ثبت‌نام صنایع — نیروگاه خورشیدی و پکیج ذخیره‌سازی</title>
    <script src="{{ url('behin/behin-dist/dist/js/tailwind-3.4.17.min.js') }}"></script>
    <link href="{{ url('behin/behin-dist/css/css2.css') }}?family=Vazirmatn:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        html,
        body {
            font-family: 'Vazirmatn', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-inline: auto;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <header class="bg-gradient-to-l from-sky-400 via-blue-300 to-emerald-300 text-gray-900">
        <div class="container px-6 py-12">
            <div class="flex flex-col md:flex-row gap-10 items-center">


                <div class="flex-1 space-y-6">
                    <div class="flex flex-col items-start mb-8 space-y-3">
                        <img src="{{ url('behin/logo.png') . '?' . config('app.version') }}" alt="لوگو ستاپ"
                            class="h-14 md:h-16 object-contain">

                        <span
                            class="inline-flex items-center gap-2 text-xs md:text-sm font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                            پلتفرم مورد تأیید وزارت صنعت، معدن و تجارت
                        </span>
                    </div>
                    <div>
                        <span
                            class="inline-flex items-center gap-2 bg-white/70 text-sky-800 px-4 py-1 rounded-full text-sm font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 10h16M4 14h16m-7 4h7" />
                            </svg>
                            تامین برق مطمئن برای صنایع
                        </span>
                        <h1 class="mt-4 text-3xl md:text-4xl font-bold leading-tight">
                            فرم ثبت‌نام صنایع برای احداث نیروگاه خورشیدی یا نصب پکیج ذخیره‌سازی
                        </h1>
                    </div>
                    <p class="text-lg md:text-xl leading-8">
                        اگر در واحد صنعتی خود با هزینه‌های سنگین انرژی یا ریسک قطع برق مواجه هستید، فرم زیر را تکمیل
                        کنید تا
                        کارشناسان ستاپ شرایط شما را بررسی و راهکار اختصاصی ارائه کنند.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm md:text-base">
                        <li class="flex items-start gap-2 bg-white/70 rounded-lg p-3 shadow">
                            <span class="mt-1 text-sky-700">•</span>
                            <span>تامین برق پایدار خطوط تولید و جلوگیری از توقف عملیات</span>
                        </li>
                        <li class="flex items-start gap-2 bg-white/70 rounded-lg p-3 shadow">
                            <span class="mt-1 text-sky-700">•</span>
                            <span>بهینه‌سازی هزینه انرژی با فروش برق مازاد یا مدیریت اوج مصرف</span>
                        </li>
                        <li class="flex items-start gap-2 bg-white/70 rounded-lg p-3 shadow">
                            <span class="mt-1 text-sky-700">•</span>
                            <span>هم‌سویی با الزامات زیست‌محیطی و کاهش ردپای کربنی</span>
                        </li>
                        <li class="flex items-start gap-2 bg-white/70 rounded-lg p-3 shadow">
                            <span class="mt-1 text-sky-700">•</span>
                            <span>پشتیبانی فنی و مالی از امکان‌سنجی تا اجرا و نگهداری</span>
                        </li>
                    </ul>
                </div>
                <div class="flex-1 w-full">
                    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900">متقاضی صنعتی</h2>
                        <p class="text-sm text-gray-600 mb-6">لطفاً اطلاعات خود را وارد کنید؛ کارشناسان ما در اسرع وقت
                            جهت
                            هماهنگی و عقد قرارداد با شما تماس خواهند گرفت.</p>
                        @if (session('status'))
                            <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form id="registration-form" class="space-y-4" method="POST"
                            action="{{ route('landing.industry-registration.submit') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">نام شرکت</label>
                                    <input type="text" name="company_name"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">کد دریافتی از وزارت صمت
                                        (اختیاری)</label>
                                    <input type="text" name="industry_ministry_code"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="در صورت داشتن کد از وزارت صمت وارد کنید">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">نام مدیرعامل</label>
                                    <input type="text" name="ceo_firstname"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">نام خانوادگی مدیرعامل</label>
                                    <input type="text" name="ceo_lastname"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">شماره موبایل مدیرعامل</label>
                                    <input type="tel" name="ceo_mobile" dir="ltr" inputmode="numeric"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="09xxxxxxxxx" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">نام و نام خانوادگی نماینده
                                        (اختیاری)</label>
                                    <input type="text" name="representative_fullname"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="در صورت پیگیری توسط نماینده">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">موبایل نماینده
                                        (اختیاری)</label>
                                    <input type="tel" name="representative_mobile" dir="ltr"
                                        inputmode="numeric"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="09xxxxxxxxx">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">استان</label>
                                    <input type="text" name="province"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="مثال: اصفهان" required>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">آدرس</label>
                                    <input type="text" name="address"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="نشانی دقیق محل کارخانه یا سایت صنعتی" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">ظرفیت درخواستی
                                        (اختیاری)</label>
                                    <input type="text" name="requested_capacity"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="مثال: 500 کیلووات">
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">توضیحات (اختیاری)</label>
                                    <textarea name="description" rows="4"
                                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
                                        placeholder="جزئیات مربوط به مصرف فعلی، فضای نصب یا محدودیت‌های سایت را ذکر کنید."></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold shadow hover:bg-gray-800 transition">
                                ارسال درخواست و دریافت مشاوره تخصصی
                            </button>
                        </form>
                        <p class="text-xs text-gray-500 mt-4">
                            اطلاعات وارد شده در این فرم تنها برای تماس کارشناسان ستاپ استفاده خواهد شد و در هیچ پایگاه
                            داده‌ای ذخیره
                            نمی‌شود.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container px-6 py-12 space-y-16">
        @if (!empty($provinceCounts))
            @include('landing.partials.industry-province-chart', ['provinceCounts' => $provinceCounts])
        @endif

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-lg mb-3">پایداری خطوط تولید</h3>
                <p class="text-sm text-gray-600 leading-6">با تامین برق از نیروگاه خورشیدی یا پکیج‌های ذخیره‌سازی، ریسک
                    توقف
                    خط تولید در زمان قطعی یا نوسانات شبکه کاهش می‌یابد.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-lg mb-3">بهینه‌سازی مالی</h3>
                <p class="text-sm text-gray-600 leading-6">فروش برق مازاد به شبکه و مدیریت اوج مصرف می‌تواند هزینه قبوض
                    و
                    تلفات ناشی از خاموشی را کاهش دهد.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-lg mb-3">رعایت استانداردهای محیط‌زیستی</h3>
                <p class="text-sm text-gray-600 leading-6">استفاده از انرژی پاک به کاهش آلایندگی کمک کرده و در اخذ
                    گواهی‌های
                    زیست‌محیطی و مسئولیت اجتماعی شرکت نقش دارد.</p>
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow px-6 py-10 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold">چرا صنایع به سراغ انرژی خورشیدی می‌روند؟</h2>
                    <ul class="space-y-3 text-sm text-gray-600 leading-6">
                        <li>کاهش ریسک توقف تولید به دلیل قطعی برق و نوسانات شبکه.</li>
                        <li>مدیریت هزینه انرژی با راهکارهای ذخیره‌سازی و قراردادهای خرید تضمینی برق.</li>
                        <li>افزایش اعتبار برند و هم‌راستایی با سیاست‌های مسئولیت اجتماعی.</li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-sky-300/50 via-white to-white rounded-xl border border-sky-100 p-6">
                    <h3 class="text-lg font-semibold mb-3">فرآیند همکاری با ستاپ</h3>
                    <ol class="space-y-3 text-sm text-gray-700 leading-6">
                        <li><strong>ثبت اطلاعات:</strong> فرم را تکمیل کنید تا نیاز انرژی شما بررسی شود.</li>
                        <li><strong>ارزیابی و پیشنهاد:</strong> امکان‌سنجی فنی و مالی و ارائه راهکار متناسب با خطوط
                            تولید.</li>
                        <li><strong>عقد قرارداد و اجرا:</strong> قرارداد تامین برق تنظیم و عملیات نصب و راه‌اندازی آغاز
                            می‌شود.</li>
                    </ol>
                </div>
            </div>
        </section>

        <section
            class="text-center bg-gradient-to-l from-gray-900 via-gray-800 to-gray-900 text-white rounded-3xl px-8 py-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">برای برق پایدار کارخانه خود اقدام کنید</h2>
            <p class="text-sm md:text-base text-gray-100 mb-6 leading-7">با تکمیل فرم ثبت‌نام، کارشناسان ما در کمتر از
                ۲۴ ساعت
                برای ارائه راهکار ویژه صنعت شما تماس خواهند گرفت.</p>
            <a href="#registration-form"
                class="inline-flex items-center gap-2 bg-sky-400 text-gray-900 px-6 py-3 rounded-lg font-semibold shadow hover:bg-sky-300 transition">
                آغاز ثبت‌نام
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </section>
    </main>

    <footer class="bg-gray-100 py-6">
        <div class="container px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
            <div>ستاپ — سامانه تامین و اجرای پروژه‌های خورشیدی</div>
            <div class="flex items-center gap-3">
                <span>پشتیبانی: 021-91307571</span>
                <span>ایمیل: info@s3tup.ir</span>
            </div>
        </div>
    </footer>
</body>

</html>
