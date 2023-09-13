@isset($breadcrumb)
    <div class="main-slider-data wow fadeInUp">
        <div class="breadcrumb-contain">
          <div class="breadcrumb-wrap">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">الرئيسية</a></li>
                @foreach($breadcrumb['pages'] as $page)
                    <li><span><a href="{{ $page['route'] }}">{{$page['title']}}</a></span></li>
                @endforeach
                <li><span>{{$breadcrumb['current']}}</span></li>
            </ul>
          </div>
        </div>
        <h1 class="section-title">{{$breadcrumb['current']}}</h1>
        @if(isset($article) && sizeof($breadcrumb['pages'])>0)
          <span class="bold">{{ $article->writer->name }}</span>
          <span> {{ ArabicDate($article->date?:ArabicDate($article->created_at)) }} </span>
        @endif
        @if(isset($course) && sizeof($breadcrumb['pages'])>0)
          <ul>
            <li><span class="bold">المحاضر</span><span>{{ $lecturer?$lecturer->name:'' }}</span></li>
            <li>
              <span class="bold">الموضوع</span><span>{{ $topic?$topic->title:'' }}</span>
            </li>
            <li>
              <span class="bold">التاريخ</span><span>{{ ArabicDate($date?:ArabicDate($created_at)) }}</span>
            </li>
            <li>
              <div class="icon-wrap">
                <img src="{{ asset('assets/images/icons/google-docs-black.png') }}" alt="" />
                <span>{{$type == 'text'?'محاضرة مقرؤة': ($type == 'audio'?'محاضرة مسموعة':'محاضرة فيديو')}}</span>
              </div>
            </li>
          </ul>
        @endif
      </div>
@endisset
