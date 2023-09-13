<?php

function  arabic_month($m){
    if($m == 1) return "يناير";
    if($m == 2) return "فبراير";
    if($m == 3) return "مارس";
    if($m == 4) return "ابريل";
    if($m == 5) return "مايو";
    if($m == 6) return "يونيو";
    if($m == 7) return "يوليو";
    if($m == 8) return "اغسطس";
    if($m == 9) return "سبتمبر";
    if($m == 10) return "اكتوبر";
    if($m == 11) return "نوفمبر";
    if($m == 12) return "ديسمبر";
}

function  arabic_day($d){
    if($d == 'Sat') return "السبت";
    if($d == 'Sun') return "الأحد";
    if($d == 'Mon') return "الإتنين";
    if($d == 'Tue') return "الثلاثاء";
    if($d == 'Wed') return "الأربعاء";
    if($d == 'Thu') return "الخميس";
    if($d == 'Fri') return "الجمعة";
}

function cities(){
    $cities = [
        'الجيزة',
        'دمياط',
        'البحر الأحمر',
        'بني سويف',
        'الوادي الجديد',
        'جنوب سيناء',
        'قنا',
        'مرسي مطروح',
        'البحيرة',
        'الاسماعيلية',
        'السويس',
        'المنيا',
        'الغربية',
        'المنوفية',
        'الشرقية',
        'أسيوط',
        'الدقهلية',
        'الفيوم',
        'سوهاج',
        'كفر الشيخ',
        'جنوب سيناء',
        'القليوبية',
        'القاهرة',
        'طنطا'
    ];
    return $cities;
}