<tr data-index="{{ $index }}">
    <td>{!! Form::text('ads['.$index.'][ad_label]', old('ads['.$index.'][ad_label]', isset($field) ? $field->ad_label: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('ads['.$index.'][total_impressions]', old('ads['.$index.'][total_impressions]', isset($field) ? $field->total_impressions: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('ads['.$index.'][total_networks]', old('ads['.$index.'][total_networks]', isset($field) ? $field->total_networks: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::number('ads['.$index.'][total_channels]', old('ads['.$index.'][total_channels]', isset($field) ? $field->total_channels: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>