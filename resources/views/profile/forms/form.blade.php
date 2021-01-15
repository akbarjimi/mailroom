@extends('profile.layout')
@section('title','مطالب')
@section('content')
    @component('components.sheet',[
      'header' => 'معرفی نامه ' . $form->title,
      'backlink' => isset($employee)? route('admin.users.forms.index', $employee): route('profile.forms.index'),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'action' => isset($employee)? route('admin.users.forms.request', [$employee, $form]): route('profile.forms.request', $form),
          'method' => 'post'
        ])
            @foreach ($form->requiredFields() as $field)
                @if ($field['type'] == 'max_pay')
                    @component('components.form.select', [
                      'name' => 'max_pay',
                      'label' => 'سقف خدمات',
                      'options' => array_combine($form->max_pay, $form->max_pay),
                      'select_item' => old('max_pay', request('max_pay')),
                    ])
                    @endcomponent
                @elseif ($field['type'] == 'installments')
                    @component('components.form.select', [
                      'name' => 'installments',
                      'label' => 'تعداد اقساط',
                      'options' => array_combine($form->installments, $form->installments),
                      'select_item' => old('installments', request('installments')),
                    ])
                    @endcomponent
                @elseif ($field['type'] == 'select')
                    @component('components.form.select', [
                      'name' => $field['name'],
                      'label' => $field['label'],
                      'options' => array_combine($field['options'], $field['options']) ,
                      'select_item' => old($field['name'], request($field['name'])),
                    ])
                    @endcomponent
                @elseif ($field['type'] == 'check')
                    <strong>{{ $field['label'] }}:</strong>
                    @foreach ($field['options'] as $option)
                        @component('components.form.checkbox', [
                          'name' => $field['name'].'[]',
                          'value' => $option,
                          'label' => $option,
                          'class' => 'inline-block margin-h',
                          'checked' => in_array($option, old($field['name'], request($field['name'], [])))
                        ])
                        @endcomponent
                    @endforeach
                @elseif ($field['type'] == 'multi')
                  <input type="hidden" name="{{$field['name']}}_count"  value={{request()->get($field['name'].'_count', 0)}} />
                  @continue(request()->get($field['name'].'_count', 0) <= 0)
                    <h2 class="title">تمامی اطلاعات {{$field['label']}} را با دقت پر کنید</h2>
                    <table>
                      @for ($i = 0; $i < request()->get($field['name'].'_count'); $i++)
                        <tr>
                          @foreach ($field['options'] as $j => $option)
                            <td>
                              @component('components.form.text', [
                                'name' => $field['name']."[$i][$j]",
                                'label' => $option,
                                'value' => request($field['name'])[$i][$j] ?? ''
                              ])                                
                              @endcomponent
                            </td>
                          @endforeach
                        </tr>
                      @endfor
                    </table>
                @else
                    @component('components.form.text',[
                      'label' => $field['label'],
                      'name' => $field['name'],
                      'value' => old($field['name'], request($field['name']))
                    ])
                    @endcomponent
                @endif
            @endforeach
            
            <br>
            @component('components.form.button',[
              'label' => 'پیش نمایش'
            ])
            @endcomponent

            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => isset($employee)? route('admin.users.forms.index', $employee): route('profile.forms.index'),
              'flat' => true
            ])
            @endcomponent

        @endcomponent
    @endcomponent
@endsection
