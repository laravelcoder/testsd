<tr data-index="{{ $index }}">
    <td>{!! Form::text('stations['.$index.'][station_label]', old('stations['.$index.'][station_label]', isset($field) ? $field->station_label: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('stations['.$index.'][channel_number]', old('stations['.$index.'][channel_number]', isset($field) ? $field->channel_number: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>