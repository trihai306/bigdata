@if($data)
    <tbody>
    @foreach($data as $item)
        <tr wire:key="data-{{$item->id}}">
            @if($this->canSelect())
                <td>
                    <div>
                        <input type="checkbox" class="form-check-input checkbox" :id="'check-' + {{$item->id}}"
                               :value="{{$item->id}}"
                               :checked="isChecked({{$item->id}})"
                               @click="toggleSelection({{$item->id}})">
                    </div>
                </td>
            @endif
            @foreach($this->defineColumns() as $column)
                @if($column->visible)
                    <td>{!! $column->render($item) !!}</td>
                @endif
            @endforeach
            @if($actions)
                @if($this->defineActions($item))
                    <td class="text-center">
                        <div>
                            {{ $this->defineActions($item) }}
                        </div>
                    </td>
                @endif
            @endif
        </tr>
    @endforeach
    </tbody>
@endif
