@extends('profile.layout')
@section('title', 'اعلانیه ها')
@section('content')
    @component('components.sheet',[
        'header' =>  'اعلانیه های اخیر',
    ])
        <div class="padding">
            @component('components.chip', [
              'label'     =>  'همه را خواندم',
              'icon'      =>  'clear_all',
              'icon_href' =>  'ggg',
              'target'    =>  'readAll',
              'class'     =>  'modal-trigger pointer'
            ])
            @endcomponent
        </div>
        @component('components.form', ['action' => route('profile.notifications.readAll')])

            @component('components.modal', ['id' => 'readAll', 'header' => 'خواندن همه اعلانیه ها',
              'buttons' => [
                    ['label' => 'خواندم'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
            @endcomponent
        @endcomponent
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>برای</th>
                <th>پیام</th>
                <th>زمان</th>
            </tr>
            </thead>
            <tbody>
            @forelse($notifications as $notification)
                <div class={{ $notification->read() ? "back-color" : "light-blue-text" }}>
                @component('components.tr',[
                    'columns'   =>  [
                        $loop->iteration + ( ($notifications->currentPage()-1) * $notifications->perPage() ),
                        $notification->notifiable->fullname,
                        $notification->data['message'],
                        $notification->created_at->diffForHumans()
                        ],
                    'href'      =>  route("profile.notifications.redirect", $notification->id)
                ])
                @endcomponent
                </div>
            @empty
                <td colspan="6" class="center-align">
                    اعلانیه ای موجود نیست
                </td>
            @endforelse
            </tbody>
        </table>
        <div class="padding">

        </div>
    @endcomponent
@endsection
