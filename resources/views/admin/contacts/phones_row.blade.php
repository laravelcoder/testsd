<tr data-index="{{ $index }}">
    <td>{!! Form::text('phones['.$index.'][phone_number]', old('phones['.$index.'][phone_number]', isset($field) ? $field->phone_number: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>