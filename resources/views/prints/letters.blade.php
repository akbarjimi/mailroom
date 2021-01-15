<style>


    span#change_font {
        font-family: 'tahoma';
    }

    #Hideous {
        display: none;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: iransans;
        direction: rtl;
        line-height: 1.5;
        font-size: @if($size == 'A4') 12px @else 11px @endif;
        display: flex;
        justify-content: flex-end;
    }

    table {
        border-collapse: collapse;
        margin: 1rem 0;
        width: 100%;
    }

    thead tr {
        background-color: #ddd
    }

    .no-border, .no-border td, .no-border th {
        border: none;
    }

    /* th{ text-align: right; font-size: 14px; color: #888; line-height: 30px; } */
    td, th {
        padding: 1rem;
        border: 1px solid #ddd;
    }

    .width-1-2 {
        width: 50%
    }

    .width-1-3 {
        width: 33.33%
    }

    .width-1-6 {
        width: 16.66%
    }

    .half-width {
        width: 50%;
        background-color: red
    }

    .full-width {
        width: 100%;
    }

    .border {
        border: 1px solid #bbb;
    }

    .padding {
        padding: 12px;
    }

    .margin-bottom {
        margin-bottom: 10px;
    }

    .title {
        font-weight: bold;
        font-size: 17px;
        color: #2a3498;
        margin-bottom: 10px;
    }

    .subheading {
        font-weight: bold;
        font-size: 15px;
        color: #2a3498
    }

    .input-field {
        padding: .5rem
    }

    @page {
        margin: @if($size == 'A4-L') 100px 30px; @else 180px 30px; @endif
        margin-header: 0px;
        header: page-header;
        footer: page-footer;
    }

    .invert {
        background-color: #4a54b8;
        color: #fff;
    }

    .invert td {
        color: #fff;
    }

    .terms {
        font-size: 12px;
    }

    .center {
        text-align: center
    }
    .sign{
        max-width: 150px;
        max-height: 150px;
    }
</style>
<body>
<htmlpageheader name="page-header">
    <table class="full-width no-border">
        <tr>
            <td class="width-1-3">
                <img width="<?= $size=='A4'? '160px': '100px' ?>" src="{{ public_path('images/arm.png') }}"/>
            </td>
            <td class="width-1-3 center title">بسمه تعالی</td>
            <td class="@if ($size != 'A4-L')  width-1-3 @else width-1-6 @endif" style="padding: 0">
                <div style="color: #fff; font-size: 7px; margin: -10px 0 0 0; padding: 0; text-align: left;">
                    {!! QrCode::size($size=='A4'? 140: 100)->generate(route('letterqr', str_random(7) . base64_encode($letter->track->id*66964817) . str_random(7) )); !!}
                </div>
                @if ($size != 'A4-L')                
                    &nbsp; &nbsp; &nbsp; &nbsp;تاریخ: {{ jdate($letter->created_at)->format('d / m / Y') }}<br/><br/>
                    &nbsp; &nbsp; &nbsp; &nbsp;کد رهگیری: {{ $letter->track->id }}
                @endif
            </td>
            @if ($size == 'A4-L')
                <td style="text-align: right; padding-right: 0;">
                    &nbsp; &nbsp; &nbsp; &nbsp;تاریخ: {{ jdate($letter->created_at)->format('d / m / Y') }}<br/><br/>
                    &nbsp; &nbsp; &nbsp; &nbsp;کد رهگیری: {{ $letter->track->id }}
                </td>
            @endif
        </tr>
    </table>
</htmlpageheader>
<br/>
<div>
    {!! $letter->body !!}
</div>
@unless($letter->types()->keys()->has($letter->type))
<div style="text-align: left">
    @if ($media = $letter->region->getSign($letter->created_at))
    <img class="left sign" src="{{ $media->getPath() }}" alt="sign">
    @endif
</div>
@endunless
</body>
  
