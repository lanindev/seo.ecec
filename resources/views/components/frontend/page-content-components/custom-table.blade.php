@props([
    "data",
])

<div class="my-5 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-{{ $data["table_color"] }}-600 whitespace-nowrap text-sm font-semibold lg:text-lg">
                    @foreach ($data["columns"] as $column)
                        <th class="border-b px-6 py-4 text-left text-white">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-sm lg:text-lg">
                @foreach ($data["rows"] as $row)
                    <tr class="transition-colors hover:bg-sky-50">
                        @foreach ($row as $cell)
                            <td
                                class="{{ $loop->index === 1 ? "whitespace-nowrap font-semibold text-{$data["table_color"]}-600" : "font-medium" }} p-4"
                            >
                                @if (is_array($cell))
                                    @foreach ($cell as $line)
                                        <div>{{ $line }}</div>
                                    @endforeach
                                @else
                                    {{ $cell }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
