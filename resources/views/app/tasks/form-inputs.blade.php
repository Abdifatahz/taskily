@php $editing = isset($task) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" label="Name" :value="old('name', $editing ? $task->name : '')" maxlength="255" placeholder="Name" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="priority" label="Priority">
            @php $selected = old('priority', ($editing ? $task->priority : '')) @endphp
            <option value="low" {{ $selected == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ $selected == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="heigh" {{ $selected == 'heigh' ? 'selected' : '' }}>Heigh</option>
        </x-inputs.select>
    </x-inputs.group>

</div>
